<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentAllocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_allocation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->unsigned()->index('fk_allocation_payment_idx');
            $table->integer('month');
            $table->integer('year');
            $table->decimal('amount',13,2);
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
        Schema::drop('payment_allocation');
    }
}
