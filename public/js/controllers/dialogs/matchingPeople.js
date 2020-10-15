appControllers.controller('MatchingPeopleModalCtrl', ['$scope', 'PersonCaseServices', '$http', '$location', '$rootScope', '$uibModalInstance', 'data', 'UtilsService',
function($scope, PersonCaseServices, $http, $location, $rootScope, $uibModalInstance, data, UtilsService) {

  // TODO abrir el modal y ejecutar el matching aca... a traves del data le paso el 'nombre' apellido y demas cosas.
  $scope.getPhoto = function(p) {
    return UtilsService.getPhoto(p);
  };

  $scope.getNationality = function(p) {
    return UtilsService.getNationality(p);
  };

  function getPeople() {
    // $scope.people = PersonCaseServices.matching(data, function(err, res){}); //TODO aca esta la truchada
  }

  $scope.getAddress = function(p) {
    return UtilsService.getAddress(p);
  };

  $scope.calculateClass = function(p) {
    var c = 1;
    var inc = 100/11; // 11 colores.
    var range = inc;
    while (p.weightNumber > range) {
      c++;
      range += inc;
    }
    return 'bs-callout bs-callout-warning-' + c;
  };


  $scope.selected = function(index) {
    $rootScope.selectedPerson = $scope.people[index];
    $location.path('/nuevo_caso/completar');
  };

  $scope.noneSelected = function() {
    $rootScope.selectedPerson = null;
    $location.path('/nuevo_caso/completar');
  };


  $scope.filters = {
    personNames: '',
    personSurnames: '',
    personBirthdateYear: '',
    personBirthdateMonth: '',
    personBirthdateDay: '',
    documentNumber: ''
  };


  $scope.checkMatchingPeople = function() {
    for (var i in $scope.filters) {
      if ($scope.filters[i] === null || $scope.filters[i] === undefined || $scope.filters[i] === '') {
        delete $scope.filters[i];
      }
    }
    PersonCaseServices.matching($scope.filters, function(err, res) {
      if (err) {
        //dialogs.error('Error', 'Ocurrio un error al tratar de obtener un listado de personas similares.');
        return;
      }
      $scope.person.names = $scope.filters.personNames;
      $scope.person.surnames = $scope.filters.personSurnames;
      $scope.person.document_number = $scope.filters.documentNumber;
      $scope.person.birthdate = $scope.filters.birthdate;

      $rootScope.fillPerson = $scope.person;
      if (res && res.length > 0) {
        $rootScope.matchingPeople = res;
        $location.path('/partials/dialogs/matchingPeople.html');
        return;
      }
      $location.path('/nuevo_caso/completar');
    });
  };

  getPeople();

}]);
