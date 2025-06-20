<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\CurrencyRequest;
use App\Services\Ecommerce\CurrencyService;
use App\Services\Ecommerce\ExchangeRateService;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        $currencies = CurrencyService::_paging($request);
        return view('modules.ecommerce.currency.index', compact('currencies'));
    }

    public function create()
    {
        return view('modules.ecommerce.currency.create');
    }

    public function store(CurrencyRequest $request)
    {
        if ($uuid = CurrencyService::_storing($request)) {
            return redirect()->route('currency.exchange.rate.edit', [$uuid]);
        }
        return back()->withInput()->with('error', 'Sorry, could not create currency at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $currency = CurrencyService::_find($uuid);
        return view('modules.ecommerce.currency.edit', compact('currency'));
    }

    public function update(CurrencyRequest $request, $uuid)
    {
        if (CurrencyService::_updating($request, $uuid)) {
            return redirect()->route('currency.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update currency at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = CurrencyService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function exchange_rate(Request $request, $uuid)
    {
        $currency = CurrencyService::_find($uuid);
        $exchange_rate = ExchangeRateService::_find($currency->id);
        $exchange_rates = ExchangeRateService::_paging($request, $currency->id);
        return view('modules.ecommerce.currency.exchange-rate', compact('currency', 'exchange_rate', 'exchange_rates'));
    }

    public function exchange_rate_update(Request $request, $uuid)
    {
        $currency = CurrencyService::_find($uuid);
        if (ExchangeRateService::_updating($request, $currency->id)) {
            return redirect()->route('currency.exchange.rate.edit', [$uuid]);
        }
        return back()->withInput()->with('error', 'Sorry, could not update exchange rate at this time. Please try again later.');
    }
}
