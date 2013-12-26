<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'usuarios', function( $table )
		{
			$table->increments( 'id' );
			$table->string( 'email' )->unique();
			$table->string( 'nome' );
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
		Schema::drop( 'usuarios' );
	}

}