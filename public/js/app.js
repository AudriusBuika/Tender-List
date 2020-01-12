var app = angular.module("tender", ["ngSanitize"]);

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});

app.controller("tenderListController", ["$scope", function($scope) {
    $scope.kazkas = "oho";
}]);