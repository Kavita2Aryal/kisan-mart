<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('blog_id');
            $table->text('description')->nullable();
            $table->string('video_url', 100)->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->json('image_gallery')->nullable();
            $table->tinyInteger('display_type');
            $table->tinyInteger('display_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_contents');
    }
}
