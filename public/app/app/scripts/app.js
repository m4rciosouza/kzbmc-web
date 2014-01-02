'use strict';

angular.module('LocalStorageModule').value('prefix', 'kzbmc');
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
      .otherwise({
        redirectTo: '/'
      });
  });

kzbmcMobileApp.factory( 'CanvasService', [ '$resource', function( $resource ) {
	return $resource(
			'http://localhost:8888/kzbmc-web/public/canvas/:id',
			{ id : '@id' }
		);
}]);

kzbmcMobileApp.factory( 'ItemService', [ '$resource', function( $resource ) {
	return $resource(
			'http://localhost:8888/kzbmc-web/public/item/:id',
			{ id : '@id' },
			{ reorder : { method : 'POST', url : 'http://localhost:8888/kzbmc-web/public/item/reorder' } }
		);
}]);