//add storyline_id: .../json-render/storyline_id
var tree_id = "#tree";

$(document).ready(function () {

    refreshTree();

})

function refreshTree() {

    $.ajax({
        method: "GET",
        url: url,
        contentType: 'json',
        statusCode: {
            200: function (data) { //success
                console.log(data);
                drawTree(data);
                //treeToJSON();
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


function drawTree(tree_data) {
    //console.log(tree_data);

    $(tree_id).jstree({
        "core": {
            "animation": 0,
            "check_callback": true,
            "themes": {'name': 'proton', 'icons': false, 'responsive': true},
            "data": tree_data
        },
        "plugins": ["contextmenu", "dnd", "search", "state", "types", "wholerow"]
    });

}


function treeToJSON() {

    var v = $(tree_id).jstree(true).get_json('#', {'flat': true});
    console.log(v);

}


function import_content($content_id, $item_id, $action) {

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

function populateContentForm(data) {
    console.log("populateContentForm called");
    //var course_data = jQuery.parseJSON(data);
    if (data.found == true) {
        $("#content-id").val(data.content.id);
        $("#content-title").val(data.content.title);
        $("#content-description").val(data.content.description);
        $("#content-tags").val(data.content.tags);
        var body = editor.setData(data.content.body);
        for (index = 0; index < data.categories.length; ++index) {
            cat_id = "#cat" + data.categories[index].id;
            console.log(cat_id);
            $(cat_id).prop('checked', true);
        }
    }
    //Get student progress topics dropdown
    getProgressTopics(data);

}

function getProgressTopics(data) {
    if(data.req){
       var option = "<option value="+data.req.id+">"+data.req.name+"</option><option value=''>--Choose One--</option>";
       }else{
          option =  "<option value=''>--Choose One--</option>";
       }
    document.getElementById("selectNode").innerHTML = option;
    var dropdown = document.getElementById("selectNode");
    var myArray = data.topics;
    // Loop through the array
    for (var i = 0; i < myArray.length; ++i) {
        // Append the element to the end of Array list
        if (myArray[i].id == data.item) {
            break;
        }
        if (i == 0) { 
            myArray.splice(i, 1);
        }
        dropdown[dropdown.length] = new Option(myArray[i].text, myArray[i].id);
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
    //var node = $.extend(true, {}, data);
    var actionUrl = base_url + "/storyline2/create";

    $.ajax({
        method: "POST",
        url: actionUrl,
        data: JSON.stringify(data),
        contentType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (return_data) { //success
                if (return_data.msg === 'failed') {
                    alert('Create failed, please try again.');
                } else {

                    $(tree_id).jstree(true).set_id(data, return_data.id);
                    $(tree_id).jstree(true).edit(return_data.id);
                    //data.instance.set_id(node, return_data.id);
                    //data.instance.edit(return_data.id);
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
    //seen = [];
    var node = data;

    $.ajax({
        method: "POST",
        url: actionUrl,
        data: JSON.stringify(node),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (data) { //success
                console.log(data.msg);
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