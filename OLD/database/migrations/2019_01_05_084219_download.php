<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Download extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname')->nullable(); 
            $table->string('designation')->nullable();          
            $table->string('company')->nullable(); 
            $table->integer('country_id')->nullable(); 
            $table->string('country_name')->nullable(); 
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();        
            $table->string('type')->nullable();            
            $table->integer('active_flag')->nullable();                                                     
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
        Schema::dropIfExists('downloads');
    }
}
