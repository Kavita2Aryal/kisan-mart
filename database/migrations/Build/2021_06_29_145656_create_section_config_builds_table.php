<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionConfigBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_config_builds', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('filename', 100)->unique();
            $table->json('config');
            $table->json('list_config')->nullable();
            $table->json('type_config')->nullable();
            $table->json('styles')->nullable();
            $table->json('scripts')->nullable();
            $table->integer('display_order');
            $table->boolean('is_active');
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('section_config_builds');
    }
}
