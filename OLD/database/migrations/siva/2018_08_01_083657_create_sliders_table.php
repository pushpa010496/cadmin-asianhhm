<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullabel();             
            $table->string('url');
            $table->string('imagepath')->nullabel();
            $table->text('description')->nullabel();
            $table->string('position')->nullabel();            
            $table->integer('active_flag')->nullabel();
            $table->integer('author_id')->nullabel();
            $table->string('title_tag')->nullabel();
            $table->string('alt_tag')->nullabel();

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
        Schema::dropIfExists('sliders');
    }
}
