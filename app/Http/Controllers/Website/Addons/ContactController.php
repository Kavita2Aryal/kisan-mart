<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use DB;

use App\Mail\InstantMail;

use App\Http\Requests\ContactRequest;
use App\Services\Addons\ContactService;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        if (ContactService::_storing($request)) {
            $contact_phone = get_setting('contact-phone');
            $msg = "<p>Dear " . $request->name . ",</p><p>Thank you for contacting us through our website.<br>A member of our staff will contact you regarding your enquiry with all the requested details within 24 hours. In case you need to urgently speak to a member of our staff, please feel free to call us at " .$contact_phone. "</p>";
            return back()->with('success-modal', $msg);
        }
        return back()->with('error-notify', 'Something went wrong. Please try again later.');
    }

    public function store_sample_for_v3(ContactRequest $request)
    {
        if (checkRecaptcha_v3($request->get('recaptcha'))) {
            if (ContactService::_storing()) {
                return back()->with('success-notify', 'Thank You for contacting us.');
            }
        }
        return back()->with('error-notify', 'Something went wrong. Please try again later.');
    }
}
