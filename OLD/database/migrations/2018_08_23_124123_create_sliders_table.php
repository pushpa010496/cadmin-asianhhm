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
            $table->string('title');
            $table->string('url');
            $table->string('position')->nullable();
            $table->string('pages')->nullable();
            $table->string('type');
            $table->string('image');
            $table->string('img_title');
            $table->string('img_alt');
            $table->string('script')->nullable();
            $table->date('from_date');
            $table->date('to_date');

            $table->integer('author_id');
            $table->integer('active_flag')->default('0');
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
