<?php

namespace App\Observers\General;

use App\Models\General\User;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user)
    {
        $user->uuid = Str::uuid()->toString();
    }

    public function created(User $user)
    {
        LogService::queue('user', $user->name . '[' . $user->email . '] - account created');
        session()->flash('success', 'User has been created.');
        cache()->flush();
    }

    public function updated(User $user)
    {
        if ($user->isDirty('is_active') && count($user->getDirty()) == 2) {
            LogService::queue('user', $user->name . '[' . $user->email . '] - account ' . ($user->is_active == 10 ? 'activated' : 'deactivated'));
        } else {
            LogService::queue('user', $user->name . '[' . $user->email . '] - account updated');
            session()->flash('success', 'User has been updated.');
        }
        cache()->flush();
    }
}
