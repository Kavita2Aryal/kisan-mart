<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductSelectedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_selected', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('product_id')->nullable();
            $table->string('product_sku')->nullable();
            $table->integer('qty')->unsigned();
            $table->double('price', 8, 2)->unsigned()->nullable();
            $table->double('actual_price', 8, 2)->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_selected');
    }
}
