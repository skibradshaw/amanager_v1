<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertyIdToBankDepositsTable extends Migration
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
            $table->integer('property_id')->unsigned()->after('user_id');
            $table->foreign('property_id','fk_property_id')->references('id')->on('properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_property_id');
            $table->dropColumn('property_id');
        });
    }
}
