<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('title1')->nullable();
            $table->string('title2')->nullable();
            $table->text('author_details')->nullable();
            $table->longText('full_report')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('home_report')->nullable();
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
        Schema::dropIfExists('industry_reports');
    }
}
