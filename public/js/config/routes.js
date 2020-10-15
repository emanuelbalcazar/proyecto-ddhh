angular.module('app.routes', [])
.config(['$routeProvider', function($routeProvider) {
	$routeProvider
	.when('/personas', {
		templateUrl: 'partials/content/people/peopleList.html',
		controller: 'PeopleListCtrl'
	})
	.when('/personas/:id/alertas', {
		templateUrl: 'partials/content/people/alertList.html',
		controller: 'AlertListCtrl'
	})
	.when('/nuevo_caso', {
		templateUrl: 'partials/content/affair/basicData.html',
		controller: 'AffairBasicDataCtrl'
	})
	.when('/nuevo_caso/posibles_candidatos', {
		templateUrl: 'partials/content/affair/matchingPeople.html',
		controller: 'AffairMatchingPeopleCtrl'
	})
	.when('/nuevo_caso/completar', {
		templateUrl: 'partials/content/affair/fullData.html',
		controller: 'AffairFullDataCtrl'
	})
	.when('/configuracion', {
		templateUrl: 'partials/content/config/config.html',
		controller: 'ConfigCtrl'
	})
	.when('/reportes', {
		templateUrl: 'partials/content/reports/reports.html',
		controller: 'ReportsCtrl'
	})
	.otherwise({
		redirectTo: '/'
	});
}]);
