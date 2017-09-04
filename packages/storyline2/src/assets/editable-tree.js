
//console.log(url);

$.getJSON(url,
    function(data) {
        console.log(data);

        renderTree(data);

        treeToJSON();
    }
);

function renderTree(tree_data) {
    console.log(tree_data);

    $(tree_id).jstree({
        "core" : {
            "animation" : 0,
            "check_callback" : true,
            "themes" : { 'name': 'proton', 'icons': false },
            "data" : tree_data
        },
        "plugins" : ["contextmenu","dnd","search","state","types","wholerow"]
    });

}

function treeToJSON(){

    var v = $('#tree').jstree(true).get_json();
    console.log(v);

}


//detect when node is clicked, ie. selected node changes
$(tree_id).on("changed.jstree", function (e, data) {

    console.log("Node selected");

});


//detect changes in the tree structure
$events = [

    "create_node.jstree",
    "rename_node.jstree",
    "delete_node.jstree",
    "move_node.jstree",
    "cut.jstree",
    "paste.jstree"

];

$events.each(function(item){
    $(tree_id).on(item, function (e, data) {
        treeToJSON();
    });
});
