<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Services\Auth\FortifyService;
use App\Events\Auth\DeactivateAccount;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user();
        $browserSessions = FortifyService::getSessions();

        return view('auth.profile', compact('profile', 'browserSessions'));
    }

    public function logoutOtherDevices()
    {
        $password = FortifyService::getMyPassword();
        Auth::logoutOtherDevices($password); 
        
        return redirect()->route('profile')
            ->with('success', 'You have been logout from all other devices.');
    }

    public function deactivateAccount()
    {
        $user = Auth::user();
        event(new DeactivateAccount($user));
        
        $password = FortifyService::getMyPassword();
        Auth::logoutOtherDevices($password);
        Auth::logout();

        return redirect()->route('profile')
            ->with('info', 'Your account has been deactivated.');
    }
}