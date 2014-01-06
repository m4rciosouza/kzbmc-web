<?php
/**
 * Test the AuthenticationService
 * 
 * @author marciosouza
 *
 */
class AuthenticationTest extends TestCase
{
	
	public function setUp()
	{
		parent::setUp();
		$this->seed();
		Auth::loginUsingId( 1 );
	}
	
	public function testLogin()
	{
		$response = $this->action( 'POST', 'AuthenticationController@login', array( 
													'email' => 'admin@admin.com',
													'password' => 'admin' 
											) );
		$this->assertContains( 'admin', $response->getContent() );
		$this->assertContains( '1', $response->getContent() );
	}
	
	public function testLogout()
	{
		$response = $this->action( 'GET', 'AuthenticationController@logout' );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( trans( 'auth.logout_sucesso' ), $response->getContent() );
	}
	
	public function testViewUser()
	{
		$response = $this->action( 'GET', 'AuthenticationController@view', array( 'id' => '1' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'admin', $response->getContent() );
		$this->assertContains( '1', $response->getContent() );
	}
	
	public function testCreateUser()
	{
		$response = $this->action( 'POST', 'AuthenticationController@create' );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		$this->assertContains( 'email', $response->getContent() );
		$this->assertContains( 'password', $response->getContent() );
		
		$response = $this->action( 'POST', 'AuthenticationController@create', array(
						'email'    => 'user@email.com',
						'password' => 'user'
					) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '2', $response->getContent() );
	}
	
	public function testUpdateUser()
	{
		$response = $this->action( 'POST', 'AuthenticationController@update', array( 'id' => '2' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
	
		$response = $this->action( 'POST', 'AuthenticationController@update', array(
				'id' 		  => '1',
				'email' 	  => 'admin2@admin.com',
				'password' 	  => 'admin2',
		) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '1', $response->getContent() );
	}
	
	public function testDeleteUser()
	{
		$response = $this->action( 'DELETE', 'AuthenticationController@delete', array( 'id' => '2' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		
		$response = $this->action( 'DELETE', 'AuthenticationController@delete', array( 'id' => '1' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '1', $response->getContent() );
	}
}