'use strict';

angular.module('kzbmcMobileApp')
  .controller('LoginCtrl', [ '$scope', '$location', 'Authenticate', function( $scope, $location, Authenticate ) {
	  
	  // do the login
	  $scope.login = function() {
	        Authenticate.save({
	            'email' : $scope.email,
	            'password' : $scope.password
	          }, function() {
	            $scope.flash = '';
	            $location.path( '/' );
	            sessionStorage.authenticated = true;
	          }, function( response ) {
	            $scope.flash = response.data.flash;
	          });
	      };
	
	  // do the logout
	  $scope.logout = function () {
	        Authenticate.logout( {}, function() {
                delete sessionStorage.authenticated;
	              $location.path( '/login' );
	            });
	      };
	  
	  // check if its logged in
	  $scope.isAuth = function() {
		  return sessionStorage.authenticated;
	  };
	  
	  // add a new user
	  $scope.novoUsuario = function ( usuario ) {
		  usuario = '';
	        /*Authenticate.logout( {}, function() {
                delete sessionStorage.authenticated;
	              $location.path( '/login' );
	            });*/
	  };
	  
	  // add a new user
	  $scope.esqueceuSenha = function ( usuarioSenha ) {
		  usuarioSenha = '';
	        /*Authenticate.logout( {}, function() {
                delete sessionStorage.authenticated;
	              $location.path( '/login' );
	            });*/
	  };
  }]);