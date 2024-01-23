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
            $table->integer('author_id')->nullabel();
            $table->integer('active_flag')->nullabel();
            $table->string('pdf')->nullabel();
            $table->string('image')->nullabel();
            $table->string('title_tag')->nullabel();
            $table->string('alt_tag')->nullabel();
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
