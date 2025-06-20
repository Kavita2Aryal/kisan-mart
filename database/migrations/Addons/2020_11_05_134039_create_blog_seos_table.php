<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_seos', function (Blueprint $table) {
            $table->id();
            $table->integer('blog_id');
            $table->text('meta_title');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->integer('image_id');
            $table->text('image_alt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_seos');
    }
}
