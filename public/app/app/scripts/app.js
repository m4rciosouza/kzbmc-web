'use strict';

/*
 * Uncomment for localhost development
 */
//sessionStorage.authenticated = true;

angular.module( 'LocalStorageModule' ).value( 'prefix', 'kzbmc' );

var kzbmcMobileApp = angular.module('kzbmcMobileApp', [
  'ngRoute',
  'ngResource',
  'LocalStorageModule',
  'ui.sortable'
])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/canvas/:id', {
        templateUrl: 'views/canvas.html',
        controller: 'CanvasCtrl'
      })
      .when('/login', {
        templateUrl: 'views/login.html',
        controller: 'LoginCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  })
  .config( function( $httpProvider ) { // authentication check filter
        var interceptor = [ '$rootScope', '$location', '$q', function( $rootScope, $location, $q ) {
	        var success = function( response ) {
	            return response;
	          };
	        var error = function( response ) {
	            if( response.status === 401 ) {
	              delete sessionStorage.authenticated;
	              $location.path( '/login' );
	            }
	            return $q.reject( response );
	          };
	        return function( promise ) {
	            return promise.then( success, error );
	          };
	      }];
        $httpProvider.responseInterceptors.push( interceptor );
      });

kzbmcMobileApp.constant( 'LOCALHOST', 'http://localhost:8888/kzbmc-web/public' );

// services
kzbmcMobileApp.factory( 'CanvasService', [ '$resource', 'LOCALHOST', function( $resource, LOCALHOST ) {
	return $resource(
			LOCALHOST + '/canvas/:id',
			{ id : '@id' }
		);
}]);

kzbmcMobileApp.factory( 'ItemService', [ '$resource', 'LOCALHOST', function( $resource, LOCALHOST ) {
	return $resource(
			LOCALHOST + '/item/:id',
			{ id : '@id' },
			{ reorder : { method : 'POST', url : LOCALHOST + '/item/reorder' } }
		);
}]);

kzbmcMobileApp.factory( 'Authenticate', [ '$resource', 'LOCALHOST', function( $resource, LOCALHOST ) {
    return $resource( LOCALHOST + '/service/authenticate' );
  }]);