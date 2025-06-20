<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('image_link')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->text('keywords')->nullable();
            $table->integer('is_combo_product')->default('0');
            $table->integer('brand_id')->nullable();
            $table->text('video_url')->nullable();
            $table->boolean('has_variant');
            $table->boolean('show_qty')->nullable();
            $table->integer('hit_count');
            $table->integer('purchase_count');
            $table->boolean('out_of_stock')->default(0);
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
        Schema::dropIfExists('products');
    }
}
