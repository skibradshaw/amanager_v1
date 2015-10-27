<?php
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder {
  public function run(){
    DB::table('users')->insert(array(
      array('username' => 'tim@alltrips.com', 'password' => Hash::make('jackass'),'is_admin' => true, 'firstname' => 'Tim','lastname' => 'Bradshaw','phone' => '3076904269','email' => 'tim@alltrips.com','license_state' => 'WY', 'license_plate' => '22-19057','type' => 'tenant', 'created_at' => new DateTime, 'updated_at' => new DateTime),
      array('username' => 'psroop@hotmail.com', 'password' => Hash::make('scott'),'is_admin' => true, 'firstname' => 'Scott','lastname' => 'Roop','phone' => '3076904269','email' => 'psroop@hotmail.com','license_state' => 'WY', 'license_plate' => '22-19057', 'type' => 'tenant', 'created_at' => new DateTime, 'updated_at' => new DateTime),

    ));
    
  }
}
