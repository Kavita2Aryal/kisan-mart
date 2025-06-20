<?php

namespace App\Observers\Addons;

use App\Models\Addons\Blog\BlogCategory;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class BlogCategoryObserver
{
    public function creating(BlogCategory $category)
    {
        $category->user_id = auth()->user()->id;
        $category->uuid    = Str::uuid()->toString();
    }

    public function saved(BlogCategory $category)
    {
        if ($category->wasRecentlyCreated) {
            LogService::queue('blog-category', $category->name . ' - created');
            session()->flash('success', 'Blog Category has been created.');
        } else if ($category->isDirty('is_active') && count($category->getDirty()) == 2) {
            LogService::queue('blog-category', $category->name . ' - ' . ($category->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('blog-category', $category->name . ' - created');
            session()->flash('success', 'Blog Category has been created.');
        }
        cache()->flush();
    }

    public function deleted(BlogCategory $category)
    {
        LogService::queue('blog-category', $category->name . ' - deleted');
        session()->flash('success', 'Blog Category has been deleted.');
        cache()->flush();
    }
}
