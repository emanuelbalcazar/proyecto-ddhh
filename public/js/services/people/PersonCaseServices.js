appServices.service('PersonCaseServices', ['$http', 'UtilsService', function($http, UtilsService) {

    this.find = function(filters, page, pageSize, callback) {
        var query = UtilsService.concatFilters(filters);
        if (page !== null && pageSize !== null) {
            query = query + '&page=' + page + '&pageSize=' + pageSize;
        }
        $http.get('persons/?' + query)
        .success(function(result) {
            return callback(null, result);
        })
        .error(function(error) {
            return callback(error);
        });
    };

    this.matching = function(filters, callback) {
        var query = UtilsService.concatFilters(filters);
        $http.get('persons/matching/?' + query)
        .success(function(result) {
            return callback(null, result);
        })
        .error(function(error) {
            return callback(error);
        });
    };

    this.save = function(personCase, callback) {
        $http.post('persons/store', personCase)
        .success(function(result) {
            return callback(null, result);
        })
        .error(function(error) {
            return callback(error);
        });
    };

    this.getNamesById = function(id, callback) {
        var query = UtilsService.concatFilters({id: id});
        $http.get('persons/names_by_id/?' + query)
        .success(function(result) {
            return callback(null, result);
        })
        .error(function(error) {
            return callback(error);
        });
    };

}]);
