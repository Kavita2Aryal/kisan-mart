<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('exchange_rate_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned();
            $table->string('order_code');
            $table->double('discount_amount', 8, 2)->unsigned();
            $table->double('vat_rate', 8, 2)->unsigned()->nullable();
            $table->double('vat_amount', 8, 2)->unsigned()->nullable();
            $table->double('delivery_charge', 8, 2)->unsigned();
            $table->double('sub_total', 8, 2)->unsigned();
            $table->double('total', 8, 2)->unsigned();
            $table->integer('promo_code')->nullable();
            $table->integer('gift_voucher')->nullable();
            $table->string('gift_voucher_option')->nullable();
            $table->integer('current_status');
            $table->integer('payment_type');
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}