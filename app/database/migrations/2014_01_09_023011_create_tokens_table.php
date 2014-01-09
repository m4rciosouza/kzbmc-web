<?php

use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'tokens', function( $table )
		{
			$table->engine = 'MyISAM';
			$table->increments( 'id' );
			$table->string( 'token', 32 )->unique();
			$table->integer( 'user_id' );
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
		Schema::drop( 'tokens' );
	}

}