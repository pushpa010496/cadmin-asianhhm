<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorGuidelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_guidelines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();
            $table->text('description')->nullable();
            $table->integer('author_id')->nullabel();
            $table->integer('active_flag')->nullabel();
            $table->string('url');
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
        Schema::dropIfExists('author_guidelines');
    }
}
