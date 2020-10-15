appServices.service('LoginService', ['$http', function($http) {

	this.login = function(user, password, callback) {
		$http.post('/login', {username: user, password: password})
		.success(function(result) {
			return callback(false, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

}]);
