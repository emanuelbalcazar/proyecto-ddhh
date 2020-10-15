appControllers.controller('NewDataCtrl', [ '$scope', 'AlertService', 'dialogs', function($scope, AlertService, dialogs) {

  $scope.accept = function(alert) {
    console.log(alert);
    AlertService.acceptAlert(alert, function(error, result) {
      if (error) {
        dialogs.error('Error', 'Ocurrio un error al aceptar la alerta.');
        return;
      }
      $scope.$emit('refreshAlerts', 'Nada');
    });
  };

  $scope.reject = function(alert) {
    AlertService.rejectAlert(alert, function(error, result) {
      if (error) {
        dialogs.error('Error', 'Ocurrio un error al rechazar la alerta.');
        return;
      }
      $scope.$emit('refreshAlerts', 'Nada');
    });
  };

  $scope.ignore = function(alert) {
    $scope.$emit('ignoreAndRefreshAlerts', alert.id);
  };

}]);
