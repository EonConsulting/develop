
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

    $("#tree").jstree({
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
    //var mytext = JSON.stringify(v);
    console.log(v);

}

$events = [
    "create_node.jstree",
    "rename_node.jstree",
    "delete_node.jstree",
    "move_node.jstree",
    "cut.jstree",
    "paste.jstree"
];

/*$('#tree').on("changed.jstree", function (e, data) {
    treeToJSON();
});*/

/*$(".menu_collapse").each(function( index ) {
    $(this).addClass("hidden", 1000);
});*/

$events.each(function(item){
    $('#tree').on(item, function (e, data) {
        treeToJSON();
    });
});
