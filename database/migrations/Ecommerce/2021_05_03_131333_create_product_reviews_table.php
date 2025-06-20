<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->float('rating_count');
            $table->string('title', 100)->nullable();
            $table->text('comment')->nullable();
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('customer_id')->nullable();
            $table->tinyInteger('spam_count')->default(0);
            $table->boolean('reply_status')->default(0);
            $table->string('reply', 100)->nullable();
            $table->float('temp_rating_count')->nullable();
            $table->text('temp_comment')->nullable();
            $table->boolean('is_reviewed')->default(0);
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('product_reviews');
    }
}