<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPaymentAllocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
 		Schema::table('payment_allocation', function(Blueprint $table)
		{
			$table->foreign('payment_id', 'fk_allocation_payment')->references('id')->on('payments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::table('payment_allocation', function(Blueprint $table)
		{
			$table->dropForeign('fk_allocation_payment');
		});
    }
}
