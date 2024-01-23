<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnoTrendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('techno_trends', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('top_image')->nullable();
            $table->string('pdf')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('home_technotrends')->nullable();
            $table->integer('author_id')->nullable();
            $table->integer('active_flag')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('alt_tag')->nullable();
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
        Schema::dropIfExists('techno_trends');
    }
}
