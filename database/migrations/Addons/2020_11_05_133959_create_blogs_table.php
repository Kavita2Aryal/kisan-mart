<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('category_id')->nullable();
            $table->text('title');
            $table->text('subtitle')->nullable();
            $table->integer('intro_image_id')->nullable();
            $table->integer('banner_image_id')->nullable();
            $table->integer('author_id')->nullable();
            $table->boolean('is_active');
            $table->text('keywords')->nullable();
            $table->date('published_at')->nullable();
            $table->integer('user_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('blogs');
    }
}
