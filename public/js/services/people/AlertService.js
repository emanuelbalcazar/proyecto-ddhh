appServices.service('AlertService', ['$http', 'UtilsService', function($http, UtilsService) {

  this.find = function(filters, page, pageSize, callback) {
    var query = UtilsService.concatFilters(filters);
    if (page !== null && pageSize !== null) {
      query = query + '&page=' + page + '&pageSize=' + pageSize;
    }
    $http.get('alerts/?' + query)
    .success(function(result) {
      return callback(null, result);
    })
    .error(function(error) {
      return callback(error);
    });
  };

  this.acceptAlert = function(alert, callback) {
    $http.post('alerts/accept', alert)
    .success(function(result) {
      return callback(null, result);
    })
    .error(function(error) {
      return callback(error);
    });
  };

  this.rejectAlert = function(alert, callback) {
    $http.post('alerts/reject', alert)
    .success(function(result) {
      return callback(null, result);
    })
    .error(function(error) {
      return callback(error);
    });
  };

}]);
