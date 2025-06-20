<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\SizeRequest;
use App\Services\Ecommerce\SizeService;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        $sizes = SizeService::_paging($request);
        return view('modules.ecommerce.size.index', compact('sizes'));
    }

    public function create()
    {
        return view('modules.ecommerce.size.create');
    }

    public function store(SizeRequest $request)
    {
        if (SizeService::_storing($request)) {
            return redirect()->route('size.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create size at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $size = SizeService::_find($uuid);
        return view('modules.ecommerce.size.edit', compact('size'));
    }

    public function update(SizeRequest $request, $uuid)
    {
        if (SizeService::_updating($request, $uuid)) {
            return redirect()->route('size.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update size at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = SizeService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function search(Request $request) 
    {
        $data = [];
        if ($request->ajax()) {
            if(isset($request->q)) {
                $data = SizeService::_search($request->q);
            }
            return response()->json($data);
        }
        abort(404);
    }
}
