<?php
use Illuminate\Database\Seeder;

class TokenTableSeeder extends Seeder
{
	public function run()
	{
		DB::table( 'tokens' )->delete();
		
		DB::statement( 'ALTER TABLE tokens AUTO_INCREMENT = 1' );
	
		Token::create( array(
			'token' 	=> '12345678912345678912345678912345',
			'user_id' 	=> '1', 
		));
	}
}