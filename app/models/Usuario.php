<?php
/**
 * 
 * @author marciosouza
 * @property string email
 * @property string nome
 */
class Usuario extends Eloquent 
{
	protected $visible = array( 'email', 'nome' );
}