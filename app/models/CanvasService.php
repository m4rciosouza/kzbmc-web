<?php
namespace KZ\Services;

use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use \Canvas;
use \Item;

/**
 * Service that manage, process and return all the data based on Canvas service.
 * 
 * @author marciosouza
 *
 */
class CanvasService
{
	/**
	 * Return all the Canvas projects.
	 * 
	 * @param $orderBy Field to be ordered
	 * @param $direction ASC or DESC
	 * @return array
	 */
	public function getAll( $orderBy = 'name', $direction = 'ASC' )
	{
		$arrCanvas = array();
		$modelCanvas = Canvas::orderBy( $orderBy, $direction )->get();
		foreach( $modelCanvas as $canvas )
		{
			$arrCanvas[] = $this->getCanvasArray( $canvas );
		}
		return count( $arrCanvas ) == 0 ? array( 'msg' => trans( 'canvas.nenhum_encontrado' ) ) : $arrCanvas;
	}
	
	/**
	 * Return a Canvas data by id.
	 * 
	 * @return array
	 */
	public function view() 
	{
		return $this->getCanvasArray( Canvas::find( (int) Route::input( 'id' ) ) );
	}
	
	/**
	 * Create a new Canvas.
	 * 
	 * @return array
	 */
	public function create()
	{
		$canvas = new Canvas;
		$canvas->setAttributes();
		if( $canvas->validate() !== FALSE )
		{
			return array( 'msgs' => $canvas->validate()->all() );
		}
		$canvas->user_id = Auth::check() ? Auth::getUser()->id : '-1';
		$canvas->save();
		return array( 'id' => $canvas->id );		
	}
	
	/**
	 * Update a Canvas.
	 * 
	 * @return boolean
	 */
	public function update()
	{
		$canvas = Canvas::find( (int) Route::input( 'id' ) );
		if( ! $canvas )
		{
			return array( 'msgs' => trans( 'canvas.nao_encontrado' ) );
		}
		$canvas->setAttributes();
		if( $canvas->validate() !== FALSE )
		{
			return array( 'msgs' => $canvas->validate()->all() );
		}
		$canvas->save();
		return array( 'id' => $canvas->id );	
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
		$canvas = Canvas::find( $id );
		if( ! $canvas )
		{
			return array( 'msgs' => trans( 'canvas.nao_encontrado' ) );
		}
		$canvas->delete();
		Item::where( 'canvas_id', (int) $id )->delete();
		return array( 'id' => $id );
	}
	
	/**
	 * Forrmat and return an array with the Canvas data as well as its items.
	 * 
	 * @param Canvas $canvas
	 * @return array
	 */
	private function getCanvasArray( $canvas )
	{
		if( ! $canvas )
		{
			return array( 'msg' => trans( 'canvas.nao_encontrado' ) );
		}
		$items = Item::where( 'canvas_id', $canvas->id )->orderBy( 'order', 'ASC' )->get();
		// format the items
		$arrItems = array( 'pc' => '', 'ac' => '', 'rc' => '', 'pv' => '', 'rcl' => '',
				'ca' => '', 'sc' => '', 'ec' => '', 'fr' => '' );
		foreach( $items as $item )
		{
			$arrItems[ $item->type ][] = array(
					'id'		=> $item->id,
					'titulo' 	=> $item->title,
					'descricao' => $item->description,
					'cor'		=> $item->color,
					'order'		=> $item->order,
			);
		}
		// format the Canvas and add the items
		$objCanvas = array(
				'id'		=> $canvas->id,
				'nome' 		=> $canvas->name,
				'descricao' => $canvas->description,
				'itens' 	=> $arrItems
		);
		return $objCanvas;
	}
}