<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookShelf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('book_shelfs', function (Blueprint $table) {
            $table->increments('id');

             $table->string('title')->nullabel();
             $table->string('sub_title')->nullabel();  
             $table->integer('no_pages')->nullabel(); 
             $table->string('publisher')->nullabel();
             $table->dateTime('publisher_date')->nullabel();
            $table->string('bookshelf_image')->nullabel();
            $table->string('authors')->nullable();
            $table->text('description')->nullabel();
            $table->string('url');
            $table->tinyInteger('home_bookshelf')->nullable();

            $table->integer('author_id')->nullabel();
            $table->integer('active_flag')->nullabel();
            $table->string('title_tag')->nullabel();
            $table->string('alt_tag')->nullabel();
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
        //
        Schema::dropIfExists('book_shelfs');
    }
}
