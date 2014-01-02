<?php
/**
 * Item class, store the items of a Canvas project.
 * 
 * @author marciosouza
 * @property integer id
 * @property string title
 * @property string description
 * @property string color
 * @property string type
 * @property integer order
 * @property integer canvas_id
 *
 */
class Item extends Eloquent
{
	const TYPE_PC  = 'pc';
	const TYPE_AC  = 'ac';
	const TYPE_RC  = 'rc';
	const TYPE_PV  = 'pv';
	const TYPE_RCL = 'rcl';
	const TYPE_CA  = 'ca';
	const TYPE_SC  = 'sc';
	const TYPE_EC  = 'ec';
	const TYPE_FR  = 'fr';
	
	protected $visible = array( 'id', 'title', 'description', 'color', 'type', 'order' );
	
	/**
	 * Set the request attrs.
	 */
	public function setAttributes()
	{
		$this->title 		= Input::get( 'title' );
		$this->description 	= Input::get( 'description' );
		$this->color 		= Input::get( 'color' );
		$this->type 		= Input::get( 'type' );
		$this->canvas_id	= Input::get( 'canvas_id', Input::get( 'canvasId' ) );
	}
	
	/**
	 * Validate the data.
	 *
	 * @return array
	 */
	public function validate()
	{
		$validator = Validator::make(
				array(
						'title' 		=> $this->title,
						'description' 	=> $this->description,
						'color' 		=> $this->color,
						'type' 			=> $this->type,
						'canvas_id' 	=> $this->canvas_id,
				),
				array(
						'title' 		=> 'required|max:50',
						'description' 	=> 'required',
						'color' 		=> 'required|max:50',
						'type' 			=> 'required|max:3',
						'canvas_id' 	=> 'required',
				)
		);
		if ($validator->fails())
		{
			return $validator->messages();
		}
		return FALSE;
	}
}