<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->increments('id');
             $table->string('fullname')->nullable(); 
            $table->string('designation')->nullable();          
            $table->string('company')->nullable(); 
            $table->integer('country_id')->nullable(); 
            $table->string('country_name')->nullable(); 
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();            
            $table->string('email')->nullable();
            $table->text('description')->nullable();  
            $table->text('count')->nullable();  
            $table->text('newsletter')->nullable();  
            $table->text('weeklyupdate')->nullable();        
            $table->text('promotions')->nullable();        
            $table->text('magazine_de')->nullable();        
            $table->text('current_newsletter')->nullable();        
            $table->text('content_newsletter')->nullable();
            $table->text('special_offers')->nullable();        
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
        Schema::dropIfExists('subscribers');
    }
}
