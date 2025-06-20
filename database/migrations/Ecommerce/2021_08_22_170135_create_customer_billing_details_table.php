<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_billing_details', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned();
            $table->string('full_name');
            $table->text('address_line_1');
            $table->string('phone_number', 30)->nullable();
            $table->text('address_line_2')->nullable();
            $table->integer('city')->nullable();
            $table->integer('country')->nullable();
            $table->integer('region')->nullable();
            $table->integer('area')->nullable();
            $table->integer('zip')->nullable();
            $table->boolean('is_active');
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
        Schema::dropIfExists('customer_billing_details');
    }
}
