<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueAdvertisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_advertisers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_id');
            $table->string('title');
            $table->integer('author_id')->nullable();
            $table->integer('active_flag')->nullable();
            $table->text('description')->nullable();
            $table->string('url');
            $table->string('cover_image')->nullable();
            $table->tinyInteger('home_issueadvertiser')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('issue_advertisers');
    }
}
