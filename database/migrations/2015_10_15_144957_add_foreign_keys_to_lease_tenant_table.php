<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLeaseTenantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lease_tenant', function(Blueprint $table)
		{
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
		Schema::table('lease_tenant', function(Blueprint $table)
		{
			$table->dropForeign('lease_tenant_lease_id_foreign');
			$table->dropForeign('lease_tenant_tenant_id_foreign');
		});
	}

}
