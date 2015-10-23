<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lease_id')->unsigned()->index();
			$table->string('item_name')->nullable();
			$table->string('note')->nullable();
			$table->integer('month')->nullable();
			$table->integer('year');
			$table->dateTime('due_date')->nullable();
			$table->decimal('amount', 13);
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
		Schema::drop('fees');
	}

}
