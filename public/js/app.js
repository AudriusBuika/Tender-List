var app = angular.module("tender", ["ngSanitize"]);

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});

app.controller("tenderListController", ["$scope","$http","$log", function($scope, $http, $log) {
    
    $scope.tenders = null;

    var successCallBack = function(response) {
        $scope.tenders = response.data.tender;
    }
    var failureCallBack = function(response) {
        $scope.error = response.data;
    }

    // load list function
    var loadData = function() {
        $http({
            method: 'GET',
            url: '/list/50'
        }).then(successCallBack, failureCallBack);
    };
    loadData(); // load data
    
    // Delete record function
    $scope.Delete = function(id) {
        $http({
            method: 'GET',
            url: '/delete/'+id
        }).then(function(response) {
            loadData();
        });
    };

    // update tender record
    $scope.Update = function(id) {
        
        var data = {
            title: $scope.title,
            description: 'sdfsdf',
        };

        $http.post('/update/'+id, JSON.stringify(data)).then(function (response) {
            loadData();
        }, function (response) {});
    }

    // create tender record
    $scope.Create = function() {
    
        var data = {
            title: $scope.createTitle,
            description: $scope.createDescription,
        };

        $http.post('/create', JSON.stringify(data)).then(function (response) {
            loadData();
        }, function (response) {});
    }

}]);