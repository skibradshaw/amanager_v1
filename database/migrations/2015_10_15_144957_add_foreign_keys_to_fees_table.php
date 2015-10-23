<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fees', function(Blueprint $table)
		{
			$table->foreign('lease_id')->references('id')->on('leases')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fees', function(Blueprint $table)
		{
			$table->dropForeign('fees_lease_id_foreign');
		});
	}

}
