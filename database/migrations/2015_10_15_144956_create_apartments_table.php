<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apartments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('properties_id')->unsigned()->index('fk_apartments_properties1_idx');
			$table->string('name')->nullable();
			$table->integer('number')->nullable();
			$table->boolean('active')->default(1);
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
		Schema::drop('apartments');
	}

}
