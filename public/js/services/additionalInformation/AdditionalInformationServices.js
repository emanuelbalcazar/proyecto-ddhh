appServices.service('AdditionalInformationService', ['$http', 'UtilsService', function($http, UtilsService) {

	this.towns = function(filters, callback) {
		var query = UtilsService.concatFilters(filters);
		$http.get('additional_information/towns/?' + query)
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.documentTypes = function(callback) {
		$http.get('additional_information/document_types')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.contactTypes = function(callback) {
		$http.get('additional_information/contact_types')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.contextures = function(callback) {
		$http.get('additional_information/contextures')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.hairColors = function(callback) {
		$http.get('additional_information/hair_colors')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.eyeColors = function(callback) {
		$http.get('additional_information/eye_colors')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.skinColors = function(callback) {
		$http.get('additional_information/skin_colors')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.genders = function(callback) {
		$http.get('additional_information/genders')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.kinships = function(callback) {
		$http.get('additional_information/kinships')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.caseStatus = function(callback) {
		$http.get('additional_information/case_status')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

	this.caseTypes = function(callback) {
		$http.get('additional_information/case_types')
		.success(function(result) {
			return callback(null, result);
		})
		.error(function(error) {
			return callback(error);
		});
	};

}]);
