appControllers.controller('LoginCtrl', ['$scope', /*'dialogs',*/ 'LoginService', '$location', '$rootScope', 'Session', '$window',
	function($scope, /*dialogs,*/ LoginService, $location, $rootScope, Session, $window) {

	$scope.email = '';
	$scope.password = '';

	$scope.doLogin = function() {
		if (!$scope.email) {
			//asdasda
			// $rootScope.loginErrorMessage = "El email ingresado no tiene un formato válido.";
			delete $window.sessionStorage.token;
			Session.authFailed();
			// TODO mostrar error.
		} else {
			LoginService.login($scope.email, $scope.password, function(error, response) {
				if (error) {
					// TODO
					// dialogs.error('Error', 'Ocurrió un error intentando iniciar sesión, por favor intente mas tarde.');
					$location.path('/');
				} else {
					if (response.state === "success") {
						// TODO
						// $rootScope.loginErrorMessage = "";
						$window.sessionStorage.token = response.token;
						Session.authSuccess(response.user);
						$location.path('/');
					} else {
						// TODO
						// $rootScope.loginErrorMessage = "Usuario o contraseña incorrecta.";
						delete $window.sessionStorage.token;
						Session.authFailed();
						// TODO
						// $scope.openModal();
					}
				}
			});
		}
	};

	$scope.hitEnter = function(evt) {
		if (angular.equals(evt.keyCode,13)) {
			$scope.doLogin();
		}
	};

	// $scope.logout = function () {
		// Session.logout(function(error, result) {
		// 	$location.path('/');
		// });
	// };

	$scope.isUserLogedIn = function() {
		return Session.isUserLoggedIn();
	};

	$scope.cancel = function() {
		$location.path('/');
	};

	$scope.getRole = function() {
		var usr = Session.getAuthenticatedUser();
		if (!usr) {
			return "";
		}
		if (usr.role === "free") {
			return "Usuario básico.";
		}
		if (usr.role === "gold") {
			return "Usuario premium.";
		}
		return "";
	};

}]);
