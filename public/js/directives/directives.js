var appDirectives = angular.module('app.directives', []);

appDirectives.directive('defaultButtons', function() {
  return {
    restrict: "E",
    templateUrl: 'partials/navigation/defaultButtons.html'
  };
});

appDirectives.directive('separator', function() {
  return {
    restrict: "E",
    template: '<span class="separator"></span>'
  };
});

appDirectives.directive('onOk', function() {
  return function(scope, element, attrs) {
    element.bind("keydown keypress", function(event) {
      if (event.which === 13) {
        scope.$apply(function() {
          scope.$eval(attrs.onOk);
        });
        event.preventDefault();
      }
    });
  };
});

appDirectives.directive('flatTooltip', function() {
  return {
    restrict: "A",
    controller: function() {
      $('[data-toggle="tooltip"]').tooltip();
    }
  };
});
