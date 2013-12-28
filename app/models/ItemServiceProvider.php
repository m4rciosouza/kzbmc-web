<?php
use Illuminate\Support\ServiceProvider;

/**
 * Service Provider for the Canvas Service.
 * @author marciosouza
 *
 */
class ItemServiceProvider extends ServiceProvider 
{
	public function register()
	{
		$this->app->bind( 'itemservice', function()
		{
			return new KZ\Services\ItemService;
		});
	}
}