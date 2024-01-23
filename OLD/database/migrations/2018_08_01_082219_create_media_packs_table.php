<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaPacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_packs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');            
            $table->text('description')->nullable();
            $table->integer('author_id')->nullable();
            $table->integer('active_flag')->nullable();
            $table->string('pdf')->nullable();
            $table->string('image')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('alt_tag')->nullable();
            $table->string('url');
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
        Schema::dropIfExists('media_packs');
    }
}
