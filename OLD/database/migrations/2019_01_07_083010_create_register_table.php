<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register', function (Blueprint $table) {
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
            $table->string('title')->nullable();  
            $table->string('newsletter')->nullable();  
            $table->string('weeklyupdate')->nullable();        
            $table->string('promotions')->nullable();        
            $table->string('magazine_de')->nullable();        
            $table->string('current_newsletter')->nullable();        
            $table->string('content_newsletter')->nullable();
            $table->string('special_offers')->nullable();    
            $table->string('purpose')->nullable();        
            $table->string('advmedia')->nullable();        
            $table->string('product_of_interest')->nullable();        
            $table->string('industry')->nullable();        
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
        Schema::dropIfExists('register');
    }
}
