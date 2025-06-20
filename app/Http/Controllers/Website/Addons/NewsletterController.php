<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsletterRequest;
use App\Services\Addons\NewsletterService;

class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request)
    {
        if ($request->get('g-recaptcha-response') != null) {
            $captcha_check = checkRecaptcha_v3($request->get('g-recaptcha-response'));
            if ($captcha_check['success'] == true) { 
                if (NewsletterService::_storing($request)) {
                    $contact_phone = get_setting('contact-phone');
                    $msg = "<p>Dear " . $request->email . ",</p><p>Thank you for subscribing our newsletter.<br>In case you need to urgently speak to a member of our staff, please feel free to call us at " .$contact_phone. "</p>";
                    return back()->with('success-modal', $msg);
                }
            }
        }
        return back()->with('error-notify', 'Something went wrong. Please try again later.');
    }
}