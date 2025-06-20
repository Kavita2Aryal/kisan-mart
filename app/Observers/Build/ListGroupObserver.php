<?php

namespace App\Observers\Build;

use App\Models\Build\ListGroup;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class ListGroupObserver
{
    public function creating(ListGroup $list_group)
    {
        $list_group->user_id = auth()->user()->id;
        $list_group->uuid    = Str::uuid()->toString();
    }

    public function created(ListGroup $list_group)
    {
        LogService::queue('list-group', $list_group->name . ' - created');
        session()->flash('success', 'List Group has been created.');
        cache()->flush();
    }

    public function updated(ListGroup $list_group)
    {
        LogService::queue('list-group', $list_group->name . ' - updated');
        session()->flash('success', 'List Group has been updated.');
        cache()->flush();
    }

    public function deleted(ListGroup $list_group)
    {
        LogService::queue('list-group', $list_group->name . ' - deleted');
        session()->flash('success', 'List Group has been deleted.');
        cache()->flush();
    }
}
