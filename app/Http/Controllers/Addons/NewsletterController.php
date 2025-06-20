<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\NewsletterClientService;
use App\Services\General\ExportService;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
    	$clients = NewsletterClientService::_paging($request);
        return view('modules.addons.newsletter.index', compact('clients'));
    }

    public function export_csv()
    {
        $clients = NewsletterClientService::_get();
        $clients = NewsletterClientService::_format_for_csv($clients);
        return ExportService::csv($clients, 'newsletter-emails');
    }

    public function export_pdf()
    {
        $clients = NewsletterClientService::_get();
        return ExportService::pdf($clients, 'newsletter-emails', 'newsletter_email');
    }
}