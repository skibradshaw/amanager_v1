<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankAccountIdToBankDeposits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_deposits', function (Blueprint $table) {
            //
            $table->integer('bank_account_id')->unsigned()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_deposits', function (Blueprint $table) {
            //
            $table->dropColumn('bank_account_id');
        });
    }
}
