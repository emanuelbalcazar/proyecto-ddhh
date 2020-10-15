appControllers.controller('PeopleListCtrl', ['$scope', 'dialogs', '$location', 'UtilsService', 'PersonCaseServices', 'AdditionalInformationService',
  function($scope, dialogs, $location, UtilsService, PersonCaseServices, AdditionalInformationService) {

  $scope.genders = [];
  $scope.persons = [];
  $scope.filters = {};

  $scope.page = 1;
  $scope.total = 0;
  $scope.pageSize = 10;
  $scope.wrongYear = false;

  $scope.ageSelectOptions = [
    {
    	name: '0 a 5',
    	value: '0_5'
    }, {
    	name: '6 a 12',
    	value: '6_12'
    }, {
    	name: '13 a 17',
    	value: '13_17'
    }, {
    	name: '18 a 21',
    	value: '18_21'
    }, {
    	name: '22 a 35',
    	value: '22_35'
    }, {
    	name: '36 a 65',
    	value: '36_65'
    }, {
    	name: '65+',
    	value: '65_150'
    }
  ];

  function getGenders() {
    AdditionalInformationService.genders(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.genders = res;
    });
  }

  $scope.findAndReset = function() {
    $scope.total = 0;
    $scope.page = 1;
    $scope.pageSize = 10;

    if ($scope.filters.range) {
      for (var key in $scope.filters.range) {
        if ($scope.filters.range.hasOwnProperty(key)) {

          $scope.filters.range[key] = $scope.filters.range[key].value;
        }
      }
    }

    console.log($scope.filters);

    $scope.find();
  };

  $scope.find = function() {
    var fixPage = $scope.page-1;
    PersonCaseServices.find($scope.filters, fixPage, $scope.pageSize, function(error, result) {
      if (error) {
        dialogs.error('Error', 'Ocurrio un error al obtener el listado de personas.');
        return;
      }
      $scope.total = result.total;
      $scope.persons = result.data;
    });
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

  /**
  * Segun criticidad de alertas, devuelve:
  * warning(amarillo), danger(rojo), o success(verde).
  */
  $scope.classFromCriticality = function(p) {
    if (p) {
      var crit = p.max_criticality ? p.max_criticality : 0;
      var classes = ['success', 'success', 'warning', 'danger'];
      return 'btn-' + classes[crit];
    }
    return '';
  };

  $scope.personAlerts = function(p) {
    if (p) {
      return p.count_alerts || 0;
    }
    return 0;
  };

  // INICIO DE FUNCIONES DE VALIDACION

  $scope.birthdateDayValidator = function() {
    if (!$scope.filters.personBirthdateDay) {
      return false;
    }
    return !(/^\d+$/g).test($scope.filters.personBirthdateDay) || $scope.filters.personBirthdateDay > 31;
  };

  $scope.birthdateMonthValidator = function() {
    if (!$scope.filters.personBirthdateMonth) {
      return false;
    }
    return !(/^\d+$/g).test($scope.filters.personBirthdateMonth) || $scope.filters.personBirthdateMonth > 12;
  };

  $scope.birthdateYearValidator = function() {
    if (!$scope.filters.personBirthdateYear) {
      return false;
    }
    return !(/^\d+$/g).test($scope.filters.personBirthdateYear);
  };

  $scope.birthdateYearValidatorOnBlur = function() {
    if (!$scope.filters.personBirthdateYear) {
      $scope.wrongYear = false;
      return;
    }
    var currYear = new Date().getFullYear();
    $scope.wrongYear = !(/^\d{4}$/g).test($scope.filters.personBirthdateYear) || $scope.filters.personBirthdateYear > currYear;
  };



  // FIN DE FUNCIONES DE VALIDACION

  $scope.findAndReset();
  getGenders();
}]);
