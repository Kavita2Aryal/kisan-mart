<?php

namespace App\Console\Commands;

use App\Mail\AdminMailCartAbandon;
use App\Models\Addons\SocialMedia;
use App\Models\Ecommerce\CheckoutStatus;
use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;

class CheckCartAbandon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CartAbandon:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron job is used to check the cart abandoned of the customers and send them emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $data = CheckoutStatus::whereDate('date', '<', date('Y-m-d'))->get();
        if($data)
        {
            $admin_email = get_setting('admin-email');

            $settings = [];
            $settings['admin-email'] = get_setting('admin-email');
            $settings['contact-title'] = get_setting('contact-title');
            $settings['contact-phone'] = get_setting('contact-phone');
            $settings['contact-email'] = get_setting('contact-email');
            $settings['contact-mobile'] = get_setting('contact-mobile');
            $settings['contact-address'] = get_setting('contact-address');
            $social_medias = SocialMedia::orderBy('display_order', 'ASC')->get()->toArray();

            $msg_content['settings'] = $settings;
            $msg_content['social_medias'] = $social_medias;
            $msg_content['message']       = '<p>There are some customers who have abandoned cart. Please check cart abandon report for the details</p>';

            Mail::to($admin_email)->queue(new AdminMailCartAbandon("Cart Abandon", $msg_content, 'admin-cart-abandon'));
            echo "Mail send successfully !!";
            return Command::SUCCESS;
        }
    }
    public function forcustomerhandle()
    {
        $data = CheckoutStatus::select('customers.name', 'customers.email', 'customers.phone', 'customers.uuid as customer_uuid', DB::raw('COUNT(customer_id) as count'))
            ->join('customers', 'customers.id', '=', 'customer_id')
            ->whereDate('date', '<', date('Y-m-d'))
            ->groupBy('customers.name', 'customers.email', 'customers.phone', 'customer_uuid')
            ->orderBy('date', 'ASC')->get()->keyBy('customer_uuid');
        $customers = [];
        foreach ($data as $row) {
            if ($row->count > 1) {
                $customers[] = [
                    'name' => $row->name,
                    'email' => $row->email,
                    'phone' => $row->phone,
                ];
            }
        }

        $settings = [];
        $settings['admin-email'] = get_setting('admin-email');
        $settings['contact-title'] = get_setting('contact-title');
        $settings['contact-phone'] = get_setting('contact-phone');
        $settings['contact-email'] = get_setting('contact-email');
        $settings['contact-mobile'] = get_setting('contact-mobile');
        $settings['contact-address'] = get_setting('contact-address');
        $social_medias = SocialMedia::orderBy('display_order', 'ASC')->get()->toArray();

        $msg_content['settings'] = $settings;
        $msg_content['social_medias'] = $social_medias;

        $job = (new \App\Jobs\SendQueueEmail($customers, $msg_content))
            ->delay(now()->addSeconds(2));

        dispatch($job);
        echo "Mail send successfully !!";
        return Command::SUCCESS;
    }
}
