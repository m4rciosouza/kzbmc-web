<?php
use Illuminate\Support\Facades\Facade;

/**
 * Define an Authentication Service Facade.
 * @author marciosouza
 *
 */
class AuthenticationService extends Facade 
{
	protected static function getFacadeAccessor() 
	{ 
		return 'authenticationservice'; 
	}
}