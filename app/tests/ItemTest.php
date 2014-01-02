<?php
/**
 * Test the ItemService
 * 
 * @author marciosouza
 *
 */
class ItemTest extends TestCase
{
	
	public function setUp()
	{
		parent::setUp();
		$this->seed();
	}
	
	public function testListItem()
	{
		$response = $this->action( 'GET', 'ItemController@listAll', array( 'id' => 1 ) );
	
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'Item #1', $response->getContent() );
		$this->assertContains( 'Item #2', $response->getContent() );
	}
	
	public function testViewItem()
	{
		$response = $this->action( 'GET', 'ItemController@view', array( 'id' => 1 ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'Item #1', $response->getContent() );
		$this->assertContains( 'Item #1 of Project #1', $response->getContent() );
	}
	
	public function testCreateItem()
	{
		$response = $this->action( 'POST', 'ItemController@create' );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		$this->assertContains( 'title', $response->getContent() );
		$this->assertContains( 'description', $response->getContent() );
		$this->assertContains( 'type', $response->getContent() );
		$this->assertContains( 'color', $response->getContent() );
		$this->assertContains( 'canvas id', $response->getContent() );
		
		$response = $this->action( 'POST', 'ItemController@create', array(
						'title'		  => 'Item #4',
						'description' => 'Description Item #4 of Project #1',
						'type' 		  => 'pc',
						'color' 	  => 'warning',
						'canvas_id'	  => '1',
					) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '4', $response->getContent() );
		$response = $this->action( 'GET', 'ItemController@view', array( 'id' => '4' ) );
		$this->assertContains( '"order":2', $response->getContent() );
	}
	
	public function testUpdateItem()
	{
		$response = $this->action( 'POST', 'ItemController@update', array( 'id' => '3' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		$this->assertContains( 'title', $response->getContent() );
		$this->assertContains( 'description', $response->getContent() );
		$this->assertContains( 'type', $response->getContent() );
		$this->assertContains( 'color', $response->getContent() );
		$this->assertContains( 'canvas id', $response->getContent() );
	
		$response = $this->action( 'POST', 'ItemController@update', array(
				'id' 		  => '3',
				'title'		  => 'Item #4',
				'description' => 'Description Item #4 of Project #1',
				'type' 		  => 'ac',
				'color' 	  => 'warning',
				'canvas_id'	  => '1',
		) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '3', $response->getContent() );
	}
	
	public function testDeleteItem()
	{
		$response = $this->action( 'DELETE', 'ItemController@delete', array( 'id' => '5' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'msgs', $response->getContent() );
		
		$response = $this->action( 'DELETE', 'ItemController@delete', array( 'id' => '3' ) );
		$this->assertTrue( $response->isOk() );
		$this->assertContains( '3', $response->getContent() );
	}
	
	public function testReorderItem()
	{
		$response = $this->action( 'POST', 'ItemController@reorder', array( 
							'canvasId' 	=> '1',
							'type'		=> 'pc',
							'posIni'	=> '0',
							'posEnd'	=> '1' 
						));
		$this->assertTrue( $response->isOk() );
		$this->assertContains( 'canvasId', $response->getContent() );
		$response = $this->action( 'GET', 'ItemController@view', array( 'id' => '1' ) );
		$this->assertContains( '"order":1', $response->getContent() );
		$response = $this->action( 'GET', 'ItemController@view', array( 'id' => '2' ) );
		$this->assertContains( '"order":0', $response->getContent() );
	}
}