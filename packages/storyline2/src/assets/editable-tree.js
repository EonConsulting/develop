//add storyline_id: .../json-render/storyline_id
var tree_id = "#tree";

$( document ).ready(function(){

    refreshTree();

    //Delete Node Action
    $(tree_id).on("delete_node.jstree", function (e, data) {
        console.log(data.node.id);
        deleteNode(data.node.id);
    });

    //Rename Node Action
    $(tree_id).on("rename_node.jstree", function (e, data) {
        var ref = data.node;
        renameNode(ref);
    });

    //Move Node Action
    $(tree_id).on("move_node.jstree", function (e, data) {
        moveNode(data);
    });

    //Create Node Action
    $(tree_id).on("create_node.jstree", function (e, data) {
      createNode(data);
    });

    //Select Node Action
    $(tree_id).on("changed.jstree", function (e, data) {
        $("#item-id").val(data.node.id);

        $(".cat_check").prop('checked', false);
        $("#content-id").val("");
        $("#content-title").val("");
        $("#content-description").val("");
        $("#content-tags").val("");

        var body = editor.setData("");
        
        var ref = data.node;
        getContent(ref);

    });

})

function refreshTree(){
    $.getJSON(url,
        function (data) {
            console.log(data);
    
            drawTree(data);
    
            treeToJSON();
        }
    );
}
 
 
function drawTree(tree_data) {
    console.log(tree_data);

    $(tree_id).jstree({
        "core": {
            "animation": 0,
            "check_callback": true,
            "themes": {'name': 'proton', 'icons': false},
            "data": tree_data
        },
        "plugins": ["contextmenu", "dnd", "search", "state", "types", "wholerow"]
    });

}
 
 
 
 function treeToJSON(){
 
     var v =$(tree_id).jstree(true).get_json('#', { 'flat': true });
     console.log(v);
 
 }

//detect when node is clicked, ie. selected node changes

/*
$(tree_id).on("create_node.jstree", function (e, data) {
    console.log("Node created");
});

$(tree_id).on("rename_node.jstree", function (e, data) {
    console.log("Node renamed");
});

$(tree_id).on("delete_node.jstree", function (e, data) {
    console.log("Node deleted");
});

$(tree_id).on("move_node.jstree", function (e, data) {
    console.log("Node moved");
});

$(tree_id).on("cut.jstree", function (e, data) {
    console.log("Node cut");
});

$(tree_id).on("paste.jstree", function (e, data) {
    console.log("paste pasted");
});*/

function import_content($content_id,$item_id,$action){

    console.log("import_content called");

    actionUrl = base_url + "/storyline2/add-item-content/" + $content_id + "/" + $item_id + "/" + $action;

    $.ajax({
        method: "POST",
        url: actionUrl,
        contentType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (data) { //success
                $('#importModal').modal('hide');

                var id = data.id;

                console.log(id);
                
                getContent({"id": id});
            },
            400: function () { //bad request

            },
            500: function () { //server kakked

            }
        }
    }).error(function (req, status, error) {
        alert(error);
    });

}
 
function populateContentForm(data){

    console.log("populateContentForm called");

    var course_data = jQuery.parseJSON(data);

    if(course_data.found == true){

        $("#content-id").val(course_data.content.id);
        $("#content-title").val(course_data.content.title);
        $("#content-description").val(course_data.content.description);
        $("#content-tags").val(course_data.content.tags);
        var body = editor.setData(course_data.content.body);

        for (index = 0; index < course_data.categories.length; ++index) {
            cat_id = "#cat" + course_data.categories[index].id;
            console.log(cat_id);
            $(cat_id).prop('checked', true);
        }

    }

}

//Get Content
function getContent(data) {

    console.log("getContent called");

    var item_id = data['id'];
    console.log(item_id);
    actionUrl = base_url + "/storyline2/item-content/" + item_id;

    $.ajax({
        method: "GET",
        url: actionUrl,
        contentType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (data) { //success
                populateContentForm(data);
            },
            400: function () { //bad request

            },
            500: function () { //server kakked

            }
        }
    }).error(function (req, status, error) {
        alert(error);
    });



}

//Create Node
function createNode(data) {
    var node = $.extend(true, {}, data.node);
    var actionUrl = base_url + "/storyline2/create";

    $.ajax({
        method: "POST",
        url: actionUrl,
        data: JSON.stringify(node),
        contentType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (return_data) { //success
                if (return_data.msg === 'failed') {
                    alert('Create failed, please try again.');
                } else {
                    data.instance.set_id(node, return_data.id);
                    data.instance.edit(return_data.id); 
                }
            },
            400: function () { //bad request

            },
            500: function () { //server kakked

            }
        }
    }).error(function (req, status, error) {
        alert(error);
    });



}

//Delete Node
function deleteNode(data) {
    var actionUrl = base_url + "/storyline2/delete";

    $.ajax({
        method: "POST",
        url: actionUrl,
        data: JSON.stringify(data),
        contentType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (data) { //success
                if (data.msg === 'failed') {
                    alert('Rename failed, please try again.');
                } else {
                    refreshTree();
                }
            },
            400: function () { //bad request

            },
            500: function () { //server kakked

            }
        }
    }).error(function (req, status, error) {
        alert(error);
    });

}

//Move node
function moveNode(data) {
    var actionUrl = base_url + "/storyline2/move";

    $.ajax({
        method: "POST",
        url: actionUrl,
        data: JSON.stringify(data),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (data) { //success
                if (data.msg === 'failed') {
                    alert('Rename failed, please try again.');
                } else {
                    refreshTree();
                }
            },
            400: function () { //bad request

            },
            500: function () { //server kakked

            }
        }
    }).error(function (req, status, error) {
        alert(error);
    });

}

//Rename Node
function renameNode(data) {
    var actionUrl = base_url + "/storyline2/rename";


    $.ajax({
        method: "POST",
        url: actionUrl,
        data: JSON.stringify(data),
        contentType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (data) { //success
                if (data.msg === 'New node') {
                    alert('Rename failed, please try again.');
                } else {
                    refreshTree();
                }
            },
            400: function () { //bad request

            },
            500: function () { //server kakked

            }
        }
    }).error(function (req, status, error) {
        alert(error);
    });
}