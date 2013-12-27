<?php
use Illuminate\Support\ServiceProvider;

/**
 * Service Provider for the Canvas Service.
 * @author marciosouza
 *
 */
class CanvasServiceProvider extends ServiceProvider 
{
	public function register()
	{
		$this->app->bind( 'canvasservice', function()
		{
			return new KZ\Services\CanvasService;
		});
	}
}