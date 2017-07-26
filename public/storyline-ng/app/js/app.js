(function () {
  'use strict';

  angular.module('demoApp', ['ui.tree', 'ngRoute', 'ui.bootstrap'])

    .config(['$routeProvider', '$compileProvider', function ($routeProvider, $compileProvider) {
      $routeProvider
        .when('/story-line', {
            controller: 'StorylineCtrl',
<<<<<<< HEAD
          templateUrl: '/develop/public/storyline-ng/views/story-line.html'
=======
          templateUrl: '/storyline-ng/views/story-line.html'
>>>>>>> origin/master
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
            redirectTo: '/story-line'
        });

      // testing issue #521
      $compileProvider.debugInfoEnabled(false);
    }]);
})();
