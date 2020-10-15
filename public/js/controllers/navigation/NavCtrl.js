appControllers.controller('NavCtrl', ['$scope', '$location', function($scope, $location) {

	$scope.routes = [
	     {
	    	 url: '/nuevo_caso',
	    	 name: 'Nuevo caso',
				 icon: 'fa-user-plus',
				 description: 'Ingresar un nuevo caso'
	     },{
	    	 url: '/personas',
	    	 name: 'Personas',
				 icon: 'fa-users',
				 description: 'Administración de personas'
	     },{
	    	 url: '/reportes',
	    	 name: 'Reportes',
				 icon: 'fa-bar-chart',
				 description: 'Reportes y gráficos'
	     },{
	    	 url: '/configuracion',
	    	 name: 'Configuración',
				 icon: 'fa-cog',
				 description: 'Configuraciones del sistema'
	     }
    ];

	$scope.isCurrent = function(r) {
		return ($location.path() === r.url);
	};

}]);
