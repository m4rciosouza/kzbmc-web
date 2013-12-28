<?php
use Illuminate\Support\Facades\Facade;

/**
 * Define an Item Service Facade.
 * @author marciosouza
 *
 */
class ItemService extends Facade 
{
	protected static function getFacadeAccessor() 
	{ 
		return 'itemservice'; 
	}
}