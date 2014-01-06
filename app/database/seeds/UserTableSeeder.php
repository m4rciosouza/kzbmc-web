<?php
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table( 'users' )->delete();
		
		DB::statement( 'ALTER TABLE users AUTO_INCREMENT = 1' );
	
		User::create( array(
			'email' 	=> 'admin@admin.com',
			'password' 	=> Hash::make( 'admin' ), 
			'active' 	=> '1',
		));
	}
}