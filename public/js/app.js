var app = window.app = angular.module('app', [
  'ngRoute',
  'ngSanitize',
  'dialogs.main',
	'pascalprecht.translate',
	'dialogs.default-translations',
  'ngAnimate',
  'ngFileUpload',
  'ngImgCrop',
  'app.routes',
  'ui.bootstrap',
  'ui.multiselect',
  'app.services',
  'app.directives',
  'app.controllers'
])

.config(['$translateProvider', function($translateProvider) {
	$translateProvider.preferredLanguage('es-ES');
}])

.run(['$rootScope', '$window', '$location', 'Session', function($rootScope, $window, $location, Session) {

	$rootScope.session = Session;
	$window.app = {
			authState: function(state, user) {
				$rootScope.$apply(function() {
					switch (state) {
					case 'success':
						Session.authSuccess(user);
						break;
					case 'failure':
						Session.authFailed();
						break;
					}
				});
			}
	};

	if ($window.user !== null) {
		Session.authSuccess($window.user);
	}

	$rootScope.$on('$routeChangeSuccess', function() {
		if ($(document).scrollTop() > 300) {
			$(function() {$('html, body').animate({scrollTop: '0px'}, 800);});
		}
	});

	$rootScope.back = function() {
		$window.history.back();
	};

	$rootScope.isUserLogedIn = function() {
		return true;
	};

}]);

app.factory('authInterceptor', function ($rootScope, $q, $window) {
	return {
		request: function (config) {
			config.headers = config.headers || {};
			if ($window.sessionStorage.token) {
				config.headers.Authorization = 'Bearer ' + $window.sessionStorage.token;
			}
			return config;
		},
		responseError: function (rejection) {
			return $q.reject(rejection);
		}
	};
});

app.config(function ($httpProvider) {
	$httpProvider.interceptors.push('authInterceptor');
});
