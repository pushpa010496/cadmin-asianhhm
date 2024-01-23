<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_markets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullabel();
            $table->string('sub_title')->nullabel();
            $table->string('image')->nullabel();
            $table->string('pdf')->nullabel();
            $table->text('description')->nullabel();
            $table->string('target_url');            
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
        Schema::dropIfExists('target_markets');
    }
}
