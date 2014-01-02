<?php
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
	public function run()
	{
		DB::table( 'items' )->delete();
		
		DB::statement( 'ALTER TABLE items AUTO_INCREMENT = 1' );
	
		Item::create( array(
			'title' 	  => 'Item #1',
			'description' => 'Description Item #1 of Project #1',
			'color'		  => 'info',
			'type' 		  => 'pc',
			'order'		  => '0',
			'canvas_id'   => '1',	 
		));
		
		Item::create( array(
			'title' 	  => 'Item #2',
			'description' => 'Description Item #2 of Project #1',
			'color'		  => 'warning',
			'type' 		  => 'pc',
			'order'		  => '1',
			'canvas_id'   => '1',
		));
		
		Item::create( array(
			'title' 	  => 'Item #3',
			'description' => 'Description Item #3 of Project #1',
			'color'		  => 'danger',
			'type' 		  => 'fr',
			'order'		  => '0',
			'canvas_id'   => '1',
		));
	}
}