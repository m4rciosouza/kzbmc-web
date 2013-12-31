'use strict';

angular.module( 'kzbmcMobileApp' )
  .controller( 'CanvasCtrl', [ '$scope', '$routeParams', 'localStorageService', 'ItemService', 'CanvasService', function( $scope, $routeParams, localStorageService, ItemService, CanvasService ) {
    
    $scope.id = parseInt( $routeParams.id, 10 );
    
    // carrega o canvas
    //TODO create unit test
    $scope.loadCanvas = function(){
	    $scope.loading = true;
	    CanvasService.get( { id : $scope.id }, function( data ) {
	        $scope.projeto = data;
	        $scope.loading = false;
	      });
    };
    
    // load info to the add modal form
    $scope.modalAdd = function( tipo, descricao ) {
        $scope.tipo = tipo;
        $scope.descricao = descricao;
        $scope.item = { 'titulo' : '', 'descricao' : '', 'cor' : '' };
      };
      
    // add a new item to the project
    $scope.cadastrar = function( item ) {
        $scope.loading = true;
        ItemService.save( {
            title : item.titulo,
            description : item.descricao,
            color : item.cor,
            type : $scope.tipo,
            canvasId : $scope.id
          }, function( data ) {
		        if( data.id ) {
		          $scope.loadCanvas();
		        }
	        });
      };
     
    // load info to the edit/remove modal form
    $scope.modalEdit = function( tipo, descricao, index ) {
        $scope.index = index;
        $scope.tipo = tipo;
        $scope.descricao = descricao;
        var itemsObj = $scope.obterItemObj( tipo );
        for( var i = 0; i < itemsObj.length; i ++ ) {
          if( itemsObj[ i ].id === $scope.index ) {
            $scope.itemEdit = { 'titulo' : itemsObj[ i ].titulo, 'descricao' : itemsObj[ i ].descricao,
                        'cor' : itemsObj[ i ].cor };
          }
        }
      };
      
    // updates a project item
    $scope.atualizar = function( item ) {
        $scope.loading = true;
        ItemService.save( {
            id : $scope.index,
            title : item.titulo,
            description : item.descricao,
            color : item.cor,
            type : $scope.tipo,
            canvasId : $scope.id
          }, function( data ) {
		        if( data.id ) {
		          $scope.loadCanvas();
		        }
	        });
      };
        
    // removes a project item
    $scope.remover = function() {
        $scope.loading = true;
        ItemService.remove( { id : $scope.index }, function( data ) {
		      if( data.id ) {
		        $scope.loadCanvas();
		      }
	      });
      };
        
    // load an object array based on your kind
    $scope.obterItemObj = function( tipo ) {
          var itemObj = '';
          switch( tipo ) {
	        case 'pc':
	          itemObj = $scope.projeto.itens.pc;
	          break;
	        case 'ac':
	          itemObj = $scope.projeto.itens.ac;
	          break;
	        case 'rc':
	          itemObj = $scope.projeto.itens.rc;
	          break;
	        case 'pv':
	          itemObj = $scope.projeto.itens.pv;
	          break;
	        case 'rcl':
	          itemObj = $scope.projeto.itens.rcl;
	          break;
	        case 'ca':
	          itemObj = $scope.projeto.itens.ca;
	          break;
	        case 'sc':
	          itemObj = $scope.projeto.itens.sc;
	          break;
	        case 'ec':
	          itemObj = $scope.projeto.itens.ec;
	          break;
	        case 'fr':
	          itemObj = $scope.projeto.itens.fr;
	          break;
          }
          return itemObj;
        };
     
    $scope.sortableOptions = {
        start : function( e, ui ) {
            $scope.iniPosition = ui.item.index();
          },
        stop : function( e, ui ) {
            console.log( 'pos (from-to): ' + $scope.iniPosition + ', ' + ui.item.index() );
                //$scope.listaProjetos[ $scope.id ] = angular.toJson( $scope.projeto );
                //localStorageService.add( 'projetos', $scope.listaProjetos );
          },
        axis : 'y',
      };
    
    // carrega o canvas
    $scope.loadCanvas();
   
  }]);