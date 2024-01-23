<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullabel();
            $table->string('speaker')->nullabel();  
            $table->string('image')->nullabel();
            $table->string('speaker_designation')->nullabel();
            $table->string('date')->nullabel();
            $table->string('url');
            $table->string('view_name')->nullabel();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('title_tag')->nullabel();
            $table->string('alt_tag')->nullabel();
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
        Schema::dropIfExists('webinars');
    }
}
