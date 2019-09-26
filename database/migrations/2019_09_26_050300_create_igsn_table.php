<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIgsnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igsn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('igsn');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('igsn_clients');
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
        Schema::dropIfExists('igsn');
    }
}
