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
	public function getAll( $orderBy = 'id', $direction = 'ASC' )
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
		$item->save();
		return array( 'id' => $item->id );		
	}
	
	/**
	 * Update an Item.
	 * 
	 * @return boolean
	 */
	public function update()
	{
		$item = Item::find( (int) Input::get( 'id' ) );
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
	 * @return boolean
	 */
	public function delete()
	{
		$id = (int) Input::get( 'id' );
		$item = Item::find( $id );
		if( ! $item )
		{
			return array( 'msgs' => trans( 'item.nao_encontrado' ) );
		}
		$item->delete();
		return array( 'id' => $id );
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
		);
		return $objItem;
	}
}