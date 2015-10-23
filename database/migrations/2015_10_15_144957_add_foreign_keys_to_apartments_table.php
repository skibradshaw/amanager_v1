<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToApartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('apartments', function(Blueprint $table)
		{
			$table->foreign('properties_id', 'fk_apartments_properties1')->references('id')->on('properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('apartments', function(Blueprint $table)
		{
			$table->dropForeign('fk_apartments_properties1');
		});
	}

}
