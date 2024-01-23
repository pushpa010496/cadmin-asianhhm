<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');

            $table->string('client_name')->nullabel();
            $table->string('client_designation')->nullabel();
            $table->string('company_name')->nullabel();
            $table->text('description')->nullabel();
            $table->string('test_url')->nullabel();
            $table->string('title_tag')->nullabel();
            $table->integer('active_flag')->nullabel();
            $table->integer('author_id')->nullabel();
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
        Schema::dropIfExists('testimonials');
    }
}
