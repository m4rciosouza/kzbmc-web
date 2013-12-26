<?php

class UsuarioController extends BaseController 
{
	public function getIndex()
	{
		/*$usuario = new Usuario;
		$usuario->nome = 'Usuário 3';
		$usuario->email = 'usuario3@email.com';
		$usuario->save();*/
		
		/*$usuario = Usuario::find( 3 );
		$usuario->email = 'usuario3@gmail.com';
		$usuario->save();*/
		
		//Usuario::find( 3 )->delete();
		
		$usuarios = Usuario::all();
		
		return View::make( 'usuario' )
					->with( 'usuarios', $usuarios )
					->with( 'outro', $usuarios->toJson() );
	}
}