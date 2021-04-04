<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_violations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id');
            $table->integer('violation_id')->unsigned();
            $table->string('date');
            $table->string('location');
            $table->string('transaction_status');
            $table->foreign('violation_id')->references('id')->on('violations');
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
        Schema::dropIfExists('driver_violations');
    }
}
