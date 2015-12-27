<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToLeaseDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lease_details', function (Blueprint $table) {
            //
            $table->foreign('lease_id','fk_lease_details_lease1')->references('id')->on('leases')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lease_details', function (Blueprint $table) {
            //
            $table->dropForeign('fk_lease_details_lease1');
        });
    }
}
