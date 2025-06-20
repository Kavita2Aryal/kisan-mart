<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CartAbandonMail extends Mailable
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $_subject, $_msg_content, $_template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $msg_content, $template)
    {
        $this->_subject     = $subject;
        $this->_msg_content = $msg_content;
        $this->_template    = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.' . $this->_template)
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($this->_subject)
            ->with('body', $this->_msg_content);
    }
}
