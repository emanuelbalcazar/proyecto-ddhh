appControllers.controller('AffairMatchingPeopleCtrl', ['$scope', '$rootScope', '$location', 'UtilsService',
  function($scope, $rootScope, $location, UtilsService) {

  function getPeople() {
    $scope.people = $rootScope.matchingPeople;
    $scope.person = $rootScope.selectedPerson;
  }

  $scope.backToBasicDataForm = function() {
    $rootScope.selectedPerson = $scope.person;
    $rootScope.back();
  };

  $scope.getPhoto = function(p) {
    return UtilsService.getPhoto(p);
  };

  $scope.getNationality = function(p) {
    return UtilsService.getNationality(p);
  };

  $scope.getAddress = function(p) {
    return UtilsService.getAddress(p);
  };

  // SE PUEDE OPTIMIZAR!
  // TODO: Testear!!!!!!!
  $scope.calculateClass = function(p) {
    var c = 1;
    var inc = 100/11; // 11 colores.
    var range = inc;
    while (p.weight > range) {
      c++;
      range += inc;
    }
    return 'bs-callout bs-callout-warning-' + c;
  };

  $scope.selected = function(index) {
    var person = $scope.people[index];
    for (var key in $scope.person) {
      if (!person[key] && $scope.person.hasOwnProperty(key)) {
        person[key] = $scope.person[key];
      }
    }
    person.person_id = person.id;
    delete person.id;
    $rootScope.selectedPerson = person;
    $location.path('/nuevo_caso/completar');
  };

  $scope.noneSelected = function() {
    $location.path('/nuevo_caso/completar');
  };

  getPeople();
}]);
