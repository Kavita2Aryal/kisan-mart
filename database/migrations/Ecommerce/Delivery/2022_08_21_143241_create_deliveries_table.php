<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->unique();
            $table->string('day');
            $table->double('minimum_order_amount', 8, 2)->nullable();
            $table->tinyInteger('delivery_type')->comment('1=>freeDelivery  , 2=> discountOnDelivery');
            $table->tinyInteger('discount_type')->comment('1=>fixed,2=>percentage');
            $table->float('discount_value')->nullable();
            $table->boolean('is_active');
            $table->integer('user_id');
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
        Schema::dropIfExists('deliveries');
    }
}
