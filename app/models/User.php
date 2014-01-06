<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Set the request attrs.
	 */
	public function setAttributes()
	{
		$this->email 		= Input::get( 'email' );
		$this->password 	= Hash::make( Input::get( 'password', '' ) );
		$this->active		= '1';
	}
	
	/**
	 * Validate the data.
	 *
	 * @return array
	 */
	public function validate()
	{
		$validator = Validator::make(
				Input::all(),
				array(
						'email' 	=> 'required|email',
						'password' 	=> 'required',
				)
		);
		if ($validator->fails())
		{
			return $validator->messages();
		}
		return FALSE;
	}
}