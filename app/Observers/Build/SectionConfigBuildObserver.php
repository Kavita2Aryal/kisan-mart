<?php

namespace App\Observers\Build;

use App\Models\Build\SectionConfigBuild;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class SectionConfigBuildObserver
{
    public function creating(SectionConfigBuild $section)
    {
        $section->user_id = auth()->user()->id;
        $section->uuid    = Str::uuid()->toString();
    }

    public function created(SectionConfigBuild $section)
    {
        LogService::queue('section-config', $section->name . ' - created');
        session()->flash('success', 'Section Config has been created.');
        cache()->flush();
    }

    public function updated(SectionConfigBuild $section)
    {
        if ($section->isDirty('is_active') && count($section->getDirty()) == 2) {
            LogService::queue('section-config', $section->name . ' - ' . ($section->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('section-config', $section->name . ' - updated');
            session()->flash('success', 'Section Config has been updated.');
        }
        cache()->flush();
    }

    public function deleted(SectionConfigBuild $section)
    {
        LogService::queue('section-config', $section->name . ' - deleted');
        session()->flash('success', 'Section Config has been deleted.');
        cache()->flush();
    }
}
