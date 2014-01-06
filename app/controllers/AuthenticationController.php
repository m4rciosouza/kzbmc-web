<?php
/**
 * RESTFul API for the Authentication management.
 * 
 * @author marciosouza
 *
 */
class AuthenticationController extends BaseController
{
	/**
	 * Do the logout.
	 *
	 * @return Response
	 */
	public function logout()
	{
		return AuthenticationService::logout();
	}

	/**
	 * Do the login.
	 *
	 * @return Response
	 */
	public function login()
	{
		return AuthenticationService::login();
	}
	
	/**
	 * Create a new user
	 *
	 * @return JSON
	 */
	public function create()
	{
		return Response::json( AuthenticationService::create() );
	}

	/**
	 * Updates an user.
	 *
	 * @return JSON
	 */
	public function update($id)
	{
		if( ! Auth::check() )
		{
			return Response::json( [ 'flash' => 'you should be connect to access this URL' ], 401 );
		}
		return Response::json( AuthenticationService::update() );
	}

	/**
	 * Delete an user.
	 *
	 * @return JSON
	 */
	public function delete()
	{
		if( ! Auth::check() )
		{
			return Response::json( [ 'flash' => 'you should be connect to access this URL' ], 401 );
		}
		return Response::json( AuthenticationService::delete() );
	}

	/**
	 * Return a user's data
	 *
	 * @return JSON
	 */
	public function view()
	{
		if( ! Auth::check() )
		{
			return Response::json( [ 'flash' => 'you should be connect to access this URL' ], 401 );
		}
		return Response::json( AuthenticationService::view() );
	}
}