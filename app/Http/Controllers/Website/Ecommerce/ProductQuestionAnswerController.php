<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\Ecommerce\ProductQuestionAnswerService;
use Auth;

class ProductQuestionAnswerController extends Controller
{
    public function save(Request $request)
    {
        // if($request->get('g-recaptcha-response') != null) {
        //     $captcha_check = checkRecaptcha_v3($request->get('g-recaptcha-response'));
        //     if ($captcha_check['success'] == true) { 
        if (ProductQuestionAnswerService::_save($request)) {
            return redirect()->back()->with('success-notify', 'Your question has been submitted successfully!');
        }
        return redirect()->back()->withInput()->with('error-notify', 'Sorry! Could not submit your question at the moment.');
        // }
        // }
        // return back()->with('error-notify', 'Something went wrong. Please try again later.');
    }
}
