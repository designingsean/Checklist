var checklist = angular.module("checklist", [])
.config(function($locationProvider, $routeProvider) {
    $routeProvider
        .when("/", { controller: "checklist", templateUrl: "app/views/checklist.html" })
        .when("/admin", { controller: "tasks", templateUrl: "app/views/tasks.html" })
        .otherwise({ redirectTo: '/checklist' });
})
.factory('usersApi', ['$http', function($http) {
    return {
        get : function() {
            return $http.get("/checklist/api/?action=usersGet");
        }
    };
}])
.factory('tasksApi', ['$http', function($http) {
    return {
        add : function(formData) {
            return $http({
                method: 'POST',
                url: "/checklist/api/?action=callsAdd",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $.param(formData)
            });
        },
        get : function(completed) {
            return $http.get("/checklist/api/?action=callsGet&completed=" + completed);
        },
        update : function(id) {
            return $http.get("/checklist/api/?action=callsUpdate&id=" + id);
        }
    };
}])
.factory('checklistApi', ['$http', function($http) {
    return {
        add : function(formData) {
            return $http({
                method: 'POST',
                url: "/checklist/api/?action=notesAdd",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $.param(formData)
            });
        },
        get : function(call) {
            return $http.get("/checklist/api/?action=notesGet&call=" + call);
        }
    };
}]);