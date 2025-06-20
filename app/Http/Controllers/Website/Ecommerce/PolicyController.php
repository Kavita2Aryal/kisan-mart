<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policy = Policy::where('is_active', 10)->orderBy('created_at', 'DESC')->first();
        return view('ecommerce.policy.index', compact('policy'));
    }
}
