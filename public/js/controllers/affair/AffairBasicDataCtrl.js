appControllers.controller('AffairBasicDataCtrl', ['$scope', '$rootScope', '$location', 'dialogs', 'AdditionalInformationService', 'PersonCaseServices',
function($scope, $rootScope, $location, dialogs, AdditionalInformationService, PersonCaseServices) {

  $scope.wrongYear = false;

  $scope.dateOptions = {
    showWeeks: false,
    maxDate: new Date()
  };

  // Datos del formulario
  $scope.person = {
    type: null,
    status: null,
    date: new Date(),
    age_fact: '',
    place: '',
    reason: '',
    names: '',
    surnames: '',
    birthdate: '',
    document_number: '',
    raw: { // Eliminar al guardar.
      birthdateYear: '',
      birthdateMonth: '',
      birthdateDay: ''
    }
  };

  $scope.filters = {
    personNames: '',
    personSurnames: '',
    personBirthdateYear: '',
    personBirthdateMonth: '',
    personBirthdateDay: '',
    documentNumber: ''
  };

  function populateFilters() {
    $scope.filters.personNames = $scope.person.names;
    $scope.filters.personSurnames = $scope.person.surnames;
    $scope.filters.personBirthdateYear = $scope.person.raw.birthdateYear;
    $scope.filters.personBirthdateMonth = $scope.person.raw.birthdateMonth;
    $scope.filters.personBirthdateDay = $scope.person.raw.birthdateDay;
    $scope.filters.documentNumber = $scope.person.document_number;
  }

  function getPeople() {
    if ($rootScope.selectedPerson) {
      $scope.person = $rootScope.selectedPerson;
      populateFilters();
    }
  }

  function removeInvalidFilters() {
    for (var i in $scope.filters) {
      if ($scope.filters[i] === null || $scope.filters[i] === undefined || $scope.filters[i] === '') {
        delete $scope.filters[i];
      }
    }
  }

  function makePersonFromFilters() {
    $scope.person.names = $scope.filters.personNames;
    $scope.person.surnames = $scope.filters.personSurnames;
    $scope.person.document_number = $scope.filters.documentNumber;
    $scope.person.raw = { // Eliminar al guardar.
      birthdateYear: $scope.filters.personBirthdateYear,
      birthdateMonth: $scope.filters.personBirthdateMonth,
      birthdateDay: $scope.filters.personBirthdateDay
    };
    if ($scope.person.raw.birthdateYear && $scope.person.raw.birthdateMonth && $scope.person.raw.birthdateDay) {
      $scope.person.birthdate = new Date($scope.person.raw.birthdateYear, $scope.person.raw.birthdateMonth-1, $scope.person.raw.birthdateDay);
    }
    $rootScope.selectedPerson = $scope.person;
  }

  $scope.checkMatchingPeople = function() {
    if (!validCaseData()) {
      dialogs.notify('Atención', 'Debe ingresar fecha, tipo y estado de caso para continuar.');
      return;
    }
    removeInvalidFilters();
    PersonCaseServices.matching($scope.filters, function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al tratar de obtener un listado de personas similares.');
        return;
      }
      makePersonFromFilters();
      if (res && res.length > 0) {
        $rootScope.matchingPeople = res;
        $location.path('/nuevo_caso/posibles_candidatos');
        return;
      }
      $location.path('/nuevo_caso/completar');
    });
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
    $scope.wrongYear = !(/^\d{4}$/g).test($scope.filters.personBirthdateYear) ||
                        $scope.filters.personBirthdateYear > currYear ||
                        $scope.filters.personBirthdateYear < currYear-100;
  };

  // INICIO DE METODOS DE DATOS DEL CASO

  $scope.affairDataDatepicker = {
    status: false
  };

  $scope.openAffairDataDatepicker = function() {
    $scope.affairDataDatepicker = {
      status: true
    };
  };

  function validCaseData() {
    return $scope.person.status && $scope.person.type && $scope.person.date;
  }

  function getCaseStatus() {
    AdditionalInformationService.caseStatus(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.caseStatus = res;
    });
  }

  function getCaseTypes() {
    AdditionalInformationService.caseTypes(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.caseTypes = res;
    });
  }

  // FIN DE METODOS DE DATOS DEL CASO

  // LLAMADO A FUNCIONES DE INICIALIZACIONES Y RECUPERACION DE DATOS ADICIONALES.
  getCaseStatus();
  getCaseTypes();
  getPeople();
}]);
