<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DbBackup extends Mailable
{
    use Queueable, SerializesModels;

    public $_filename, $_display_filename;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filename, $display_filename)
    {
        $this->_filename = $filename;
        $this->_display_filename = $display_filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.db_backup')
                        ->from(env('MAIL_FROM_ADDRESS'))
                        ->subject('Database Backup - ' . date('Y-m-d H:i:s'))
                        ->attachFromStorage($this->_filename, $this->_display_filename);
    }
}
