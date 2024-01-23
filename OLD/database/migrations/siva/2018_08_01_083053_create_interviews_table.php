<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('title')->nullable();
            $table->text('quest_answer')->nullable();
            $table->tinyInteger('home_interview')->nullable();
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('pdf')->nullable();
            $table->string('title_tag')->nullabel();
            $table->string('alt_tag')->nullabel();        
            $table->string('url')->nullable();            
            $table->integer('author_id')->nullabel();
            $table->integer('active_flag')->nullabel();          

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
        Schema::dropIfExists('interviews');
    }
}
