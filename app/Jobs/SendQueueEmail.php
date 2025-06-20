<?php

namespace App\Jobs;

use App\Mail\CartAbandonMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $customers, $msg_content;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customers, $msg_content)
    {
        $this->customers = $customers;
        $this->msg_content = $msg_content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->customers as $row) {
            $email = $row['email'];

            $this->msg_content['title']           = 'Dear ' . $row['name'];
            $this->msg_content['message']         = '<p>We noticed you were shopping on our site and you left some items behind in your cart. Was there a problem we can help with?</p><p>If you need assistance, feel welcome to contact us..</p>';
            Mail::to($email)->queue(new CartAbandonMail("It looks like you left something behind.", $this->msg_content, 'cart-abandon'));
        }
    }
}
