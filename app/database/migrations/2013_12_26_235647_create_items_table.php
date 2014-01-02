<?php

use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'items', function( $table )
		{
			$table->engine = 'MyISAM';
			$table->increments( 'id' );
			$table->string( 'title', 50 );
			$table->text( 'description' );
			$table->string( 'color', 50 );
			$table->string( 'type', 3 );
			$table->integer( 'order' );
			$table->integer( 'canvas_id' );
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
		Schema::drop( 'items' );
	}

}