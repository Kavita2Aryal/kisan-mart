<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function set_currency_preference(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'currency' => 'required|integer|gte:0', 
        ]);
        if (!$validator->fails()) { 
        	session(['_currency_preference' => $request->currency]);
	    	return redirect()->back(); 
	    }
	    return redirect()->back(); 
    }
}
