<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListContentBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_content_bodies', function (Blueprint $table) {
            $table->id();
            $table->integer('head_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('list_config_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('link_title')->nullable();
            $table->string('link')->nullable();
            $table->integer('display_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_content_bodies');
    }
}
