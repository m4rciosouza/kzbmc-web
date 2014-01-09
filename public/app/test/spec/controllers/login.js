'use strict';

describe('Controller: LoginCtrl', function () {

  // load the controller's module
  beforeEach(module('kzbmcMobileApp'));

  var LoginCtrl,
    scope,
  $httpBackend;
  
  var LOCALHOST = 'http://localhost:8888/kzbmc-web/public';
  
  // Initialize the controller and a mock scope 
  beforeEach( inject( function( $injector ) {
	  // Set up the mock http service responses
      $httpBackend = $injector.get( '$httpBackend' );
      // set the response
      $httpBackend.whenGET( LOCALHOST + '/auth/logout' ).respond( {} );
      $httpBackend.whenPOST( LOCALHOST + '/auth/login' ).respond( {} );
	  // inject the scope
      scope = $injector.get( '$rootScope' );
      // inject the controller
      var $controller = $injector.get( '$controller' );
      LoginCtrl = $controller( 'LoginCtrl', {
        $scope : scope
      });
    }));
  
  it( 'should do the login', function() {
	  scope.email = 'admin@admin.com';
	  scope.password = 'admin';
	  $httpBackend.expectPOST( LOCALHOST + '/auth/login' );
	  scope.login();
	  $httpBackend.flush();
	  expect( scope.flash ).toBe( '' );
	  expect( sessionStorage.authenticated ).toBe( 'true' );
  });

  it( 'should do the logout', function () {
	  $httpBackend.expectGET( LOCALHOST + '/auth/logout' );
	  scope.logout();
	  $httpBackend.flush();
	  expect( sessionStorage.authenticated ).toBe( undefined );
  });
});
