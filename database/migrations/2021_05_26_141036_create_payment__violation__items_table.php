<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentViolationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment__violation__items', function (Blueprint $table) {
            $table->integer('DV_id')->unsigned();
            $table->integer('transaction_id');
            $table->string('total');
            $table->timestamps();
            $table->foreign('DV_id')->references('id')->on('driver_violations');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment__violation__items');
    }
}
