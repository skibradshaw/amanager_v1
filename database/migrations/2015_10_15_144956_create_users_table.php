<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username')->nullable();
			$table->string('password')->nullable();
			$table->boolean('is_admin')->default(0);
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('phone', 12)->nullable();
			$table->string('email')->nullable()->unique();
			$table->string('license_state')->nullable();
			$table->string('license_plate')->nullable();
			$table->boolean('active')->default(1);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
