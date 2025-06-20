<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\ContactMessageService;
use App\Services\General\ExportService;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
    	$contacts = ContactMessageService::_paging($request);
        return view('modules.addons.contact.index', compact('contacts'));
    }

    public function export_csv()
    {
        $contacts = ContactMessageService::_get();
        $contacts = ContactMessageService::_format_for_csv($contacts);
        return ExportService::csv($contacts, 'contact-messages');
    }

    public function export_pdf()
    {
        $contacts = ContactMessageService::_get();
        return ExportService::pdf($contacts, 'contact-messages', 'contact_message');
    }
}
