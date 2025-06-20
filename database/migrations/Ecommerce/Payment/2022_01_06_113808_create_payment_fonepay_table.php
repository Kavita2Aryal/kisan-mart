<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentFonepayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_fonepay', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->unsigned();
            $table->string('PRN')->nullable();
            $table->string('UID')->nullable();
            $table->string('BID')->nullable();
            $table->string('account', 32)->nullable();
            $table->string('uniqueId', 32)->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('payment_fonepay');
    }
}
