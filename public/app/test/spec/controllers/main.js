'use strict';

describe('Controller: MainCtrl', function () {

  // load the controller's module
  beforeEach(module('kzbmcMobileApp'));

  var MainCtrl,
    scope,
  $httpBackend;
  
  var LOCALHOST = 'http://localhost:8888/kzbmc-web/public';
  
  var projects = [ { 'id' : 1, 'nome' : 'projeto 1', 'descricao' : 'desc projeto 1' }, { 'id' : 2, 'nome' : 'projeto 2', 'descricao' : 'desc projeto 2' } ];
  var projectsAdded = [ { 'id' : 1, 'nome' : 'projeto 1', 'descricao' : 'desc projeto 1' }, { 'id' : 2, 'nome' : 'projeto 2', 'descricao' : 'desc projeto 2' }, { 'id' : 3, 'nome' : 'projeto 3', 'descricao' : 'desc projeto 3' } ];
  var projectsUpdated = [ { 'id' : 1, 'nome' : 'projeto 1 mod', 'descricao' : 'desc projeto 1 mod' }, { 'id' : 2, 'nome' : 'projeto 2', 'descricao' : 'desc projeto 2' } ];
  var projectsDeleted = [ { 'id' : 2, 'nome' : 'projeto 2', 'descricao' : 'desc projeto 2' } ];

  // Initialize the controller and a mock scope 
  beforeEach( inject( function( $injector ) {
	  // Set up the mock http service responses
      $httpBackend = $injector.get( '$httpBackend' );
      // set the response
      $httpBackend.whenGET( LOCALHOST + '/canvas' ).respond( projects );
      $httpBackend.whenPOST( LOCALHOST + '/canvas' ).respond( { 'id' : 3 } );
      $httpBackend.whenPOST( LOCALHOST + '/canvas/0' ).respond( { 'id' : 1 } );
      $httpBackend.whenDELETE( LOCALHOST + '/canvas/0' ).respond( { 'id' : 1 } );
	  // inject the scope
      scope = $injector.get( '$rootScope' );
      // inject the controller
      var $controller = $injector.get( '$controller' );
      MainCtrl = $controller( 'MainCtrl', {
        $scope : scope
      });
    }));
  
  beforeEach(function() {
	  $httpBackend.expectGET( LOCALHOST + '/canvas' );
	  $httpBackend.flush();
  });
  
  it( 'should check if the projects list have been loaded', function() {
	  expect( scope.projetos.length ).toBe( 2 );
  });

  it( 'should get a project by id', function () {
	  var itemObj = scope.getItemById( 1 );
    expect( itemObj.nome ).toBe( 'projeto 1' );
  });
  
  it( 'should attach the first project to the scope', function () {
	  scope.modalLoadData( 1 );
    expect( scope.canvasEditar.nome ).toBe( 'projeto 1' );
  });
  
  it( 'should attach the second project to the scope', function () {
	  scope.modalLoadData( 2 );
    expect( scope.canvasEditar.nome ).toBe( 'projeto 2' );
  });
  
  it( 'should create a new project', function() {
	  scope.form = { '$valid' : true };
	  $httpBackend.expectPOST( LOCALHOST + '/canvas' );
	  $httpBackend.expectGET( LOCALHOST + '/canvas' ).respond( projectsAdded );
	  scope.cadastrar( { 'nome' : 'projeto 3', 'descricao' : 'desc projeto 3' } );
	  $httpBackend.flush();
	  expect( scope.projetos.length ).toBe( 3 );
	  expect( scope.projetos[ 2 ].nome ).toBe( 'projeto 3' );
  });
  
  it( 'should update a project name', function() {
	  scope.index = 0;
	  $httpBackend.expectPOST( LOCALHOST + '/canvas/0' );
	  $httpBackend.expectGET( LOCALHOST + '/canvas' ).respond( projectsUpdated );
	  scope.atualizar( { 'id' : 1, 'nome' : 'projeto 1 mod', 'descricao' : 'desc projeto 1 mod' } );
	  $httpBackend.flush();
	  expect( scope.projetos.length ).toBe( 2 );
	  expect( scope.projetos[ 0 ].nome ).toBe( 'projeto 1 mod' );
  });
  
  it( 'should remove a project', function() {
	  scope.index = 0;
	  $httpBackend.expectDELETE( LOCALHOST + '/canvas/0' );
	  $httpBackend.expectGET( LOCALHOST + '/canvas' ).respond( projectsDeleted );
	  scope.remover();
	  $httpBackend.flush();
	  expect( scope.projetos.length ).toBe( 1 );
    expect( scope.projetos[ 0 ].nome ).toBe( 'projeto 2' );
  });
});
