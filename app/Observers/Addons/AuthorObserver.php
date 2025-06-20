<?php

namespace App\Observers\Addons;

use App\Models\Addons\Author;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class AuthorObserver
{
    public function creating(Author $author)
    {
        $author->user_id = auth()->user()->id;
        $author->uuid    = Str::uuid()->toString();
    }

    public function saved(Author $author)
    {
        if ($author->wasRecentlyCreated) {
            LogService::queue('author', $author->title . ' - created');
            session()->flash('success', 'Author has been created.');
        } else if ($author->isDirty('is_active') && count($author->getDirty()) == 2) {
            LogService::queue('Author', $author->name . ' - ' . ($author->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('Author', $author->title . ' - updated');
            session()->flash('success', 'Author has been updated.');
        }
        cache()->flush();
    }

    public function deleted(Author $author)
    {
        LogService::queue('author', $author->name . ' - deleted');
        session()->flash('success', 'Author has been deleted.');
        cache()->flush();
    }
}
