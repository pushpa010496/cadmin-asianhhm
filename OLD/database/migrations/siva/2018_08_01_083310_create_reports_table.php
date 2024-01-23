<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->string('cat_name')->nullable();
            $table->string('publisher')->nullable();
            $table->dateTIme('publication_date')->nullable();
            $table->string('delivery_format')->nullable();
            $table->string('country')->nullable();
            $table->string('market')->nullable();
            $table->string('sector')->nullable();
            $table->integer('pages')->nullable();
            $table->string('single_user')->nullable();
            $table->string('site_licence')->nullable();
            $table->string('global_site_license')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('scope')->nullable();
            $table->text('reason_to_buy')->nullable();
            $table->text('pressrelease')->nullable();
            $table->longText('table_of_contents')->nullable();
            $table->text('list_of_tables')->nullable();
            $table->text('list_of_figures')->nullable();
            $table->text('companies_mentioned')->nullable();
            $table->text('keywords')->nullable();
            $table->string('report_url')->nullable();
            $table->integer('active_flag')->nullable();
            $table->integer('author_id')->nullable();
            $table->tinyInteger('home_report')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('xml_file_name')->nullable();

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
        Schema::dropIfExists('reports');
    }
}
