<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->tinyInteger('type')->comment('1=>all_product,2=>include,3=>exclude');
            $table->tinyInteger('discount_type')->comment('1=>fixed,2=>percentage');
            $table->float('discount_value');
            $table->integer('minimum_purchase')->default(0);
            $table->integer('maximum_usage')->default(1);
            $table->integer('used_count');
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
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
        Schema::dropIfExists('promo_codes');
    }
}
