
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

    var v =$(tree_id).jstree(true).get_json('#', { 'flat': true });
    console.log(v);

}


//detect when node is clicked, ie. selected node changes
$(tree_id).on("changed.jstree", function (e, data) {
    console.log("Node selected");
});


//detect changes in the tree structure
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
});
