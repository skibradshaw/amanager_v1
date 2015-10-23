<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLeasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('leases', function(Blueprint $table)
		{
			$table->foreign('apartment_id')->references('id')->on('apartments')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('leases', function(Blueprint $table)
		{
			$table->dropForeign('leases_apartment_id_foreign');
		});
	}

}
