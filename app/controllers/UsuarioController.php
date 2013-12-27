<?php

class UsuarioController extends BaseController 
{
	public function getJson()
	{
		return Response::json(array('name' => 'Steve', 'state' => 'CA'));
	}
	
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
		
		/*$canvas = new Canvas;
		$canvas->name = 'Projeto #1';
		$canvas->description = 'Descrição do Projeto #1';
		$canvas->save();*/
		
		$canvas = CanvasService::getAllCanvas();
		echo 'Canvas<br />';
		var_dump( $canvas );
		
		/*$item = new Item;
		$item->title = 'Item #2';
		$item->description = 'Descrição do Item #2';
		$item->color = 'warning';
		$item->type = Item::TYPE_PC;
		$item->canvas_id = '1';
		$item->save();*/
		
		/*$items = Item::all();
		echo '<br />Items<br />';
		var_dump( $items );*/
		
		return View::make( 'usuario' )
					->with( 'usuarios', $usuarios )
					->with( 'canvas', $canvas )
					->with( 'outro', $usuarios->toJson() );
	}
}