<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\Blog\BlogService;
use App\Http\Requests\Addons\BlogRequest;
use App\Models\Addons\Author;
use App\Models\Addons\Blog\BlogCategory;

class BlogController extends Controller
{
    public function index(Request $request)
    {   
        $website_domain = get_setting('website-domain');
        $blogs = BlogService::_paging($request, false);
        return view('modules.addons.blog.index', compact('blogs', 'website_domain'));
    }

    public function create()
    {
        $website_domain = get_setting('website-domain');
        $authors = Author::where('is_active', '10')->get();
        $blog_categories = BlogCategory::where('is_active', '10')->get();
        return view('modules.addons.blog.create', compact('authors', 'blog_categories', 'website_domain'));
    }

    public function store(BlogRequest $request)
    {
        if (BlogService::_storing($request)) {
            return redirect()->route('blog.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update blog at this time. Please try again later.');
    }

    public function edit($uuid)
    { 
    	$blog = BlogService::_find($uuid);
        $website_domain = get_setting('website-domain');
        $authors = Author::where('is_active', '10')->get();
        $blog_categories = BlogCategory::where('is_active', '10')->get();
        return view('modules.addons.blog.edit', compact('blog', 'authors', 'blog_categories', 'website_domain'));
    }

    public function update(BlogRequest $request, $uuid)
    {
        if (BlogService::_updating($request, $uuid)) {
            return redirect()->route('blog.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update blog at this time. Please try again later.');
    }

    public function trash(Request $request)
    {
        $website_domain = get_setting('website-domain');
        $blogs = BlogService::_paging($request, true);
        return view('modules.addons.blog.trash', compact('blogs', 'website_domain'));
    }

    public function soft_delete($uuid)
    {
        if (BlogService::_soft_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the blog at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (BlogService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the blog at this time. Please try again later.');
    }

    public function restore($uuid)
    {
        if (BlogService::_restoring($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not restore the blog at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = BlogService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function generate_form(Request $request)
    {
        $index = $request->index; 
        if ($request->type == 'image_gallery') {
            $html = view('includes.addons-image-gallery-form', compact('index'))->render();
        }
        else {
            $html = view('includes.addons-description-form', compact('index'))->render();
        }
        return response()->json(['html' => $html], 200);
    }
    
    public function check(BlogRequest $request)
    {
        return response()->json(true, 200);
    }
}