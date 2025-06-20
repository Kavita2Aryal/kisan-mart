<?php

namespace App\Services\Auth;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

use Jenssegers\Agent\Agent;

use App\Services\General\SettingService;
use App\Services\Build\ListGroupService;

class FortifyService
{
    public static function createAgent($session)
    {
        return tap(new Agent, function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }

    public static function initSession()
    {
        session()->put('login-datetime', now()->getTimestamp());
        session()->put('super-auth', auth()->user()->role->is_super = 10 ? true : false);
        session()->flash('info-circle', ['title' => 'Welcome, '.ucwords(strtok(auth()->user()->name, ' ')), 'msg' => 'You are now logged in.', 'icon' => "<i class='pg-icon'>user</i>"]);

        SettingService::_init();
        ListGroupService::_init();
    }

    public static function getSessions()
    {
        return collect(
            DB::table(config('session.table', 'sessions'))
                    ->where('user_id', auth()->user()->getAuthIdentifier())
                    ->orderBy('last_activity', 'desc')
                    ->get()
        )->map(function ($session) {
            return (object) [
                'agent' =>  self::createAgent($session),
                'ip_address' => $session->ip_address,
                // 'is_current_device' => $session->id === request()->session()->getId(),
                'is_current_device' => $session->session_id === session()->get('session-identifier'),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    public static function saveSession($user)
    {
        $session_id = Str::uuid()->toString();
        session()->put('session-identifier', $session_id);

        DB::table(config('session.table', 'sessions'))
            ->insert([
                'id' => Str::random(40),
                'user_id' => $user->id,
                'ip_address' => request()->ip(),
                'user_agent' => substr((string) request()->header('User-Agent'), 0, 500),
                'payload' => base64_encode(json_encode(request()->session()->all())),
                'last_activity' => now()->getTimestamp(),
                'session_id' => $session_id
            ]);
    }

    public static function deleteSession($user)
    {
        DB::table(config('session.table', 'sessions'))
            ->where('user_id', $user->id)
            ->where('session_id', session()->get('session-identifier'))
            ->delete();

        session()->forget('session-identifier');
        session()->forget('login-datetime');
        session()->forget('super-auth');
    }

    public static function deleteOtherDeviceSessions($user)
    {
        DB::table(config('session.table', 'sessions'))
            ->where('user_id', $user->id)
            ->where('session_id', '<>', session()->get('session-identifier'))
            ->delete();
    }

    public static function deactivateAccount($user)
    {
        $user->forceFill([
            'is_active' => 0
        ])->save();
    }

    public static function getMyPassword()
    {
        if (!session()->has('my-password')) {
            return redirect()->route('profile')
                ->with('error-alert', 'Something went wrong. Please try again later.');
        }

        try {
            return Crypt::decryptString(session()->get('my-password'));
        } 
        catch (DecryptException $e) {
            abort(403);
        }
    }

    
    // not in use
    public static function generateRecoveryCode()
    {
        auth()->user()->forceFill([
            'two_factor_recovery_codes' => 
                encrypt(json_encode(Collection::times(8, function () {
                    return self::generateCode();
                })
            ->all())),
        ])->save();
    }

    public static function generateCode()
    {
        return Str::random(10).'-'.Str::random(10);
    }
}