<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->nullable();
            $table->integer('gift_voucher_id')->nullable();
            $table->string('product_sku')->nullable();
            $table->integer('requested_qty')->unsigned();
            $table->integer('qty')->unsigned();
            $table->double('price', 8, 2)->unsigned()->nullable();
            $table->double('actual_price', 8, 2)->unsigned()->nullable();
            $table->boolean('is_reviewed')->default(0);
            $table->text('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}