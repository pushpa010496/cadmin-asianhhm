<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('url');
            $table->string('position')->nullable();
            $table->string('pages')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable();            
            $table->string('img_title')->nullable();            
            $table->string('img_alt')->nullable();            
            $table->string('script')->nullable();    
            $table->date('from_date');                    
            $table->date('to_date');                    
            $table->integer('author_id')->nullable();
            $table->integer('active_flag')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('alt_tag')->nullable();

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
        Schema::dropIfExists('banners');
    }
}
