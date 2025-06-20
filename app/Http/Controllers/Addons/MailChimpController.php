<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Addons\MailChimpRequest;

use App\Services\Addons\MailChimpService;

class MailChimpController extends Controller
{

    public function index()
    {
        return view('modules.addons.mailchimp.index');
    }

    public function send_mail(MailChimpRequest $request)
    {
        if (MailChimpService::_send_email($request)) {;
            return redirect()->route('mailchimp.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not send the emails as this time. Please try again later.');
    }
}