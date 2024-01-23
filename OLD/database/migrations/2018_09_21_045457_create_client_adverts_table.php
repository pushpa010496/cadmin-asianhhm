<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_adverts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_id');
            $table->string('title')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('alt_tag')->nullable();    
            $table->string('client_advert_image')->nullable();
            $table->string('client_advert_cover_image')->nullable();
            $table->text('description')->nullable();
            $table->string('url');
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
        Schema::dropIfExists('client_adverts');
    }
}
