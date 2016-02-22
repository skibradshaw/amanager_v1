<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDepositAndPetdepositColumnsFromLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leases', function (Blueprint $table) {
            //
            $table->dropColumn('deposit');
            $table->dropColumn('pet_deposit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leases', function (Blueprint $table) {
            //
            $table->decimal('pet_deposit', 13)->default(0.00);
            $table->decimal('deposit', 13)->default(0.00);            
        });
    }
}
