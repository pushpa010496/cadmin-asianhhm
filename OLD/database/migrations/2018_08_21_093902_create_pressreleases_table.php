<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePressreleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pressreleases', function (Blueprint $table) {
           $table->increments('id');
            $table->date('date');
            $table->string('title');
            $table->string('location')->nullable();
            $table->string('img_title');
            $table->string('image');
            $table->string('img_alt');
            $table->string('url');
            $table->string('home_title')->nullable();
            $table->string('home_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('active_flag')->nullable();
            $table->integer('author_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_video')->nullable();
            $table->string('meta_region')->nullable();
            $table->string('meta_position')->nullable();
            $table->string('meta_icbm')->nullable();        
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
        Schema::dropIfExists('pressreleases');
    }
}
