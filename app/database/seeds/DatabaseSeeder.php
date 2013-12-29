<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call( 'CanvasTableSeeder' );
		$this->command->info( 'Canvas table seeded!' );
		
		$this->call( 'ItemsTableSeeder' );
		$this->command->info( 'Items table seeded!' );
	}
}