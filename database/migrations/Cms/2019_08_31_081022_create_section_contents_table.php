<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->uuid('uuid')->unique();
            $table->integer('page_id')->unsigned();
            $table->integer('config_id')->unsigned();
            $table->text('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->boolean('is_active');
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
        Schema::dropIfExists('section_contents');
    }
}
