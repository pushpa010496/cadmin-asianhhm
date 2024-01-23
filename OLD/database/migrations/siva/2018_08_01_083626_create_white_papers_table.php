<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhitePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('white_papers', function (Blueprint $table) {
            $table->increments('id');

              $table->string('title')->nullabel();
            $table->text('description')->nullabel();
             $table->tinyInteger('home_whitepapers')->nullabel();
            $table->string('url');
            $table->string('image')->nullabel();
            $table->string('pdf')->nullabel();
            $table->string('type')->nullabel();
            $table->integer('author_id')->nullabel();
            $table->integer('active_flag')->nullabel();
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
        Schema::dropIfExists('white_papers');
    }
}
