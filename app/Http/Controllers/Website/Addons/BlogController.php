<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\BlogService;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = BlogService::_get($request);
        abort_if(!$blogs, 404);
        return view('addons.blog.index', compact('blogs'));
    }

    public function show(Request $request)
    {
        $web = check_web_page_type(true);

        abort_if(!$web['status'], 404);

        $result = BlogService::_find($web['web']->blog_id);
        $blog = $result['blog'];
        $prev_url = $result['prev_url'];
        $next_url = $result['next_url'];
        abort_if((!$blog), 404);

        return view('addons.blog.show', compact('blog', 'prev_url', 'next_url'));
    }
}
