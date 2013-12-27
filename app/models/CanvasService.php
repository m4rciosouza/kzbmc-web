<?php
namespace KZ\Services;

/**
 * Service that manage, process and return all the data based on Canvas service.
 * 
 * @author marciosouza
 *
 */
class CanvasService
{
	/**
	 * Return all the Canvas projects.
	 * 
	 * @param $orderBy Field to be ordered
	 * @param $direction ASC or DESC
	 * @return array
	 */
	public function getAll( $orderBy = 'name', $direction = 'ASC' )
	{
		return \Canvas::orderBy( $orderBy, $direction )->get();
	}
	
	/**
	 * Return a Canvas data by id.
	 * 
	 * @param integer $id
	 * @return array
	 */
	public function view( $id ) 
	{
		//TODO
		return array();
	}
	
	/**
	 * Create a new Canvas.
	 * 
	 * @return boolean
	 */
	public function create()
	{
		//TODO
		return TRUE;
	}
	
	/**
	 * Update a Canvas.
	 * 
	 * @return boolean
	 */
	public function update()
	{
		//TODO
		return TRUE;
	}
	
	/**
	 * Delete a Canvas.
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	public function delete( $id )
	{
		//TODO
		return TRUE;
	}
}