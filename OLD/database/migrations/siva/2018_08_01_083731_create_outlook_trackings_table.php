<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutlookTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlook_trackings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullabel();
            $table->string('name')->nullabel();
            $table->string('email')->nullabel();
            $table->string('subject')->nullabel();
            $table->string('message')->nullabel();
            $table->string('opens')->nullabel();
            $table->string('ip_address')->nullabel();
            $table->string('host')->nullabel();
            $table->string('from_mailid')->nullabel();
            $table->string('cc_mailid')->nullable();
            $table->string('bcc_mailid')->nullable();
            $table->dateTime('emaildelivery_date')->nullable();
            $table->dateTime('email_opended_date')->nullabel();
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
        Schema::dropIfExists('outlook_trackings');
    }
}
