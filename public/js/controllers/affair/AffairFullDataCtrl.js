appControllers.controller('AffairFullDataCtrl', ['$scope', '$rootScope', '$timeout', '$http', '$location', 'dialogs', 'Upload', 'UtilsService', 'PersonCaseServices', 'AdditionalInformationService',
function($scope, $rootScope, $timeout, $http, $location, dialogs, Upload, UtilsService, PersonCaseServices, AdditionalInformationService) {

  // TODO: Implementar con modal.
  $scope.$on("$locationChangeStart", function(event) {
    if (!confirm('Esta a punto de abandonar el formulario sin guardar los cambios ¿ Está seguro que desea continuar ?')) {
      event.preventDefault();
    }
  });

  $scope.person = {
    id: null,
    type: '',
    status: '',
    reason: '',
    place: '',
    date: new Date(),
    age_fact: '',
    names: '',
    surnames: '',
    gender: '',
    birthdate: '',
    nationality: '',
    observations: '',
    address_street: '',
    address_number: '',
    address_floor: '',
    address_dept: '',
    address_town_name: '', // Nombre, buscar con esto el id.
    address_town_id: '', // Lo busca en base al nombre, al guardar.
    document_number: '',
    document_type_id: '',
    weight: '',
    height: '',
    contexture: '',
    hair_color: '',
    skin_color: '',
    eye_color: '',
    clothing: '',
    special_peculiarities: '',
    family_members: [],
    contact_data: [],
    photo: '',
    raw: { // Eliminar al guardar.
      birthdateYear: '',
      birthdateMonth: '',
      birthdateDay: ''
    }
  };

  function getPerson() {
    if ($rootScope.selectedPerson) {
      for (var key in $rootScope.selectedPerson) {
        if ($rootScope.selectedPerson.hasOwnProperty(key)) {
          $scope.person[key] = $rootScope.selectedPerson[key];
        }
      }
      $scope.person.address_town_name = $scope.person.address_town;
      delete $scope.person.address_town;
    }
  }

  $scope.backToList = function() {
    // Si tiene fecha de nacimiento valida.
    if ($scope.person.birthdate && $scope.person.birthdate.trim() !== '') {
      var d = new Date($scope.person.birthdate);
      if (!isNaN(d.getTime())) {
        $scope.person.raw = {
          birthdateYear: d.getDate(),
          birthdateMonth: d.getMonth()+1,
          birthdateDay: d.getFullYear()
        };
      }
    }
    $rootScope.selectedPerson = $scope.person;
    $rootScope.back();
  };

  // INICIO CONTROL DE PESTAÑAS

  $scope.affairTabs = [
    {
      name: 'Datos básicos',
      src: 'partials/content/affair/steps/generalData.html',
      active: true,
      visited: true
    }, {
      name: 'Características',
      src: 'partials/content/affair/steps/biometricData.html',
      active: false,
      visited: false
    }, {
      name: 'Familiares',
      src: 'partials/content/affair/steps/familyData.html',
      active: false,
      visited: false
    }, {
      name: 'Contacto',
      src: 'partials/content/affair/steps/contactData.html',
      active: false,
      visited: false
    }
  ];

  $scope.selectTab = function(index, tabArray) {
    for (var i = 0; i < tabArray.length; i++) {
      tabArray[i].active = false;
    }
    tabArray[index].active = true;
    tabArray[index].visited = true;

  };

  $scope.next = function(tabArray) {
    var curr = 0;
    for (var i = 0; i < tabArray.length; i++) {
      if (tabArray[i].active) {
        curr = i;
      }
      tabArray[i].active = false;
    }
    if ((curr + 1) === tabArray.length) {
      tabArray[curr].active = true;
      return;
    }
    tabArray[curr + 1].active = true;
    tabArray[curr + 1].visited = true;
  };

  $scope.prev = function(tabArray) {
    var curr = 0;
    for (var i = 0; i < tabArray.length; i++) {
      if (tabArray[i].active) {
        curr = i;
      }
      tabArray[i].active = false;
    }
    if ((curr - 1) < 0) {
      tabArray[curr].active = true;
      return;
    }
    tabArray[curr - 1].active = true;
    tabArray[curr - 1].visited = true;
  };

  // FIN CONTROL DE PESTAÑAS

  // INICIALIZACIONES DE VARIABLES AUXILIARES
  $scope.genders = [];
  $scope.contacts = [];
  $scope.kinships = [];
  $scope.eyeColors = [];
  $scope.caseTypes = [];
  $scope.caseStatus = [];
  $scope.caseStates = [];
  $scope.hairColors = [];
  $scope.skinColors = [];
  $scope.contextures = [];
  $scope.documentTypes = [];

  $scope.dateOptions = {
    showWeeks: false,
    maxDate: new Date()
  };

  // GUARDA UN NUEVO CASO.
  // TODO Posibles mejoras: El sistema para obtener el Id de la localidad!
  $scope.save = function() {
    function savePerson() {
      delete $scope.person.raw;
      PersonCaseServices.save($scope.person, function(err) {
        if (err) {
          $scope.fieldErrors = err;
          dialogs.error('Error', 'Ocurrio un error guardar los datos del caso.');
          return;
        }
        $location.path('/');
      });
    }
    function removeFamilyMemberTown(index) {
      delete $scope.person.family_members[index].address_town_name;
      delete $scope.person.family_members[index].address_town_id;
    }
    var dlg;

    dlg = dialogs.confirm('Guardar caso', '¿ Está seguro que desea ingresar el nuevo caso ?');
    dlg.result.then(
      function() {
        var names = [];
        if ($scope.person.address_town_name) {
          names.push($scope.person.address_town_name);
        }
        for (var i = 0; i < $scope.person.family_members.length; i++) {
          if ($scope.person.family_members[i].address_town_name) {
            names.push($scope.person.family_members[i].address_town_name);
          }
        }
        if (names && names.length) {
          AdditionalInformationService.towns({nameList: names}, function(err, res) {
            if (err) {
              dialogs.error('Error', 'Ocurrio un error guardar los datos del caso.');
              return;
            }
            if (res) {
              var i;
              var re;
              if ($scope.person.address_town_name) {
                for (i = 0; i < res.length; i++) {
                  re = new RegExp($scope.person.address_town_name, "ig");
                  if (re.test(res[i].name)) {
                    $scope.person.address_town_id = res[i].id;
                    delete $scope.person.address_town_name;
                    break;
                  }
                }
              }
              for (i = 0; i < $scope.person.family_members.length; i++) {
                for (var j = 0; j < res.length; j++) {
                  re = new RegExp($scope.person.family_members[i].address_town_name, "ig");
                  if (re.test(res[j].name)) {
                    $scope.person.family_members[i].address_town_id = res[j].id;
                    delete $scope.person.family_members[i].address_town_name;
                    break;
                  }
                }
              }
              if ($scope.person.address_town_name) {
                dlg = dialogs.confirm('Error', 'Ocurrio un error al establecer la localidad de la persona.<br>' +
                '¿ Desea continuar de todos modos ? (Este dato no se podrá guardar)<br><br>' +
                'Se sugiere cancelar el proceso y reescribir correctamente la localidad.');
                dlg.result.then(
                  function() {
                    delete $scope.person.address_town_name;
                    delete $scope.person.address_town_id;
                  },
                  function() {
                    return;
                  }
                );
              }
              for (i = 0; i < $scope.person.family_members.length; i++) {
                if ($scope.person.family_members[i].address_town_name) {
                  // TODO no se pudo encontrar el id correspondiente al familiar "i".
                  // Mostrar mensaje bonito pa que lo escriba bien.
                  dlg = dialogs.confirm('Error', 'Ocurrio un error al establecer la localidad del pariente N° ' + (i+1) + '.<br>' +
                  '¿ Desea continuar de todos modos ? (Este dato no se podrá guardar)<br><br>' +
                  'Se sugiere cancelar el proceso y reescribir correctamente la localidad.');
                  dlg.result.then(
                    removeFamilyMemberTown(i),
                    function() {
                      return;
                    }
                  );
                }
              }
            }
            savePerson();
          });
        } else {
          savePerson();
        }
      },
      function() {
        return;
      }
    );
  };

  // INICIO DE METODOS DE PESTAÑA DE DATOS GENERALES

  $scope.generalDataDatepicker = {
    status: false
  };

  $scope.openGeneralDataDatepicker = function() {
    $scope.generalDataDatepicker = {
      status: true
    };
  };

  function getDocumentTypes() {
    AdditionalInformationService.documentTypes(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.documentTypes = res;
    });
  }

  // RECUPERA PAISES.
  $scope.getCountries = function(filters) {
    // TODO Mejorar!! Implementar promises en el service
    return $http.get('additional_information/countries/?' + 'name=' + filters)
    .then(function(response) {
      return response.data.map(function(itm) {
        itm.name = UtilsService.capitalizeEachWord(itm.name);
        return itm;
      });
    });
  };

  // RECUPERA LOCALIDADES.
  $scope.getTowns = function(filters) {
    // TODO Mejorar!! Implementar promises en el service
    return $http.get('additional_information/towns/?' + 'name=' + filters)
    .then(function(response) {
      return response.data.map(function(itm) {
        itm.name = UtilsService.capitalizeEachWord(itm.name);
        return itm;
      });
    });
  };

  $scope.getNames = function(filters) {
    return $http.get('additional_information/names/?names=' + filters)
    .then(function(response) {
      return response.data.map(function(itm) {
        return {name: UtilsService.capitalizeEachWord(itm.names)};
      });
    });
  };

  $scope.getSurnames = function(filters) {
    return $http.get('additional_information/surnames/?surnames=' + filters)
    .then(function(response) {
      return response.data.map(function(itm) {
        return {surname: UtilsService.capitalizeEachWord(itm.surnames)};
      });
    });
  };

  // FIN DE METODOS DE PESTAÑA DE DATOS GENERALES

  // INICIO DE METODOS DE PESTAÑA DE CARACTERISICAS

  $scope.openCaseDatepicker = function() {
    $scope.openedCaseDatepicker = {
      status: true
    };
  };

  function getGenders() {
    AdditionalInformationService.genders(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.genders = res;
    });
  }

  function getContextures() {
    AdditionalInformationService.contextures(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.contextures = res;
    });
  }

  function getHairColors() {
    AdditionalInformationService.hairColors(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.hairColors = res;
    });
  }

  function getSkinColors() {
    AdditionalInformationService.skinColors(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.skinColors = res;
    });
  }

  function getEyeColors() {
    AdditionalInformationService.eyeColors(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.eyeColors = res;
    });
  }

  // FIN DE METODOS DE PESTAÑA DE CARACTERISICAS

  // INICIO DE METODOS DE PESTAÑA DE FAMILIARES

  $scope.familyDataDatepicker = {
    status: false
  };

  $scope.familyMemberBirthdate = {
    status: false
  };

  function getKinships() {
    AdditionalInformationService.kinships(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.kinships = res;
    });
  }

  $scope.findKinshipsById = function(familyGroupsTypesId){
    for (var i = 0; i < $scope.kinships.length; i++) {
      if($scope.kinships[i].id == familyGroupsTypesId){
        return $scope.kinships[i].rol;
      }
    }
    return "";
  };

  function resetFamilyMember() {
    $scope.familyMember = {
      names: '',
      surnames: '',
      phones: '',
      birthdate: '',
      family_groups_types_id: '',
      complainant: $scope.person.family_members.length ? false : true,
      complainant_date: new Date(),
      document_number: '',
      document_type: '',
      address_street: '',
      address_number: '',
      address_floor: '',
      address_dept: '',
      address_town_name: '', // Nombre, buscar con esto el id.
      address_town_id: '', // Lo busca en base al nombre, al guardar.
      case_id: ''
    };
  }

  $scope.addFamilyMember = function() {
    // openMatchingPeopleModal();
    $scope.person.family_members.push($scope.familyMember);
    resetFamilyMember();
  };

  $scope.removeFamilyMember = function(index) {
    $scope.person.family_members.splice(index, 1);
  };

  $scope.openFamilyDataDatepicker = function() {
    $scope.familyDataDatepicker = {
      status: true
    };
  };

  $scope.openFamilyMemberBirthdate = function() {
    $scope.familyMemberBirthdate = {
      status: true
    };
  };

  $scope.personStreetName = function() {
    var res = [];
    if ($scope.person.address_street) {
      res.push($scope.person.address_street);
    }
    return res;
  };

  $scope.personStreetNumber = function() {
    var res = [];
    if ($scope.person.address_number) {
      res.push($scope.person.address_number);
    }
    return res;
  };

  $scope.personStreetFloor = function() {
    var res = [];
    if ($scope.person.address_floor) {
      res.push($scope.person.address_floor);
    }
    return res;
  };

  $scope.personStreetDept = function() {
    var res = [];
    if ($scope.person.address_dept) {
      res.push($scope.person.address_dept);
    }
    return res;
  };

  // FIN DE METODOS DE PESTAÑA DE FAMILIARES

  // INICIO DE METODOS DE PESTAÑA DE CONTACTO

  function getContactTypes() {
    AdditionalInformationService.contactTypes(function(err, res) {
      if (err) {
        dialogs.error('Error', 'Ocurrio un error al obtener tipologias para el formulario.');
        return;
      }
      $scope.contacts = res;
    });
  }

  function resetContact() {
    $scope.contact = {
      contact_data_type_id: '',
      value: ''
    };
  }

  $scope.getTypeName = function(contact) {
    for (var i = 0; i < $scope.contacts.length; i++) {
      if (contact.contact_data_type_id == $scope.contacts[i].id) {
        return $scope.contacts[i].type;
      }
    }
  };

  $scope.addContact = function() {
    $scope.person.contact_data.push($scope.contact);
    resetContact();
  };

  $scope.removeContact = function(index) {
    $scope.person.contact_data.splice(index, 1);
  };

  // FIN DE METODOS DE PESTAÑA DE CONTACTO

  // LLAMADO A FUNCIONES DE INICIALIZACIONES Y RECUPERACION DE DATOS ADICIONALES.
  resetFamilyMember();
  resetContact();

  getPerson();
  getGenders();
  getKinships();
  getEyeColors();
  getSkinColors();
  getHairColors();
  getContextures();
  getContactTypes();
  getDocumentTypes();
}]);
