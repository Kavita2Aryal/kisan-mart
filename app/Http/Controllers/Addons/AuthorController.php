<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\AuthorService;
use App\Http\Requests\Addons\AuthorRequest;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $authors = AuthorService::_paging($request);
        return view('modules.addons.author.index', compact('authors'));
    }

    public function create()
    {
        return view('modules.addons.author.create');
    }

    public function store(AuthorRequest $request)
    {
        if (AuthorService::_storing($request)) {
            return redirect()->route('author.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create author at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $author = AuthorService::_find($uuid);
        return view('modules.addons.author.edit', compact('author'));
    }

    public function update(AuthorRequest $request, $uuid)
    {
        if (AuthorService::_updating($request, $uuid)) {
            return redirect()->route('author.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update author at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (AuthorService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the author at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = AuthorService::_change_status($uuid);
        return response()->json($response, 200);
    }
}