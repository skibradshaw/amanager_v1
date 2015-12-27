<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lease_id')->unsigned();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();            
            $table->decimal('monthly_rent', 13)->default(0.00);
            $table->decimal('monthly_pet_rent', 13)->default(0.00);
            $table->decimal('multiplier');
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
        Schema::drop('lease_details');
    }
}
