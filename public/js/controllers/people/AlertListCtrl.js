appControllers.controller('AlertListCtrl', [ '$scope', '$rootScope', '$routeParams', 'AlertService', 'PersonCaseServices', 'AdditionalInformationService', 'dialogs',
function($scope, $rootScope, $routeParams, AlertService, PersonCaseServices, AdditionalInformationService, dialogs) {

  if (!$routeParams.id || isNaN($routeParams.id)) {
    dialogs.notify('Ruta inválida', 'La ruta ingresada no corresponde a un listado de alertas válido.');
    $rootScope.back();
  }

  $scope.alerts = [];

  $scope.page = 1;
  $scope.total = 0;
  $scope.pageSize = 10;
  $scope.wrongYear = false;
  $scope.filters = {personId: $routeParams.id};

  $scope.findAndReset = function() {
    $scope.total = 0;
    $scope.page = 1;
    $scope.pageSize = 10;
    $scope.find();
  };

  $scope.find = function() {
    var fixPage = $scope.page-1;
    AlertService.find($scope.filters, fixPage, $scope.pageSize, function(error, result) {
      if (error) {
        dialogs.error('Error', 'Ocurrio un error al obtener el listado de alertas.');
        return;
      }
      $scope.total = result.total;
      $scope.alerts = result.data;
    });
  };

  $scope.$on('refreshAlerts', function (event, data) {
    $scope.find();
  });

  $scope.$on('ignoreAndRefreshAlerts', function (event, data) {
    for (var i = 0; i < $scope.alerts.length; i++) {
      if ($scope.alerts[i].id == data) {
          $scope.alerts.splice(i, 1);
          break;
      }
    }
  });

  function getNamesById() {
    // TODO agregar validacion para id= NULL o nan
    PersonCaseServices.getNamesById($routeParams.id, function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.names = res;
    });
  }

  function getDocumentTypes() {
    AdditionalInformationService.documentTypes(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.documentTypes = res;
    });
  }

  $scope.alertListDatepicker = {
    status: false
  };

  $scope.calculateClass = function(a) {
    if (!a) { return ''; }
    var c = 3;
    if (a.criticality == 'AMARILLO') {
      c = 2;
    }
    if (a.criticality == 'ROJO') {
      c = 1;
    }
    return 'alert-' + c;
  };

  getNamesById();
  getDocumentTypes();
  $scope.findAndReset();
}]);
