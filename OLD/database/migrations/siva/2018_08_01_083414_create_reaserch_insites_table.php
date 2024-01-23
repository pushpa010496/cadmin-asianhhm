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

            $table->string('title')->nullabel();
            $table->string('sub_title')->nullabel();
            $table->text('author_details')->nullabel();
            $table->text('description')->nullabel();
            $table->date('published_date')->nullabel();
            $table->string('url');
            $table->tinyInteger('home_reaserch')->nullabel();
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
        Schema::dropIfExists('reaserch_insites');
    }
}
