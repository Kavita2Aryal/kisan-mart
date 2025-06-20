<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\CountryRequest;
use App\Services\Ecommerce\CountryService;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = CountryService::_paging($request);
        return view('modules.ecommerce.country.index', compact('countries'));
    }

    public function create()
    {
        return view('modules.ecommerce.country.create');
    }

    public function store(CountryRequest $request)
    {
        if (CountryService::_storing($request)) {
            return redirect()->route('country.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create country at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $country = CountryService::_find($uuid);
        return view('modules.ecommerce.country.edit', compact('country'));
    }

    public function update(CountryRequest $request, $uuid)
    {
        if (CountryService::_updating($request, $uuid)) {
            return redirect()->route('country.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update country at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = CountryService::_change_status($uuid);
        return response()->json($response, 200);
    }
}
