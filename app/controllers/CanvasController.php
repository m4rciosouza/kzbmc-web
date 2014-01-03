<?php
/**
 * RESTFul API for the Canvas management.
 * 
 * @author marciosouza
 *
 */
class CanvasController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter( 'serviceAuth' );
	}
	
	/**
	 * List all the Canvas.
	 * 
	 * @return JSON
	 */
	public function listAll()
	{
		return Response::json( CanvasService::getAll() );
	}
	
	/**
	 * Return data of an specific Canvas.
	 * 
	 * @return JSON
	 */
	public function view()
	{
		return Response::json( CanvasService::view() );
	}
	
	/**
	 * Create a new Canvas.
	 */
	public function create()
	{
		return Response::json( CanvasService::create() );
	}
	
	/**
	 * Update a Canvas.
	 */
	public function update()
	{
		return Response::json( CanvasService::update() );
	}
	
	/**
	 * Delete a Canvas.
	 */
	public function delete()
	{
		return Response::json( CanvasService::delete() );
	}
}