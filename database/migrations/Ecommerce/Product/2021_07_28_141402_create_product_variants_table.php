<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned();
            $table->string('sku')->unique();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->string('variant')->nullable();
            $table->integer('qty')->nullable();
            $table->double('selling_price', 8, 2)->nullable();
            $table->double('compare_price', 8, 2)->nullable();
            $table->double('cost_price', 8, 2)->nullable();
            $table->boolean('is_default')->nullable();
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
