<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lease_id')->unsigned()->index();
			$table->integer('tenant_id')->unsigned()->index();
			$table->integer('payment_types_id')->unsigned()->index('fk_payments_payment_types1_idx');
			$table->integer('bank_deposits_id')->unsigned()->index('fk_payments_bank_deposits1_idx');
			$table->string('method')->nullable();
			$table->string('memo')->nullable();
			$table->dateTime('paid_date')->nullable();
			$table->decimal('amount', 13)->default(0.00);
			$table->string('check_no', 45)->nullable();
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
		Schema::drop('payments');
	}

}
