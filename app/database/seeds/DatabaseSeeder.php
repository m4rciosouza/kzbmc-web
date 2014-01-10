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
		
		$this->call( 'UserTableSeeder' );
		$this->command->info( 'User table seeded!' );
		
		$this->call( 'TokenTableSeeder' );
		$this->command->info( 'Token table seeded!' );
	}
}