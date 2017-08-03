(function () {
    'use strict';

    angular.module("demoApp")
        .controller('StorylineCtrl', ['$sce','$scope', '$http', '$routeParams', function ($sce,$scope, $http, $routeParams) {
            $scope.course_id = course_id;

            $scope.remove = function (scope) {
                scope.remove();
            };

            $scope.toggle = function (scope) {
                scope.toggle();
            };
            
			$scope.showModal = function(storylineItem){
                $('input[name="storyline_id"]').val(storylineItem.id);
                $('#myCont').modal();


            };

            $scope.defaultData = [{
                name: '',
                file_url: '',
                file_name: '',
                children:[]
            }];


            //
            // $scope.clicked = function(storylineItem){
            //     alert(JSON.stringify(storylineItem));
            // }

            $scope.saveStoryline = function(){
                // var url = "/lecturer/courses/" + $scope.course_id + "/storyline";
                var url = "/lecturer/courses/" + $scope.course_id + "/storyline";
                $http.post(url, {parts: angular.toJson($scope.storylineItems)})
                    .then(function (response) {
                        $scope.html = '<p class="alert alert-success" style="margin-top:5px;">' +
                            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                            '<strong>Success:</strong>&nbsp;The Storyline has been Saved !</p>';
                        $scope.responsetext = $sce.trustAsHtml($scope.html);
                    }, function (response) {
                        //Second function handles error
                    });
            }

            $scope.getPeople = function(){
                $scope.isLoading = true;
                // $http.get("/lecturer/courses/" + $scope.course_id + "/storyline/feed")
                $http.get("/lecturer/courses/" + $scope.course_id + "/storyline/feed")
                    .then(function (response) {
                        //First function handles success
                        var dbItems = response.data;
                        var parents = $scope.getChildren(dbItems, null);
                        var data =  $scope.populateMenu(parents, dbItems);
                        if(data == null){
                            data = $scope.defaultData
                        }
                        $scope.storylineItems = data;
                        $scope.isLoading = false;
                    }, function (response) {
                        //Second function handles error
                        $scope.err = response.data;
                        $scope.storylineItems = $scope.defaultData;
                        $scope.isLoading = false;
                    });
            }
            $scope.getPeople();



            $scope.getChildren = function(records, parentMenuId){
                var data = $scope.getMenuItems(records);
                var items = [];
                angular.forEach(data, function(item){
                    if(item.parent_id == parentMenuId){
                        items.push(item);
                    }
                })
                return items;
            }



            $scope.getMenuItems = function(dbItems)
            {
                var records = [];
                for(var index = 0; index < dbItems.length; index++){
                    var item =
                    {
                        id : dbItems[index].id,
                        name: dbItems[index].name,
                        parent_id: dbItems[index].parent_id,
                        file_url: dbItems[index].file_url,
                        file_name: dbItems[index].file_name
                    }
                    records.push(item);
                }
                return records;
            }




            $scope.populateMenu = function(parents, dbItems){
                var collection = [];
                var data = $scope.getMenuItems(dbItems);
                angular.forEach(parents, function(item){
                    var children = $scope.getChildren(data, item.id);

                    var menuItem =
                    {
                        id : item.id,
                        name: item.name,
                        parent_id: item.parent_id,
                        file_url: item.file_url,
                        file_name: item.file_name,
                        children: []
                    };
                    menuItem.children = $scope.populateMenu(children, data);

                    collection.push(menuItem);
                });
                return collection;
            };



            $scope.moveLastToTheBeginning = function () {
                var a = $scope.data.pop();
                $scope.data.splice(0, 0, a);
            };



            $scope.newSubItem = function (element) {
                var nodeData = element.$modelValue;
                nodeData.children.push({
                    //id: nodeData.id,
                    name: nodeData.name + '.' + (nodeData.children.length + 1),
                    file_url:  nodeData.file_url,
                    file_name:  nodeData.file_name,
                    children: []
                });
            };

            $scope.collapseAll = function () {
                $scope.$broadcast('angular-ui-tree:collapse-all');
            };

            $scope.expandAll = function () {
                $scope.$broadcast('angular-ui-tree:expand-all');
            };




            $scope.openPopup = function (storylineItem) {
                CKFinder.popup( {
                    chooseFiles: true,
                    onInit: function( finder ) {
                        finder.on( 'files:choose', function( evt ) {
                            var file = evt.data.files.first();
                            storylineItem.file_url = angular.copy(file.getUrl());
                            storylineItem.file_name = angular.copy(file.get('name'));
                            //alert(JSON.stringify($scope.storylineItems[index]));
                            // document.getElementById('file_url2' ).value = textel;
                            // console.log(textel);
                            $("#btnExpandAll").click();
                        } );
                    }
                } );
            }

            //$scope.storylineItems = [{
            //  'id': 1,
            //  'name': 'node1',
            //  'nodes': [
            //    {
            //      'id': 11,
            //      'name': 'node1.1',
            //      'nodes': [
            //        {
            //            'id': 111,
            //            'name': 'node1.1.1',
            //            'nodes': []
            //        },
            //        {
            //            'id': 112,
            //            'name': 'node1.1.2',
            //            'nodes': []
            //        }
            //      ]
            //    },
            //    {
            //      'id': 12,
            //      'name': 'node1.2',
            //      'nodes': []
            //    }
            //  ]
            //}, {
            //  'id': 2,
            //  'name': 'node2',
            //  'nodrop': true, // An arbitrary property to check in custom template for nodrop-enabled
            //  'nodes': [
            //    {
            //      'id': 21,
            //      'name': 'node2.1',
            //      'nodes': []
            //    },
            //    {
            //      'id': 22,
            //      'name': 'node2.2',
            //      'nodes': []
            //    }
            //  ]
            //}, {
            //  'id': 3,
            //  'name': 'node3',
            //  'nodes': [
            //    {
            //      'id': 31,
            //      'name': 'node3.1',
            //      'nodes': []
            //    }
            //  ]
            //}];





        }]);

}());