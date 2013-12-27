<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}
	
	public function testMockFacadeExample()
	{
		/*CanvasService::shouldReceive('getAllCanvas')->once()->andReturn(
			'[{"id":"1","name":"Projeto #1","description":"Descrição do Projeto #1","created_at":"2013-12-27 00:34:40","updated_at":"2013-12-27 00:34:40"}]'
		);*/
		//$mock = m::mock('simplemock');
		//$mock->shouldReceive('foo')->with(5, m::any())->once()->andReturn(10);
		//$this->assertEquals(10, $mock->foo(5));
		
		$crawler = $this->client->request('GET', 'usuarios');
		$this->assertTrue($this->client->getResponse()->isOk());
		$this->assertCount(1, $crawler->filter('h1:contains("Listagem")'));
		//$this->assertCount(1, $crawler->filter('h2:contains("10")'));
		//$this->assertCount(1, $crawler->filter('table:contains("Projeto #1")'));
		$this->assertViewHas('canvas');
	}

	public function testMockFacadeJsonExample()
	{
		/*CanvasService::shouldReceive('getAllCanvas')->once()->andReturn(
		 '[{"id":"1","name":"Projeto #1","description":"Descrição do Projeto #1","created_at":"2013-12-27 00:34:40","updated_at":"2013-12-27 00:34:40"}]'
		);*/
		//$mock = m::mock('simplemock');
		//$mock->shouldReceive('foo')->with(5, m::any())->once()->andReturn(10);
		//$this->assertEquals(10, $mock->foo(5));
	
		$crawler = $this->client->request('GET', 'usuarios/json');
		$this->assertTrue($this->client->getResponse()->isOk());
		//$this->assertCount(1, $crawler->filter('body:contains("Steve")'));
	}
}