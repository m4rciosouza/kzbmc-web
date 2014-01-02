<?php
namespace KZ\Services;

use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Route;
use \Item;

/**
 * Service that manage, process and return all the data based on Item service.
 * 
 * @author marciosouza
 *
 */
class ItemService
{
	/**
	 * Return all the Canvas projects.
	 * 
	 * @param $orderBy Field to be ordered
	 * @param $direction ASC or DESC
	 * @return array
	 */
	public function getAll( $orderBy = 'order', $direction = 'ASC' )
	{
		$canvasId = Route::input( 'id' );
		$arrItems = array();
		if( $canvasId >= 0 )
		{
			$modelItem = Item::where( 'canvas_id', (int) $canvasId )->orderBy( $orderBy, $direction )->get();
			foreach( $modelItem as $item )
			{
				$arrItems[] = $this->getItemArray( $item );
			}
		}
		return count( $arrItems ) == 0 ? array( 'msg' => trans( 'item.nenhum_encontrado' ) ) : $arrItems;
	}
	
	/**
	 * Return an Item data by id.
	 * 
	 * @return array
	 */
	public function view() 
	{
		return $this->getItemArray( Item::find( (int) Route::input( 'id' ) ) );
	}
	
	/**
	 * Create a new Item.
	 * 
	 * @return array
	 */
	public function create()
	{
		$item = new Item;
		$item->setAttributes();
		if( $item->validate() !== FALSE )
		{
			return array( 'msgs' => $item->validate()->all() );
		}
		$item->order = Item::where( 'canvas_id', (int) $item->canvas_id )->where( 'type', $item->type )->count();
		$item->save();
		return array( 'id' => $item->id );		
	}
	
	/**
	 * Update an Item.
	 * 
	 * @return array
	 */
	public function update()
	{
		$item = Item::find( (int) Route::input( 'id' ) );
		if( ! $item )
		{
			return array( 'msgs' => trans( 'item.nao_encontrado' ) );
		}
		$item->setAttributes();
		if( $item->validate() !== FALSE )
		{
			return array( 'msgs' => $item->validate()->all() );
		}
		$item->save();
		return array( 'id' => $item->id );	
	}
	
	/**
	 * Delete an Item.
	 * 
	 * @return array
	 */
	public function delete()
	{
		$id = (int) Route::input( 'id' );
		$item = Item::find( $id );
		if( ! $item )
		{
			return array( 'msgs' => trans( 'item.nao_encontrado' ) );
		}
		$canvasId = $item->canvas_id;
		$type = $item->type;
		$item->delete();
		// update the order to avoid gaps		
		$modelItem = Item::where( 'canvas_id', $canvasId )->where( 'type', $type )->orderBy( 'order', 'ASC' )->get();
		$order = 0;
		foreach( $modelItem as $objItem )
		{
			$objItem->order = $order;
			$objItem->save();
			$order ++;
		}
		return array( 'id' => $id );
	}
	
	/**
	 * Reorder the position of an Item.
	 *
	 * @return array
	 */
	public function reorder()
	{
		$canvasId 	= (int) Input::get( 'canvasId' );
		$type 		= addslashes( Input::get( 'type' ) );
		$posIni 	= (int) Input::get( 'posIni' );
		$posEnd 	= (int) Input::get( 'posEnd' );
		// validate the input data
		if( $canvasId <= 0 || empty( $type ) || $posIni < 0 || $posEnd < 0 )
		{
			return array( 'msgs' => trans( 'item.parametros_incorretos' ) );
		}
		// get the items to exchange ordering
		$itemIni = Item::where( 'canvas_id', $canvasId )->where( 'type', $type )
							  ->where( 'order', $posIni )->first();
		$itemEnd = Item::where( 'canvas_id', $canvasId )->where( 'type', $type )
							  ->where( 'order', $posEnd )->first();
		if( ! $itemIni || ! $itemEnd )
		{
			return array( 'msgs' => trans( 'item.nao_encontrado' ) );
		}
		// exchange the order and update
		$itemIni->order = $posEnd;
		$itemIni->save();
		$itemEnd->order = $posIni;
		$itemEnd->save();
		return array( 'canvasId' => $canvasId );
	}
	
	/**
	 * Forrmat and return an array with the Item data.
	 * 
	 * @param Item $item
	 * @return array
	 */
	private function getItemArray( $item )
	{
		if( ! $item )
		{
			return array( 'msg' => trans( 'item.nao_encontrado' ) );
		}
		// format the Item
		$objItem = array(
				'id'		=> $item->id,
				'titulo' 	=> $item->title,
				'descricao' => $item->description,
				'cor'		=> $item->color,
				'order'	    => $item->order,
		);
		return $objItem;
	}
}