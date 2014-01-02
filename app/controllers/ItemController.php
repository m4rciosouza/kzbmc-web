<?php
/**
 * RESTFul API for the Item management.
 * 
 * @author marciosouza
 *
 */
class ItemController extends BaseController
{
	/**
	 * List all Items of a Canvas.
	 * 
	 * @return JSON
	 */
	public function listAll()
	{
		return Response::json( ItemService::getAll() );
	}
	
	/**
	 * Return data of an specific Item.
	 * 
	 * @return JSON
	 */
	public function view()
	{
		return Response::json( ItemService::view() );
	}
	
	/**
	 * Create a new Item.
	 */
	public function create()
	{
		return Response::json( ItemService::create() );
	}
	
	/**
	 * Update an Item.
	 */
	public function update()
	{
		return Response::json( ItemService::update() );
	}
	
	/**
	 * Delete an Item.
	 */
	public function delete()
	{
		return Response::json( ItemService::delete() );
	}
	
	/**
	 * Reorder an Item.
	 */
	public function reorder()
	{
		return Response::json( ItemService::reorder() );
	}
}