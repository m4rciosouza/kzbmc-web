'use strict';

angular.module('kzbmcMobileApp')
  .controller('MainCtrl', [ '$scope', 'localStorageService', 'CanvasService', function( $scope, localStorageService, CanvasService ) {
	  
	  $scope.isAuth = function() {
		  return sessionStorage.authenticated;
	  };
	  
	  // create a new canvas
	  $scope.cadastrar = function( canvas ) {
		  if($scope.form.$valid) {
			  $scope.loading = true;
			  CanvasService.save( { name : canvas.nome, description : canvas.descricao }, function( data ) {
				    if( data.id ) {
				      $scope.parseProjetos();
				    }
			    });
		  }
	  };
	  
	  // loads modal canvas data
	  $scope.modalLoadData = function( index ) {
		  $scope.index = index;
		  var itemObj = $scope.getItemById( index );
	    $scope.canvasEditar = { 'nome' : itemObj.nome, 'descricao' : itemObj.descricao };
	  };
	  
	  // return an item by id
	  $scope.getItemById = function( id ) {
		  for( var i = 0; i < $scope.projetos.length; i ++ ) {
			  if( $scope.projetos[ i ].id === id ) {
				  return $scope.projetos[ i ];
			  }
		  }
	  };
	  
    // update a canvas
    $scope.atualizar = function( canvas ) {
        $scope.loading = true;
        CanvasService.save( { id : $scope.index, name : canvas.nome, description : canvas.descricao }, function( data ) {
			      if( data.id ) {
			        $scope.parseProjetos();
			      }
		      });
      };
      
    // remove a canvas
    $scope.remover = function() {
        $scope.loading = true;
        CanvasService.remove( { id : $scope.index }, function( data ) {
			      if( data.id ) {
			        $scope.parseProjetos();
			      }
		      });
      };
	  
	  $scope.reset = function( canvas ) {
		  if( typeof canvas !== 'undefined' ) {
		    canvas.nome = '';
		    canvas.descricao = '';
		  }
	  };
	  
	  // return all the projects
	  $scope.parseProjetos = function() {
		  $scope.loading = true;
		  $scope.projetos = [];
		  CanvasService.query( function( data ) {
			    var listaProjetos = data;
			    for( var i = 0; i < listaProjetos.length; i ++ ) {
				    $scope.projetos.push( angular.fromJson( listaProjetos[ i ] ) );
			    }
			    $scope.loading = false;
		    });
	  };
	  
	  $scope.parseProjetos();
  }]);