<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Category;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class CategoryObserver
{
    public function creating(Category $category)
    {
        $category->user_id = auth()->user()->id;
        $category->uuid    = Str::uuid()->toString();
    }

    public function saved(Category $category)
    {
        if ($category->wasRecentlyCreated) {
            LogService::queue('category', $category->name . ' - created');
            session()->flash('success', 'Category has been created.');
            session()->flash('success', 'Area has been created.');
        } else if ($category->isDirty('is_active') && count($category->getDirty()) == 2) {
            LogService::queue('category', $category->name . ' - ' . ($category->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('category', $category->name . ' - updated');
            session()->flash('success', 'category has been updated.');
        }
        cache()->flush();
    }
}
