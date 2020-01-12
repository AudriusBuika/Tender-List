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
            url: '/list'
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

    $scope.Update = function(id) {
        
    }
    
}]);