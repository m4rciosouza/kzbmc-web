<?php
namespace KZ\Services;

use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Response;
use \User;

/**
 * Service that login, logout, manage, process and return all the data based on Authentication service.
 * 
 * @author marciosouza
 *
 */
class AuthenticationService
{
	/**
	 * Do the login.
	 * 
	 * @return Resource
	 */
	public function login()
	{
		$credentials = array(
				'email' 	=> Input::get( 'email' ),
				'password' 	=> Input::get( 'password' ),
				'active' 	=> '1'
		);
		if( Auth::attempt( $credentials ) )
		{
			return Response::json( [ 'user' => Auth::user()->toArray() ], 202 );
		}
		else
		{
			return Response::json( [ 'flash' => trans( 'auth.erro_autenticando' ) ], 401 );
		}
	}
	
	/**
	 * Do the logout.
	 *
	 * @return Resource
	 */
	public function logout()
	{
		Auth::logout();
		return Response::json( [ 'flash' => trans( 'auth.logout_sucesso' ) ], 200 );
	}
	
	/**
	 * Return a Canvas data by id.
	 * 
	 * @return array
	 */
	public function view() 
	{
		$user = User::find( (int) Route::input( 'id' ) );
		if( ! $user )
		{
			return array( 'msg' => trans( 'auth.nao_encontrado' ) );
		}
		// format the Item
		$objUser = array(
				'id'		=> $user->id,
				'email' 	=> $user->email,
				'active' 	=> $user->active,
		);
		return $objUser;
	}
	
	/**
	 * Create a new Canvas.
	 * 
	 * @return array
	 */
	public function create()
	{
		$user = new User;
		$user->setAttributes();
		if( $user->validate() !== FALSE )
		{
			return array( 'msgs' => $user->validate()->all() );
		}
		$user->save();
		return array( 'id' => $user->id );		
	}
	
	/**
	 * Update a Canvas.
	 * 
	 * @return boolean
	 */
	public function update()
	{
		$user = User::find( (int) Route::input( 'id' ) );
		if( ! $user )
		{
			return array( 'msgs' => trans( 'auth.nao_encontrado' ) );
		}
		$user->setAttributes();
		if( $user->validate() !== FALSE )
		{
			return array( 'msgs' => $user->validate()->all() );
		}
		$user->save();
		return array( 'id' => $user->id );
	}
	
	/**
	 * Delete a Canvas.
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	public function delete()
	{
		$id = (int) Route::input( 'id' );
		$user = User::find( $id );
		if( ! $user )
		{
			return array( 'msgs' => trans( 'auth.nao_encontrado' ) );
		}
		$user->active = '0';
		$user->save();
		return array( 'id' => $id );
	}
}