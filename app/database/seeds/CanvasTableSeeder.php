<?php
use Illuminate\Database\Seeder;

class CanvasTableSeeder extends Seeder
{
	public function run()
	{
		DB::table( 'canvas' )->delete();
		
		DB::statement( 'ALTER TABLE canvas AUTO_INCREMENT = 1' );
	
		Canvas::create( array(
			'name' 			=> 'Project #1',
			'description' 	=> 'Description of Project #1', 
			'user_id'		=> '1',
		));
		
		Canvas::create( array(
			'name' 			=> 'Project #2',
			'description' 	=> 'Description of Project #2',
			'user_id'		=> '1',
		));
	}
}