<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_id');
            $table->string('title')->nullable();
            $table->string('ebook_image')->nullable();
            $table->string('magazine_image')->nullable();
            $table->text('ebook_script')->nullable();
            $table->text('ebook_script_home')->nullable();

            $table->string('topic_a')->nullable();
            $table->string('topic_b')->nullable();
            $table->string('topic_c')->nullable();
            $table->string('topic_d')->nullable();
            $table->string('topic_e')->nullable();
            $table->string('topic_f')->nullable();

            $table->string('url');
            $table->integer('active_flag')->nullabel();
            $table->integer('author_id')->nullabel();    
            $table->string('title_tag')->nullabel();
            $table->string('alt_tag')->nullabel();        
            $table->string('meta_title')->nullabel();
            $table->string('meta_keywords')->nullabel();
            $table->string('meta_description')->nullabel();
            $table->string('og_title')->nullabel();
            $table->string('og_description')->nullabel();
            $table->string('og_keywords')->nullabel();
            $table->string('og_image')->nullabel();
            $table->string('og_video')->nullabel();
            $table->string('meta_region')->nullabel();
            $table->string('meta_position')->nullabel();
            $table->string('meta_icbm')->nullabel();

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
        Schema::dropIfExists('ebooks');
    }
}
