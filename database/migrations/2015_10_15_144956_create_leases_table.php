<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('apartment_id')->unsigned()->index();
			$table->dateTime('startdate')->nullable();
			$table->dateTime('enddate')->nullable();
			$table->decimal('monthly_rent', 13)->default(0.00);
			$table->decimal('pet_rent', 13)->default(0.00);
			$table->decimal('deposit', 13)->default(0.00);
			$table->decimal('pet_deposit', 13)->default(0.00);
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
		Schema::drop('leases');
	}

}
