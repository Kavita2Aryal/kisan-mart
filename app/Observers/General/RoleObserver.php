<?php

namespace App\Observers\General;

use App\Models\General\Role;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class RoleObserver
{
    public function creating(Role $role)
    {
        $role->user_id = auth()->user()->id;
        $role->uuid    = Str::uuid()->toString();
    }

    public function created(Role $role)
    {
        LogService::queue('role', $role->role . ' - created');
        session()->flash('success', 'Role has been created.');
        cache()->flush();
    }

    public function updated(Role $role)
    {
        if ($role->isDirty('is_active') && count($role->getDirty()) == 1) {
            LogService::queue('role', $role->role . ' - ' . ($role->is_active == 10 ? 'activated' : 'deactivated'));
        } else {
            LogService::queue('role', $role->role . ' - updated');
            session()->flash('success', 'Role has been updated.');
        }
        cache()->flush();
    }
}
