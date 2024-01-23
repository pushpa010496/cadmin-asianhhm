<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('callenders', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('sub_title')->nullable();
            $table->string('title')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('alt_tag')->nullable();    
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();
            $table->text('description')->nullable();
            $table->string('url');
            $table->integer('active_flag')->nullable();
            $table->integer('author_id')->nullable();          
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
        Schema::dropIfExists('callenders');
    }
}
