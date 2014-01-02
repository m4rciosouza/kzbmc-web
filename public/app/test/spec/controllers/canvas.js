'use strict';

describe('Controller: CanvasCtrl', function () {

  // load the controller's module
  beforeEach(module('kzbmcMobileApp'));

  var CanvasCtrl,
    scope,
  $httpBackend;
  
  var project = { 'id' : '1', 'nome' : 'projeto 1', 'descricao' : 'desc projeto 1', 'itens' : { 'pc' : [ { 'id' : '1', 'titulo' : 't1', 'descricao' : 'd1', 'cor' : 'success' } ], 'ac' : [ { 'id' : '1', 'titulo' : 't1', 'descricao' : 'd1', 'cor' : 'success', 'order' : '0' }, { 'id' : '2', 'titulo' : 't2', 'descricao' : 'd2', 'cor' : 'warning', 'order' : '1' } ] } };
  var projectAdded = { 'id' : '1', 'nome' : 'projeto 1', 'descricao' : 'desc projeto 1', 'itens' : { 'pc' : [ { 'id' : '1', 'titulo' : 't1', 'descricao' : 'd1', 'cor' : 'success' }, { 'id' : '2', 'titulo' : 't2', 'descricao' : 'd2', 'cor' : 'warning' } ] } };
  var projectUpdated = { 'id' : '1', 'nome' : 'projeto 1', 'descricao' : 'desc projeto 1', 'itens' : { 'pc' : [ { 'id' : '1', 'titulo' : 't2', 'descricao' : 'd2', 'cor' : 'warning' } ] } };
  var projectDeleted = { 'id' : '1', 'nome' : 'projeto 1', 'descricao' : 'desc projeto 1', 'itens' : { 'pc' : [] } };
  var projectReorder = { 'id' : '1', 'nome' : 'projeto 1', 'descricao' : 'desc projeto 1', 'itens' : { 'pc' : [ { 'id' : '1', 'titulo' : 't1', 'descricao' : 'd1', 'cor' : 'success' } ], 'ac' : [ { 'id' : '1', 'titulo' : 't1', 'descricao' : 'd1', 'cor' : 'success', 'order' : '1' }, { 'id' : '2', 'titulo' : 't2', 'descricao' : 'd2', 'cor' : 'warning', 'order' : '0' } ] } };

  // Initialize the controller and a mock scope
  beforeEach( inject( function( $injector ) {
	  // Set up the mock http service responses
      $httpBackend = $injector.get( '$httpBackend' );
      // set the response
      $httpBackend.whenGET( 'http://localhost:8888/kzbmc-web/public/canvas/NaN' ).respond( project );
      $httpBackend.whenPOST( 'http://localhost:8888/kzbmc-web/public/item' ).respond( { 'id' : '2' } );
      $httpBackend.whenPOST( 'http://localhost:8888/kzbmc-web/public/item/1' ).respond( { 'id' : '1' } );
      $httpBackend.whenDELETE( 'http://localhost:8888/kzbmc-web/public/item/1' ).respond( { 'id' : '1' } );
      $httpBackend.whenPOST( 'http://localhost:8888/kzbmc-web/public/item/reorder?' ).respond( { 'canvasId' : '1' } );
	  // inject the scope
      scope = $injector.get( '$rootScope' );
      // inject the controller
      var $controller = $injector.get( '$controller' );
      CanvasCtrl = $controller( 'CanvasCtrl', {
        $scope : scope
      });
    }));

  beforeEach(function() {
	  $httpBackend.expectGET( 'http://localhost:8888/kzbmc-web/public/canvas/NaN' );
	  $httpBackend.flush();
  });
  
  it( 'should check if the project and items have been loaded', function() {
	  expect( scope.projeto.nome ).toBe( 'projeto 1' );
	  expect( scope.projeto.itens.pc[ 0 ].titulo ).toBe( 't1' );
  });
  
  it('should load an object array based on your kind', function () {
	  var itemObj = scope.obterItemObj( 'pc' );
	  expect( itemObj[ 0 ].titulo ).toBe( 't1' );
  });
  
  it('should load info to the add modal form to the scope', function () {
	  scope.modalAdd( 'pc', 'Adicionar item de Parceiros Chave' );
	  expect( scope.tipo ).toBe( 'pc' );
	  expect( scope.descricao ).toBe( 'Adicionar item de Parceiros Chave' );
	  expect( scope.item.titulo ).toBe( '' );
	  expect( scope.item.descricao ).toBe( '' );
	  expect( scope.item.cor ).toBe( '' );
  });
  
  it('should load info to the edit/remove modal form to the scope', function () {
	  scope.modalEdit( 'pc', 'Editar item de Parceiros Chave', '1' );
	  expect( scope.tipo ).toBe( 'pc' );
	  expect( scope.descricao ).toBe( 'Editar item de Parceiros Chave' );
	  expect( scope.index ).toBe( '1' );
	  expect( scope.itemEdit.titulo ).toBe( 't1' );
	  expect( scope.itemEdit.descricao ).toBe( 'd1' );
	  expect( scope.itemEdit.cor ).toBe( 'success' );
  });
  
  it('should create a new project item', function () {
	  $httpBackend.expectPOST( 'http://localhost:8888/kzbmc-web/public/item' );
	  $httpBackend.expectGET( 'http://localhost:8888/kzbmc-web/public/canvas/1' ).respond( projectAdded );
	  scope.id = '1';
	  scope.tipo = 'pc';
	  scope.cadastrar( { 'titulo' : 't2', 'descricao' : 'd2', 'cor' : 'warning' } );
	  $httpBackend.flush();
	  expect( scope.projeto.itens.pc.length ).toBe( 2 );
	  expect( scope.projeto.itens.pc[ 1 ].titulo ).toBe( 't2' );
	  expect( scope.projeto.itens.pc[ 1 ].descricao ).toBe( 'd2' );
	  expect( scope.projeto.itens.pc[ 1 ].cor ).toBe( 'warning' );
  });
  
  it('should update a project item', function () {
	  scope.tipo = 'pc';
	  scope.index = 1;
	  expect( scope.projeto.itens.pc.length ).toBe( 1 );
	  expect( scope.projeto.itens.pc[ 0 ].titulo ).toBe( 't1' );
	  expect( scope.projeto.itens.pc[ 0 ].descricao ).toBe( 'd1' );
	  expect( scope.projeto.itens.pc[ 0 ].cor ).toBe( 'success' );
	  $httpBackend.expectPOST( 'http://localhost:8888/kzbmc-web/public/item/1' );
	  $httpBackend.expectGET( 'http://localhost:8888/kzbmc-web/public/canvas/NaN' ).respond( projectUpdated );
	  scope.atualizar( { 'titulo' : 't2', 'descricao' : 'd2', 'cor' : 'warning' } );
	  $httpBackend.flush();
	  expect( scope.projeto.itens.pc.length ).toBe( 1 );
	  expect( scope.projeto.itens.pc[ 0 ].titulo ).toBe( 't2' );
	  expect( scope.projeto.itens.pc[ 0 ].descricao ).toBe( 'd2' );
	  expect( scope.projeto.itens.pc[ 0 ].cor ).toBe( 'warning' );
	  
  });
  
  it('should remove a project item', function () {
	  scope.tipo = 'pc';
	  scope.index = 1;
	  expect( scope.projeto.itens.pc.length ).toBe( 1 );
	  $httpBackend.expectDELETE( 'http://localhost:8888/kzbmc-web/public/item/1' );
	  $httpBackend.expectGET( 'http://localhost:8888/kzbmc-web/public/canvas/NaN' ).respond( projectDeleted );
	  scope.remover();
	  $httpBackend.flush();
	  expect( scope.projeto.itens.pc.length ).toBe( 0 );
  });
  
  it( 'should return the type by the class name', function() {
	  expect( scope.getTypeByClass( { 'className' : 'pc' } ) ).toBe( 'pc' );
	  expect( scope.getTypeByClass( { 'className' : 'ac' } ) ).toBe( 'ac' );
	  expect( scope.getTypeByClass( { 'className' : 'rc' } ) ).toBe( 'rc' );
	  expect( scope.getTypeByClass( { 'className' : 'pc' } ) ).toBe( 'pc' );
	  expect( scope.getTypeByClass( { 'className' : 'rcl' } ) ).toBe( 'rcl' );
	  expect( scope.getTypeByClass( { 'className' : 'ca' } ) ).toBe( 'ca' );
	  expect( scope.getTypeByClass( { 'className' : 'sc' } ) ).toBe( 'sc' );
	  expect( scope.getTypeByClass( { 'className' : 'ec' } ) ).toBe( 'ec' );
	  expect( scope.getTypeByClass( { 'className' : 'fr' } ) ).toBe( 'fr' );
  });
  
  it( 'should reorder an item', function() {
	  scope.projeto.id = '1';
	  scope.iniPosition = '0';
	  expect( scope.projeto.itens.ac[ 0 ].order ).toBe( '0' );
	  expect( scope.projeto.itens.ac[ 1 ].order ).toBe( '1' );
	  $httpBackend.expectPOST( 'http://localhost:8888/kzbmc-web/public/item/reorder?' );
	  $httpBackend.expectGET( 'http://localhost:8888/kzbmc-web/public/canvas/NaN' ).respond( projectReorder );
	  scope.sortableOptions.stop( '', { 'item' : { 'index' : function(){ return '1'; }, 'context' : { 'className' : 'ac' } } } );
	  $httpBackend.flush();
	  expect( scope.projeto.itens.ac[ 0 ].order ).toBe( '1' );
	  expect( scope.projeto.itens.ac[ 1 ].order ).toBe( '0' );
  });
});
