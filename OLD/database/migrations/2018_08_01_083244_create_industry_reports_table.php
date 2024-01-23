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
            $table->integer('author_id')->nullable();
            $table->integer('active_flag')->nullable();

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
        Schema::dropIfExists('industry_reports');
    }
}
