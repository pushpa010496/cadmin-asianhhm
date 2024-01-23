<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullabel();
             $table->string('sub_title')->nullabel();
            $table->string('image')->nullabel();            
            $table->text('description')->nullabel();                            
            $table->string('title_tag')->nullabel();
            $table->string('alt_tag')->nullabel();
            $table->integer('author_id')->nullabel();
            $table->integer('active_flag')->nullabel();

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
        Schema::dropIfExists('onlines');
    }
}
