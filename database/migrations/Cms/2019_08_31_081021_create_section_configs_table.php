<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_configs', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->integer('section_index');
            $table->string('section_filename', 100);
            $table->boolean('has_title');
            $table->boolean('has_subtitle');
            $table->boolean('has_description');
            $table->boolean('has_image');
            $table->boolean('has_slider');
            $table->boolean('has_link');
            $table->boolean('has_video');
            $table->boolean('has_list');
            $table->integer('no_of_images');
            $table->integer('no_of_sliders');
            $table->integer('no_of_videos');
            $table->integer('has_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_configs');
    }
}
