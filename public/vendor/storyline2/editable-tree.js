var url = base_url + "/storyline2/show_items/55"; //add storyline_id: .../json-render/storyline_id
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
        console.log(data);
        var ref = data.node;
        moveNode(ref);
    });

    //Create Node Action
    $(tree_id).on("create_node.jstree", function (e, data) {
        createNode(data);
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

    var v =$(tree_id).jstree(true).get_json('#', { /*'flat': true*/ });
    console.log(v);

}

//detect when node is clicked, ie. selected node changes
/*$(tree_id).on("changed.jstree", function (e, data) {
    console.log("Node selected");
});

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