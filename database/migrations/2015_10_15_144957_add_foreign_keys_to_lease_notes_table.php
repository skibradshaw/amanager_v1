<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLeaseNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lease_notes', function(Blueprint $table)
		{
			$table->foreign('leases_id', 'fk_lease_notes_leases1')->references('id')->on('leases')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('lease_notes', function(Blueprint $table)
		{
			$table->dropForeign('fk_lease_notes_leases1');
		});
	}

}
