<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIgsnPrefixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igsn_prefixes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prefix');
            $table->timestamps();
        });

        Schema::create('igsn_client_prefix', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('prefix_id');
            $table->foreign('client_id')->references('id')->on('igsn_clients');
            $table->foreign('prefix_id')->references('id')->on('igsn_prefixes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igsn_prefixes');
        Schema::dropIfExists('igsn_client_prefix');
    }
}
