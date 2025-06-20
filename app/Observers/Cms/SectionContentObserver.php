<?php

namespace App\Observers\Cms;

use App\Models\Cms\Page\SectionContent;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class SectionContentObserver
{
    public function creating(SectionContent $section)
    {
        $section->uuid = Str::uuid()->toString();
    }

    public function saved(SectionContent $section)
    {
        if ($section->wasRecentlyCreated) {
            LogService::queue('section-content', $section->name . ' - created');
            session()->flash('success', 'Section Content has been created.');
        } else if ($section->isDirty('is_active') && count($section->getDirty()) == 2) {
            LogService::queue('section-content', $section->name . ' - ' . ($section->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('section-content', $section->name . ' - updated');
            session()->flash('success', 'Section Content has been updated.');
        }
        cache()->flush();
    }

    public function deleted(SectionContent $section)
    {
        LogService::queue('section-content', $section->name . ' - deleted');
        session()->flash('success', 'Section Content has been deleted.');
        cache()->flush();
    }
}
