/**
 * Created by Peace Ngara on 4/9/2017.
 * Angular Search and Filter
 * This Implementation uses Angular to query a RESTFul API Service and Return Results
 */

var notebooks = angular.module('tools', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

notebooks.controller('ToolsListCtrl', function($scope, $http) {
    $scope.tools = [];
    $scope.loading = false;

    $scope.init = function () {
        $scope.loading = true;
        $http.get('/eon/lti/ngappstore').
        success(function (data, status, headers, config) {
            $scope.tools = data;
            $scope.loading = false;
        });
    };

    // $scope.clickEvent = function (obj) {
    //
    //     console.log(obj);
    //     alert(obj.target.attributes.data.value)
    //
    // };

    $scope.orderList = "title";
    $scope.catFilter = "";
    $scope.init();
});

notebooks.directive('appitem',function(){
    // Register to Dom During Copile Time
    return {

        restrict: 'C', // E = Element, A = Attribute, C = Class, M = Comment

        link: function($scope, iElm, iAttrs, controller) {
            console.log('Here is your element', iElm);
            // DO SOMETHING
        }
    };
});
