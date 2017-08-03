(function () {
  'use strict';

  angular.module('demoApp', ['ui.tree', 'ngRoute', 'ui.bootstrap'])

    .config(['$routeProvider', '$compileProvider', function ($routeProvider, $compileProvider) {
      $routeProvider
        .when('/e-content/story-line', {
            controller: 'StorylineCtrl',
          templateUrl: '/e-content/storyline-ng/views/story-line.html'
        })
        //.when('/cloning', {
        //  controller: 'CloningCtrl',
        //  templateUrl: '/views/cloning.html'
        //})
        //.when('/connected-trees', {
        //  controller: 'ConnectedTreesCtrl',
        //  templateUrl: '/views/connected-trees.html'
        //})
        //.when('/filter-nodes', {
        //  controller: 'FilterNodesCtrl',
        //  templateUrl: '/views/filter-nodes.html'
        //})
        //.when('/nodrop', {
        //  controller: 'BasicExampleCtrl',
        //  templateUrl: '/views/nodrop.html'
        //})
        //.when('/table-example', {
        //  controller: 'TableExampleCtrl',
        //  templateUrl: '/views/table-example.html'
        //})
        //.when('/drop-confirmation', {
        //  controller: 'DropConfirmationCtrl',
        //  templateUrl: '/views/drop-confirmation.html'
        //})
        //.when('/expand-on-hover', {
        //  controller: 'ExpandOnHoverCtrl',
        //  templateUrl: '/views/expand-on-hover.html'
        //})
        .otherwise({
            redirectTo: '/e-content/story-line'
        });

      // testing issue #521
      $compileProvider.debugInfoEnabled(false);
    }]);
})();
