<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSublessorToLeaseTenant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lease_tenant', function (Blueprint $table) {
            //
            $table->text('sublessor_name')->nullable()->after('tenant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lease_tenant', function (Blueprint $table) {
            //
            $table->dropColumn('sublessor_name');
        });
    }
}
