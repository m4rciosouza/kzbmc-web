'use strict';

describe('Controller: MainCtrl', function () {

  // load the controller's module
  beforeEach(module('kzbmcMobileApp'));

  var MainCtrl,
    scope,
  $httpBackend;

  // Initialize the controller and a mock scope 
  /*beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    MainCtrl = $controller('MainCtrl', {
      $scope: scope
    });
  }));*/
  beforeEach( inject( function( $injector ) {
	  // Set up the mock http service responses
      $httpBackend = $injector.get( '$httpBackend' );
	  // inject the scope
      scope = $injector.get( '$rootScope' );
      // inject the controller
      var $controller = $injector.get( '$controller' );
      MainCtrl = $controller( 'MainCtrl', {
        $scope : scope
      });
    }));
  
  beforeEach(function() {
	  scope.projetos = [];
	  scope.projetos.push( { 'id' : 1, 'nome' : 'projeto 1', 'descricao' : 'desc projeto 1' } );
	  scope.projetos.push( { 'id' : 2, 'nome' : 'projeto 2', 'descricao' : 'desc projeto 2' } );
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
  
  /*it( 'should get and parse a list of projects to the scope', function() {
	  console.log( scope.projetos.length );
	  $httpBackend.whenGET( 'http://localhost:8888/kzbmc-web/public/canvas' ).respond( 200, [{"id":"1","nome":"Project #1","descricao":"Description of Project #1","itens":{"pc":[{"id":"2","titulo":"Item #2","descricao":"Description Item #2 of Project #1","cor":"warning","order":"0"},{"id":"1","titulo":"Item #1","descricao":"Description Item #1 of Project #1","cor":"info","order":"1"}],"ac":"","rc":"","pv":"","rcl":"","ca":"","sc":"","ec":"","fr":[{"id":"3","titulo":"Item #3","descricao":"Description Item #3 of Project #1","cor":"danger","order":"0"}]}}] );
	  $httpBackend.flush();
	  scope.parseProjetos();
	  expect( scope.projetos.length ).toBe( 1 );
  });*/
  
  /*it( 'should create a new project', function() {
	  scope.form = { '$valid' : true };
	  scope.cadastrar( { 'nome' : 'projeto 3', 'descricao' : 'desc projeto 3' } );
	  expect( scope.projetos.length ).toBe( 3 );
	  expect( scope.projetos[ 2 ].nome ).toBe( 'projeto 3' );
  });
  
  it( 'should update a project name', function(){
	  scope.index = 0;
	  scope.atualizar( { 'nome' : 'projeto 1 mod', 'descricao' : 'desc projeto 1 mod' } );
	  expect( scope.projetos.length ).toBe( 2 );
	  expect( scope.projetos[ 0 ].nome ).toBe( 'projeto 1 mod' );
  });*/
  
  /*it( 'should remove a project', function() {
	  scope.index = 0;
	  $httpBackend.expectDELETE( 'http://localhost:8888/kzbmc-web/public/canvas' ).respond( { "id" : "1" } );
	  $httpBackend.flush();
	  $httpBackend.whenGET( 'http://localhost:8888/kzbmc-web/public/canvas' ).respond( '' );
	  //scope.$apply();
	  $httpBackend.flush();
	  scope.remover();
	  expect( scope.projetos.length ).toBe( 2 );
    expect( scope.projetos[ 1 ].nome ).toBe( 'projeto 2' );
  });*/
});
