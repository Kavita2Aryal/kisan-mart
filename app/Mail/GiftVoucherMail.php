<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;
use File;
use Carbon\Carbon;

class GiftVoucherMail extends Mailable
{
    use Queueable, SerializesModels;
    public $_subject, $_msg_content, $_details, $_template;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $msg_content, $details, $template)
    {
        $this->_subject     = $subject;
        $this->_msg_content = $msg_content;
        $this->_details    = $details;
        $this->_template    = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path = public_path('storage\gift-voucher-pdf');
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0755, true, true);
        }
        $logo = storage_path('app/public/website/logo.svg');
        $mail = $this->view('mails.' . $this->_template)
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($this->_subject)
            ->with('body', $this->_msg_content);

        foreach($this->_details as $row)
        {
            $pdfName = str_replace(',', '', $this->_msg_content['client_name']) . '' . Carbon::now()->timestamp;
    
            $pdf = PDF::setOptions(['dpi' => 150, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]); // , 'defaultFont' => 'sans-serif', 'images' => true
            $pdf->loadView('pdf.gift-voucher', ['data' => $row, 'logo' => $logo, 'settings' => $this->_msg_content['settings'], 'currency' => $this->_msg_content['currency']])->save('' . $path . '/' . $pdfName . '.pdf');
            $mail->attachData($pdf->output(), $pdfName . '.pdf', ['mime' => 'application/pdf']);
        }
        return $mail;
    }
}
