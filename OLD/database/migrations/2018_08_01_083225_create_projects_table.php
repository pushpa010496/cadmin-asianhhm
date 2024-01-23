<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');


            
            $table->string('title')->nullabel();
            $table->string('image')->nullabel();
            $table->text('description')->nullabel();
            $table->string('location')->nullabel();
            $table->string('project_name')->nullabel();
            $table->tinyInteger('home_project')->nullabel();
            $table->string('url');
            $table->string('commence')->nullable();
            $table->string('est_inv')->nullable();
            $table->string('capacity')->nullable();
            $table->string('key_player')->nullable();
            $table->string('completion')->nullable();
            $table->date('date')->nullabel();
            
            $table->integer('author_id')->nullabel();
            $table->integer('active_flag')->nullabel();
            
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
        Schema::dropIfExists('projects');
    }
}
