<?php

namespace App\Services\Addons;

use App\Services\General\LogService;

class MailChimpService
{
    public static function _send_email($req)
    {
        $listId = config('app.config.mailchimp.mailchimp_list_id');

        $mailchimp = new \Mailchimp(config('app.config.mailchimp.mailchimp_api_key')); 

        $campaign = $mailchimp->campaigns->create('regular', [
            'list_id' => $listId,
            'subject' => $req->subject,
            'from_email' => get_setting('admin-email') ?? $req->from_email,
            'from_name' => $req->from_name,
            'to_name' => ''

        ], [
            'html' => "<p>".$req->body."</p>", //custom email template goes here.
            //'text' => "hello this is text",
        ]);

        //Send campaign
        if($mailchimp->campaigns->send($campaign['id'])){
            LogService::queue('mailchimp', 'mailchimp newsletter email sent');
            session()->flash('success', 'MailChimp Email has been sent.');
            return true;
        }
        return false;
    }
}