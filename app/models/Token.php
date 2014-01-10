<?php
/**
 * Token class, manage the authentication tokens.
 * 
 * @author marciosouza
 * @property integer id
 * @property string token
 * @property integer user_id
 * @property datetime created_at
 * @property datetime updated_at
 */
class Token extends Eloquent 
{
	protected $table = 'tokens';
	
	/**
	 * Return the token object.
	 * 
	 * @return Token
	 */
	public static function getToken()
	{
		$authToken = Request::header( 'AUTH_TOKEN' );
		if( isset( $authToken ) && ! empty( $authToken ) )
		{
			$token = Token::where( 'token', $authToken )->first();
			if( $token )
			{
				return $token;
			}
		}
		return FALSE;
	}
	
	/**
	 * Return the user id based on the requested token.
	 * 
	 * @return integer
	 */
	public static function getUserId()
	{
		$token = Token::getToken();
		if( $token !== FALSE )
		{
			return $token->user_id;
		}
		return FALSE;
	}
}