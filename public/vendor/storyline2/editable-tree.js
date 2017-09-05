
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

    var v = $(tree_id).jstree(true).get_json();

    //TODO: Save to DB using ajax
    console.log(v);

}

//list of events to save after
var events = [
    "create_node.jstree",
    "rename_node.jstree",
    "delete_node.jstree",
    "move_node.jstree",
    "cut.jstree",
    "paste.jstree"
];

$.each(events, function(key, value){
    $(tree_id).on(value, function (e, data) {
        treeToJSON();
    });
});
