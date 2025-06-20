<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftVoucherSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_voucher_sales', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('order_id')->unsigned();
            $table->uuid('gift_voucher_uuid');
            $table->string('verification_code')->unique();
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
        Schema::dropIfExists('gift_voucher_sales');
    }
}
