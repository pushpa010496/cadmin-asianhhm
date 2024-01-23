<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookShelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::dropIfExists('book_shelfs');
    }
}
