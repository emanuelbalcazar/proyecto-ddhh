appServices.service('Session', ['$http', '$rootScope', function ($http, $rootScope) {
    var session = {

        init: function () {
            this.resetSession();
        },

        resetSession: function() {
            this.currentUser = null;
        },

        logout: function(callback) {
            var scope = this;
            $http['delete']('/auth')
            .success(function(result) {
                scope.resetSession();
                $rootScope.$emit('session-changed');
                $rootScope.$broadcast('updateContext');
                callback(null, result);
            })
            .error(function(error) {
                callback(error);
            });
        },

        authSuccess: function(userData) {
            this.currentUser = userData;
        },

        getAuthenticatedUser: function() {
            return this.currentUser;
        },

        authFailed: function() {
            this.resetSession();
        },

        isUserLoggedIn: function() {
            return this.currentUser !== null;
        },

        UserHasValidRoleForRoute: function(roles) {
            return (this.currentUser && this.currentUser.role && roles && (roles.indexOf(this.currentUser.role) !== -1));
        }

    };
    session.init();
    return session;
}]);
