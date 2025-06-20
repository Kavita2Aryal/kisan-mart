<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftVoucherRedemptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_voucher_redemptions', function (Blueprint $table) {
            $table->id();
            $table->integer('gift_voucher_sale_id');
            $table->float('used_value');
            $table->boolean('is_fully_redeemed');
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
        Schema::dropIfExists('gift_voucher_redemptions');
    }
}
