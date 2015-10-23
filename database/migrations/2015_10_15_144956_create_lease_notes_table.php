<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeaseNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lease_notes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('note', 500)->nullable();
			$table->integer('leases_id')->unsigned()->index('fk_lease_notes_leases1_idx');
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
		Schema::drop('lease_notes');
	}

}
