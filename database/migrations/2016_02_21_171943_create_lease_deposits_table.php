<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lease_id')->unsigned();
            $table->string('deposit_type')->nullable();
            $table->decimal('amount',13)->default(0.00);
            $table->decimal('paid', 13)->default(0.00);
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
        Schema::drop('lease_deposits');
    }
}
