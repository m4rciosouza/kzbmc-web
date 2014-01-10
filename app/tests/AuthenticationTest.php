<?php
/**
 * Test the AuthenticationService
 * 
 * @author marciosouza
 *
 */
class AuthenticationTest extends TestCase
{
	public function __construct()
	{
		$this->tokenHeader = array( 'HTTP_AUTH_TOKEN' => '12345678912345678912345678912345' );
	}
	
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
		$this->assertContains( 'token', $response->getContent() );
	}
	
	public function testLogout()
	{
		$response = $this->action( 'GET', 'AuthenticationController@logout',
				array(), array(), array(), $this->tokenHeader );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( trans( 'auth.logout_sucesso' ), $response->getContent() );
	}
	
	public function testViewUser()
	{
		$response = $this->action( 'GET', 'AuthenticationController@view', array( 'id' => '1' ),
				array(), array(), $this->tokenHeader );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'admin', $response->getContent() );
		$this->assertContains( '1', $response->getContent() );
	}
	
	public function testCreateUser()
	{
		$response = $this->action( 'POST', 'AuthenticationController@create',
				array(), array(), array(), $this->tokenHeader );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		$this->assertContains( 'email', $response->getContent() );
		$this->assertContains( 'password', $response->getContent() );
		
		$response = $this->action( 'POST', 'AuthenticationController@create', array(
						'email'    => 'user@email.com',
						'password' => 'user'
					), array(), array(), $this->tokenHeader );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '2', $response->getContent() );
	}
	
	public function testUpdateUser()
	{
		$response = $this->action( 'POST', 'AuthenticationController@update', array( 'id' => '2' ),
				array(), array(), $this->tokenHeader );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
	
		$response = $this->action( 'POST', 'AuthenticationController@update', array(
				'id' 		  => '1',
				'email' 	  => 'admin2@admin.com',
				'password' 	  => 'admin2',
		), array(), array(), $this->tokenHeader );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '1', $response->getContent() );
	}
	
	public function testDeleteUser()
	{
		$response = $this->action( 'DELETE', 'AuthenticationController@delete', array( 'id' => '2' ),
				array(), array(), $this->tokenHeader );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		
		$response = $this->action( 'DELETE', 'AuthenticationController@delete', array( 'id' => '1' ),
				array(), array(), $this->tokenHeader );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '1', $response->getContent() );
	}
}