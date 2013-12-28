<?php
/**
 * Canvas class, contain the data of a Canvas project.
 * 
 * @author marciosouza
 * @property name
 * @property description
 *
 */
class Canvas extends Eloquent 
{
	protected $table = 'canvas';
	
	protected $visible = array( 'id', 'name', 'description' );
	
	/**
	 * Set the request attrs.
	 */
	public function setAttributes()
	{
		$this->name 		= Input::get( 'name' );
		$this->description 	= Input::get( 'description' );
	}
	
	/**
	 * Validate the data.
	 * 
	 * @return array
	 */
	public function validate()
	{
		$validator = Validator::make(
				Input::all(),
				array(
						'name' 			=> 'required|max:50',
						'description' 	=> 'required|max:50',
				)
		);
		if ($validator->fails())
		{
			return $validator->messages();
		}
		return FALSE;
	}
}