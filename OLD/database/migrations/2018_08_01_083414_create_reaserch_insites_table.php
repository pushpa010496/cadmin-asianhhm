<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReaserchInsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reaserch_insites', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('author_details')->nullable();
            $table->text('description')->nullable();
            $table->date('published_date')->nullable();
            $table->string('url');                        
            $table->integer('author_id')->nullable();
            $table->integer('active_flag')->nullable();            
            $table->string('title_tag')->nullable();
            $table->string('alt_tag')->nullable();
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
        Schema::dropIfExists('reaserch_insites');
    }
}
