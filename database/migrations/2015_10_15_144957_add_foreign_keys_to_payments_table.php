<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('payments', function(Blueprint $table)
		{
			$table->foreign('bank_deposits_id', 'fk_payments_bank_deposits1')->references('id')->on('bank_deposits')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('lease_id')->references('id')->on('leases')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('tenant_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('payments', function(Blueprint $table)
		{
			$table->dropForeign('fk_payments_bank_deposits1');
			$table->dropForeign('payments_lease_id_foreign');
			$table->dropForeign('payments_tenant_id_foreign');
		});
	}

}
