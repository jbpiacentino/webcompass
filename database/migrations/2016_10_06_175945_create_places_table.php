<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('path');
            $table->text('title')->nullable();
            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');
            $table->integer('scheme');
            //$table->integer('favicon_id')->unsigned()->nullable();
            //$table->foreign('favicon_id')->references('id')->on('favicons')->onDelete('cascade');
            //$table->integer('visit_count');
            //$table->integer('hidden');
            //$table->integer('typed');
            //$table->integer('frecency');
            //$table->datetime('last_visit_date')->nullable();
            //$table->text('guid');
            //$table->integer('foreign_count');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
