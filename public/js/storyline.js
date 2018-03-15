/*
 * ---------------------------------------------------------------------
 * Global Variable Declarations
 * ---------------------------------------------------------------------
 *
 */

//settings
var debug = true;

var url = base_url + "/storyline2/show_items/" + storyline_id;
var saved = true;
var tree_id = "#tree";
//var current_node = "";
var content_id = "";
var selected_node = "";
const selector = '.resizer';
var previous_node = "";

//Search Variables
var current_result = -1;
var p_result = 0;
var search_results = null;
var search = false;

//Dialogue Insertion Point -->
var config = {
    extraPlugins: 'dialog',
    toolbar: [[ 'LTIButton' ]]
};


//validation
var valid = {
    "title_length": false,
    "title_unique": false,
    "description": false,
    "tags": false,
    "content": false,
    "categories": false
};

if(debug === true) {
    console.log("Variables set!")
}


/**
 * ---------------------------------------------------------------------
 * Init Functions
 * ---------------------------------------------------------------------
 */

let resizer = new Resizer(selector);

var editor = init_editor('ltieditorv2inst',css);




/**
 * ---------------------------------------------------------------
 * Public Functions
 * ---------------------------------------------------------------
 */

 //Tree functions-----------------------------------------------------------
function refreshTree() {

    $.ajax({
        method: "GET",
        url: url,
        contentType: 'json',
        statusCode: {
            200: function (data) { //success
                if(debug) {
                    console.log('Refresh tree success. Data:')
                    console.log(data);
                }
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

    $(tree_id).jstree({
        "core": {
            "animation": 0,
            "check_callback": true,
            "themes": {'name': 'proton', 'icons': false, 'responsive': true},
            "data": tree_data
        },
        "plugins": ["contextmenu", "dnd", "search", "state", "types", "wholerow"]
    });


    previous_node = tree_data[0]['id'];

    if(debug) {
        console.log("Draw tree called using tree data:");
        console.log(tree_data);
    } 


}

function treeToJSON() {

    var v = $(tree_id).jstree(true).get_json('#', {'flat': true});
    if(debug) {
        console.log("Tree converted to JSON. Output:");
        console.log(v);
    }

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
                if(debug) {
                    console.log("moveNode Called. Result:");
                    console.log(data.msg);
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

//Change selected node
function change_node(id){

    console.log("Changed node.");

    //id = data.selected[0];

    $("#item-id").val(id);

    $(".cat_check").prop('checked', false);
    $("#content-id").val("");
    $("#content-title").val("");
    $("#content-description").val("");
    $("#content-tags").val("");

    var body = editor.setData("");

    //var ref = data.id;

    for (var item in valid){
        item = false;
    }

    $("#content-title").popover("hide");
    $("#content-body").popover("hide");
    $("#content-description").popover("hide");
    $("#categories").popover("hide");
    $("#content-tags").popover("hide");
    
    getContent(id);

}


//Content functions--------------------------------------------------------------

function import_content($content_id,$item_id,$action){

    if(debug) console.log("import_content called");

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

                if(debug) {
                    console.log("Content imported. Content id: " + data.id);
                    //console.log(data.id);
                }

                getContent(id);
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

    if(debug) console.log("populateContentForm called");

    //var course_data = jQuery.parseJSON(data);

    if (data.found == true) {

        $("#content-id").val(data.content.id);
        $("#content-title").val(data.content.title);
        $("#content-description").val(data.content.description);
        $("#content-tags").val(data.content.tags);
        var body = editor.setData(data.content.body);

        for (index = 0; index < data.categories.length; ++index) {
            cat_id = "#cat" + data.categories[index].id;
            if(debug) console.log(cat_id);
            $(cat_id).prop('checked', true);
        }

        
    } else {
        $("#content-id").val('');
    }

    if(debug) console.log(data);

    getProgressTopics(data);
    
    saved = true;
    console.log("set saved: ");
    console.log(saved);
    check_save();

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

function getContent(id) {
    
    if(debug) console.log("getContent called");

    var item_id = id;
    if(debug) console.log(item_id);
    actionUrl = base_url + "/storyline2/item-content/" + item_id;
    show_pre_loader();
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
                hide_pre_loader();
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

function save_content_to_item(){

    $("#validation").hide();

    var data = get_content_details();
    var item_id = $("#item-id").attr('value');
    
    validate_all();

    if(validation() === true) {

        actionUrl = base_url + "/storyline2/save-item-content/" + item_id;

        $.ajax({
            method: "POST",
            url: actionUrl,
            contentType: 'json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            statusCode: {
                200: function (data) { //success

                    $("#content-id").val(data.id);
                    content_id = data.id;

                    saved = true;
                    check_save();

                    $('#saveModal').modal('hide');
                },
                400: function () { //bad request
    
                },
                500: function () { //server kakked
    
                }
            }
        }).error(function (req, status, error) {
            alert(error);
        });

    } else {
        
        var error = "There are problems with the content you are trying to save. Please fix them and try again.";
        $("#validation").html(error);
        $("#validation").show();

    }

}

//get content information from form
function get_content_details(){

    var body = editor.getData();

    var cats = $("#categories input:checkbox:checked").map(function(){
        return $(this).val();
    }).get();

    var data = {
        "title": $("#content-title").val(),
        "description": $("#content-description").val(),
        "body": body,
        "categories": cats,
        "tags": $("#content-tags").val(),
        "id": $("#content-id").val(),
        "topic": $("#selectNode option:selected").val()
    };

    var item_id = $("#item-id").val();

    return data;

}




//Window Resize Functions-------------------------------------------------------

function resizeArea(){
    var areaHeight = $("#content-area").height();
    var toolsHeight = $("#tools").height();
    $(".flex-container").height(areaHeight - toolsHeight - 11);
}

function resize(){
    var areaHeight = $("#content-area").height();
    var toolsHeight = $("#tools").height();
    var textEditHeight      = areaHeight - toolsHeight - $("#info-bar").height();
    var ckTopHeight         = $("#cke_1_top").height();
    var ckBottomHeight      = $("#cke_1_bottom").height();

    $("#cke_1_contents").height( (textEditHeight - ckTopHeight - ckBottomHeight - 21) + "px");
    $(".flex-container").height(areaHeight - toolsHeight - 11);
}




//Save functions---------------------------------------------------------------

function check_save(){
    if(saved === true){
        $("#save-status").html('All changes saved.');
    }else{
        $("#save-status").html('Changes not saved.');
    }
}




//Asset functions

function importAsset(asset){

    actionUrl = base_url + "/content/assets/" + asset;

    $.ajax({
        method: "GET",
        url: actionUrl,
        contentType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (data) { //success
                
                // we add the data-asset-id attribute <span> in here so we can identify mimetypes
                // for analytics and also know which asset we inserted here
                // we also have to construct the html string cause CKEditor is fucking stupid
                var html ='<div style="display: inline-block;" data-asset-id=' + asset + '>';
                
                if(data['content'] !== null){
                    html += data['content'];
                }

                html +=  data['html'];
                html += '</div>';
                
                CKEDITOR.instances['ltieditorv2inst'].insertHtml(html);
                
                $('#assetsModal').modal('hide');

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




//Form validation functions-----------------------------------------------------

function validate_all(save = false){
    validate_title_first(save);
}

function then_validate_others(save = false){
    validate_description();
    validate_categories();
    validate_body();
    validate_tags();

    if(save){
        save_content_to_item();
    }
}

//check title is at least 4 characters long and unique
function validate_title_first(save = false){

    var element = $("#content-title");
    var title = element.val();

    if(title.length < 4){

        if(debug) console.log("Title not long enough.")
        valid["title_length"] = false;
        show_error(element,"This title isn't long enough. Please enter a title that is at least 4 characters long.");

    } else {

        valid["title_length"] = true;

        var actionUrl = base_url + "/content/content-title-exists";

        $.ajax({
            method: "POST",
            url: actionUrl,
            contentType: 'json',
            data: JSON.stringify({"title": title}),
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            statusCode: {
                200: function (data) { //success

                    if(data.id === content_id){
                        valid["title_unique"] = true;
                        if(debug) console.log("name doesn't exist");
                        element.popover("hide");
                    }else{
                        valid["title_unique"] = false;
                        if(debug) console.log("Title not unique.");
                        show_error(element,"This title already exists. Please enter a unique title.");
                    }

                    then_validate_others(save);

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
    
}

//check that at least one category has been chosen
function validate_categories(){

    var element = $('#categories');
    var cats = $("#categories input:checkbox:checked").map(function(){
        return $(this).val();
    }).get();

    if(cats.length < 1){
        valid["categories"] = false;
        show_error(element,"Please select at least one category.");
    } else {
        valid["categories"] = true;
        element.popover("hide");
    }

}

//check if body is the same as any other
function validate_body(){

    var element = $('#ltieditorv2inst');
    var body = editor.getData();

    if(body.length < 4){
        valid["content"] = false;
        show_error(element,"You have not added enough content. You need to add at least 4 characters.");
    } else {
        valid["content"] = true;
        element.popover("hide");
    }

}

//check if description is longer than 4 characters
function validate_description(){

    var element = $("#content-description");
    var description = element.val()

    if(description.length < 4){
        valid["description"] = false;
        show_error(element,"You have not added enough content. You need to add at least 4 characters.");
    } else {
        valid["description"] = true;
        element.popover("hide");
    }

}

//check if tags has been filled in
function validate_tags(){

    var element = $("#content-tags");
    var tags = element.val()

    if(tags.length < 4){
        valid["tags"] = false;
        show_error(element,"You have not added enough content. You need to add at least 4 characters.");
    } else {
        valid["tags"] = true;
        element.popover("hide");
    }

}

function check_for_id(){
    var id = $("#content-id").val();
    return id;
}

function validation(){

    for(var item in valid){
        if(item === false){
            return false;
        }
    }

    return true;

}




//Search functions-------------------------------------------

function highlightSearch() {

    var text = document.getElementById("q").value;
    var query = new RegExp("(\\b" + text + "\\b)", "gim");
    var e = document.getElementById("searchtext").innerHTML;
    var enew = e.replace(/(<span>|<\/span>)/igm, "");
    document.getElementById("searchtext").innerHTML = enew;
    var newe = enew.replace(query, "<span>$1</span>");
    document.getElementById("searchtext").innerHTML = newe;

}

function next_result() {
    current_result++;
    $(tree_id).jstree("deselect_all");
    $(tree_id).jstree('select_node', search_results[current_result]['item_id']);
    update_search_numbers();
    check_search_buttons();
}

function prev_result(){
    current_result--;
    $(tree_id).jstree("deselect_all");
    $(tree_id).jstree('select_node', search_results[current_result]['item_id']);
    update_search_numbers();
    check_search_buttons();
}

function update_search_numbers(){
    var current = current_result+1;
    var total = search_results.length;
    $('#search_numbers').html(current + ' / ' + total);
}

function check_search_buttons(){
    if(current_result === (search_results.length-1)){
        $('#next-result').addClass('disabled');
    }else{
        $('#next-result').removeClass('disabled');
    }

    if(current_result === 0){
        $('#prev-result').addClass('disabled');
    }else{
        $('#prev-result').removeClass('disabled');
    }
}

function search_storyline(term){
    current_result = -1;
    console.log(term);

    var actionUrl = base_url + "/storyline2/search-content";

    var data = {
        'from': 0,
        'size': 500,
        'term': term,
        'course': course_id
    };

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
                console.log(data);
                search_results = data['results'];
                next_result();
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


//Common functions-------------------------------------------

//pop up error
function show_error(element,message){
    element.attr('data-content', message);
    element.popover("show");
}


/**
 * ---------------------------------------------------------------------
 * Event Functions
 * ---------------------------------------------------------------------
 */


$(document).ready(function () {
    refreshTree();
    check_save();
    $("#validation").hide();
});

$(window).on("beforeunload", function(evt) {
    if(!saved){
        return true;
    }
});

$(window).resize(function(){
    resize();
});

$(document).on("click", "#btnsbmit", function(){
    save_content_to_item();
});

$(document).on("click", ".content-action", function(){
    $content_id = $(this).data("content-id");
    $item_id = $("#item-id").attr('value');
    $action = $(this).data("action");
    import_content($content_id,$item_id,$action);
});

$(document).on("click", ".import-asset", function () {
    $asset_id = $(this).data("asset-id");
    importAsset($asset_id);
});
/*
$(document).on("keyup", '#q', function () {
    $("#tree").jstree("open_all");
    var that = this, $allListElements = $('ul.jstree-children > li');
    var $matchingListElements = $allListElements.filter(function (i, li) {
        var listItemText = $(li).text().toUpperCase(), searchText = that.value.toUpperCase();
        return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
    //$matchingListElements.addClass('highlighted');
});
*/

$(document).on("click", '#search', function () {

    var term = $('#q').val();

    if(term.length > 3){
        search_storyline(term);
    }
    
});


$(document).on('click','.white-b',function(){
    $("#whiteModal").modal();
});

$(document).on('click','.p-check',function(){
    var data =  CKEDITOR.instances['ltieditorv2inst'].document.getBody().getText();
    $("#msgModal").modal();

    if(data.length > 1){               
        var url = copyleak_url;
        $.ajax({
            url:url,
            type: "POST",
            data: {data: data, _token: csrf_token},
            beforeSend: function () {
                $('.msg-info').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Scanning content....</button>");
            },
            success: function (result) {
                if (result.msg == 'true') {
                    $('.msg-info').html(result.success);
                } else {
                    $('.msg-info').html('You have run out of credits, please update your credit plan.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
                //ocation.reload();
            }
        });
    }else{
        $('.msg-info').html('No content found, please add content.');
    }
});


//Editor events---------------------------------------------
editor.on('instanceReady', function(){

    var body = editor.document.getBody();
    body.setAttribute( 'class', 'content-body');

    resize();

    //editor.document.appendStyleText(css);
/*
    doc = editor.dom.document();
    doc.appendStyleText(css);*/
});

editor.on('dataReady', function(){
    var body = editor.document.getBody();
    body.setAttribute( 'class', 'content-body');
    editor.document.appendStyleText(css);
});

editor.on('key', function() {
    saved = false;
    check_save();
});




//Tree Events-------------------------------------------------
$(tree_id).on("ready.jstree", function(e, data) {

    if(debug) console.log("tree ready");
    var tree = data.instance;
    var obj = tree.get_selected(true)[0];

    // trigger the on_select handler for the tree node that is currently selected and ensure that it is opened
    if (obj) {
        if (obj.state.opened) {
            tree.trigger('select_node', { 'node' : obj, 'selected' : tree._data.core.selected, 'event' : e });
        } else {
            tree.open_node(obj, function() {
                tree.trigger('select_node', { 'node' : obj, 'selected' : tree._data.core.selected, 'event' : e });
            });
        }
    }
});

//Delete Node Action
$(tree_id).on("delete_node.jstree", function (e, data) {
    if(debug) console.log(data.node.id);
    deleteNode(data.node.id);
});

//Rename Node Action
$(tree_id).on("rename_node.jstree", function (e, data) {
    var ref = data.node;
    renameNode(ref);
});

//Move Node Action
$(tree_id).on("move_node.jstree", function (e, data) {
    if(debug) console.log(data);
    var ref = {
        node: data.node,
        position: data.position,
        old_position: data.old_position
    };
    if(debug) console.log(ref);
    moveNode(ref);
});

//Create Node Action
$(tree_id).on("create_node.jstree", function (e, data) {
    var ref =  data.node;
    createNode(ref);
});



//Select Node Action
$(tree_id).on("select_node.jstree", function (e, data) {

    if(debug) console.log(data);
    
    current_node = data['selected'][0];
 
    if(debug) console.log(current_node);

    if(!saved){
        if(previous_node !== selected_node){
            //$('#tree').jstree(true).select_node(selected_node);
            $("#tree").jstree("select_node", "#"+selected_node);
            $("#tree").jstree("deselect_node", "#"+current_node);
            var previous_node = selected_node;
            //alert('previous'+previous_node);
            $('#unsavedModal').modal('show');
        }
    }else{
        change_node(current_node);
    }

});

$(document).on("click", "#discard_changes", function(){
    $('#unsavedModal').modal('hide');
    change_node(current_node);
});


//Input Events-------------------------------------------------

$(document).on('keyup', '#content-title', function(){
    saved = false;
    check_save();
    //validate_title();
});

$(document).on('keyup', "#content-description", function(){
    validate_description();
    saved = false;
    check_save();
});

CKEDITOR.instances.ltieditorv2inst.on('key', function(e) {
    var n = $(tree_id).jstree("get_selected");
    selected_node = $('#'+n).attr("id");
    validate_content();
    saved = false;
    check_save();
});

$(document).on('keyup', "#ltieditorv2inst", function(){
    validate_content();
    saved = false;
    check_save();
});

$(document).on('keyup', "#categories input:checkbox", function(){
    validate_categories();
    saved = false;
    check_save();
});

$(document).on('keyup', "#content-tags", function(){
    validate_tags();
    saved = false;
    check_save();
});

$(document).on('click', '#next-result', function(){
    next_result();
});

$(document).on('click', '#prev-result', function(){
    prev_result();
});
