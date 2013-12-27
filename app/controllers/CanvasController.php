<?php
/**
 * RESTFul API for the Canvas management.
 * 
 * @author marciosouza
 *
 */
class CanvasController extends BaseController
{
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
		//TODO
	}
	
	/**
	 * Create a new Canvas.
	 */
	public function create()
	{
		//TODO
	}
	
	/**
	 * Update a Canvas.
	 */
	public function update()
	{
		//TODO
	}
	
	/**
	 * Delete a Canvas.
	 */
	public function delete()
	{
		//TODO
	}
}