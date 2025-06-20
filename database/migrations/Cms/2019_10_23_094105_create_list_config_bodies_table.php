<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListConfigBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_config_bodies', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('has_title');
            $table->tinyInteger('has_subtitle');
            $table->tinyInteger('has_description');
            $table->tinyInteger('has_image');
            $table->tinyInteger('has_link');
            $table->tinyInteger('has_icon');
            $table->integer('no_of_images');
            $table->integer('head_id');
            $table->integer('config_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_config_bodies');
    }
}
