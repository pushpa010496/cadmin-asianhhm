<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullabel();
            $table->string('sub_title')->nullabel();
            $table->text('description')->nullabel();
            $table->string('cms_url');                        
            $table->integer('author_id')->nullabel();
            $table->integer('active_flag')->nullabel();
            $table->string('title_tag')->nullabel();

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
        Schema::dropIfExists('cms_pages');
    }
}
