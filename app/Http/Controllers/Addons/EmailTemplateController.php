<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\EmailTemplateService;
use App\Http\Requests\Addons\EmailTemplateRequest;

class EmailTemplateController extends Controller
{
    public function index(Request $request)
    {
        $templates = EmailTemplateService::_paging($request);
        return view('modules.addons.email-template.index', compact('templates'));
    }

    public function create()
    {
        return view('modules.addons.email-template.create');
    }

    public function store(EmailTemplateRequest $request)
    {
        if (EmailTemplateService::_storing($request)) {
            return redirect()->route('email.template.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create Email Template at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $template = EmailTemplateService::_find($uuid);
        return view('modules.addons.email-template.edit', compact('template'));
    }

    public function update(EmailTemplateRequest $request, $uuid)
    {
        if (EmailTemplateService::_updating($request, $uuid)) {
            return redirect()->route('email.template.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update Email Template at this time. Please try again later.');
    }
}
