<?php

use Illuminate\Database\Migrations\Migration;

class CreateCanvasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'canvas', function( $table )
		{
			$table->engine = 'MyISAM';
			$table->increments( 'id' );
			$table->string( 'name', 50 );
			$table->string( 'description', 50 );
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
		Schema::drop( 'canvas' );
	}

}