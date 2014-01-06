<?php
use Illuminate\Support\ServiceProvider;

/**
 * Service Provider for the Authentication Service.
 * 
 * @author marciosouza
 *
 */
class AuthenticationServiceProvider extends ServiceProvider 
{
	public function register()
	{
		$this->app->bind( 'authenticationservice', function()
		{
			return new KZ\Services\AuthenticationService;
		});
	}
}