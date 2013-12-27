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
}