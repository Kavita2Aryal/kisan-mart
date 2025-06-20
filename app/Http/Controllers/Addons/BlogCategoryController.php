<?php

namespace App\Http\Controllers\Addons;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Addons\Blog\BlogCategoryService;
use App\Http\Requests\Addons\BlogCategoryRequest;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategoryService::_paging($request, false);
        return view('modules.addons.blog-category.index', compact('categories'));
    }

    public function create()
    {
        return view('modules.addons.blog-category.create');
    }

    public function store(BlogCategoryRequest $request)
    {
        if (BlogCategoryService::_storing($request)) {
            return redirect()->route('blog.category.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create blog category at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $category = BlogCategoryService::_find($uuid);
        return view('modules.addons.blog-category.edit', compact('category'));
    }

    public function update(BlogCategoryRequest $request, $uuid)
    {
        if (BlogCategoryService::_updating($request, $uuid)) {
            return redirect()->route('blog.category.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update blog category at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (BlogCategoryService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the blog category at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = BlogCategoryService::_change_status($uuid);
        return response()->json($response, 200);
    }
}
