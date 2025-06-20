<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvMail extends Mailable
{
    use Queueable, SerializesModels;

    public $_data, $_template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $template)
    {
        $this->_data = $data;
        $this->_template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->view('mails.'.$this->_template)
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                        ->subject($this->_data->subject)
                        ->with('body', $this->_data->message);

        $attachments = $this->_data->attachments;
        if ($attachments != 'n/a') {
            $attachments = json_decode($attachments);
            foreach($attachments as $attach) {
                $mail->attachFromStorage('public/attachment/'.$attach->filename, $attach->display_filename);
            }
        }

        return $mail;
    }
}
