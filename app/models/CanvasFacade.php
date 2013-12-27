<?php
use Illuminate\Support\Facades\Facade;

/**
 * Define a Canvas Service Facade.
 * @author marciosouza
 *
 */
class CanvasService extends Facade 
{
	protected static function getFacadeAccessor() 
	{ 
		return 'canvasservice'; 
	}
}