<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identifiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('records_identifiers', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('record_id');
            $table->bigInteger('identifier_id');
            $table->foreign('record_id')->references('id')->on('records');
            $table->foreign('identifier_id')->references('id')->on('identifiers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identifiers');
        Schema::dropIfExists('records_identifiers');
    }
}
