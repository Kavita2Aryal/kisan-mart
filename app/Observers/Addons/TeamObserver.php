<?php

namespace App\Observers\Addons;

use App\Models\Addons\Team;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class TeamObserver
{
    public function creating(Team $team)
    {
        $team->user_id = auth()->user()->id;
        $team->uuid    = Str::uuid()->toString();
    }

    public function saved(Team $team)
    {
        if ($team->wasRecentlyCreated) {
            LogService::queue('team', $team->name . ' - created');
            session()->flash('success', 'Team member has been created.');
        } else if ($team->isDirty('is_active') && count($team->getDirty()) == 2) {
            LogService::queue('team', $team->name . ' - ' . ($team->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('team', $team->name . ' - updated');
            session()->flash('success', 'Team member has been updated.');
        }
        cache()->flush();
    }

    public function deleted(Team $team)
    {
        LogService::queue('team', $team->name . ' - deleted');
        session()->flash('success', 'Team has been deleted.');
        cache()->flush();
    }
}
