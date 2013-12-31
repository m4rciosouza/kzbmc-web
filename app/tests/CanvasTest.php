<?php
/**
 * Test the CanvasService
 * 
 * @author marciosouza
 *
 */
class CanvasTest extends TestCase
{
	
	public function setUp()
	{
		parent::setUp();
		$this->seed();
	}
	
	public function testListCanvas()
	{
		//CanvasService::shouldReceive( 'getAll' )->once()->andReturn( '[{"id":"1","nome":"Project #1","descricao":"Description of Project #1","itens":{"pc":[{"id":"1","titulo":"Item #1","descricao":"Description Item #1 of Project #1","cor":"info"},{"id":"2","titulo":"Item #2","descricao":"Description Item #2 of Project #1","cor":"warning"}],"ac":"","rc":"","pv":"","rcl":"","ca":"","sc":"","ec":"","fr":[{"id":"3","titulo":"Item #3","descricao":"Description Item #3 of Project #1","cor":"danger"}]}},{"id":"2","nome":"Project #2","descricao":"Description of Project #2","itens":{"pc":"","ac":"","rc":"","pv":"","rcl":"","ca":"","sc":"","ec":"","fr":""}}]' );
		
		$response = $this->action( 'GET', 'CanvasController@listAll' );
	
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'Project #1', $response->getContent() );
		$this->assertContains( 'Project #2', $response->getContent() );
		$this->assertContains( 'Item #1', $response->getContent() );
	}
	
	public function testViewCanvas()
	{
		$response = $this->action( 'GET', 'CanvasController@view', array( 'id' => 1 ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'Project #1', $response->getContent() );
		$this->assertContains( 'Item #1', $response->getContent() );
	}
	
	public function testCreateCanvas()
	{
		$response = $this->action( 'POST', 'CanvasController@create' );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		$this->assertContains( 'name', $response->getContent() );
		$this->assertContains( 'description', $response->getContent() );
		
		$response = $this->action( 'POST', 'CanvasController@create', array(
						'name' 		  => 'Project #3',
						'description' => 'Description of Project #3'
					) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '3', $response->getContent() );
	}
	
	public function testUpdateCanvas()
	{
		$response = $this->action( 'POST', 'CanvasController@update', array( 'id' => '2' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		$this->assertContains( 'name', $response->getContent() );
		$this->assertContains( 'description', $response->getContent() );
	
		$response = $this->action( 'POST', 'CanvasController@update', array(
				'id' 		  => '2',
				'name' 		  => 'Project #4',
				'description' => 'Description of Project #4'
		) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '2', $response->getContent() );
	}
	
	public function testDeleteCanvas()
	{
		$response = $this->action( 'DELETE', 'CanvasController@delete', array( 'id' => '5' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		
		$response = $this->action( 'DELETE', 'CanvasController@delete', array( 'id' => '2' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '2', $response->getContent() );
	}
}