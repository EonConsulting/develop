
//console.log(url);

$.getJSON(url,
        function (data) {
            console.log(data);

            renderTree(data);

            treeToJSON();
        }
);

function renderTree(tree_data) {
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

function treeToJSON() {
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

$events.each(function (item) {
    $(tree_id).on(item, function (e, data) {
        treeToJSON();

    });
});

function saveHiearchy(node_id, parent_id) {
    var actionUrl = "/Home/SaveHiearchy?childId=" + node_id + "&parentId=" + parent_id;
    $.ajax(
            {
                type: "POST",
                url: actionUrl,
                data: null,
                dataType: "json",
                success: function (data) {

                },
                error: function (req, status, error) {

                }
            });
}

function createNode(NODE, parentId) {
    var folderName = $(NODE.innerHTML).filter("a")[0].innerText;
    var actionUrl = "/Home/CreateFolder?folderName=" + folderName + "&parentId=" + parentId;
    $.ajax(
            {
                type: "POST",
                url: actionUrl,
                data: null,
                dataType: "json",
                success: function (data) {
                    createdNodeId = data.nodeId;
                },
                error: function (req, status, error) {
                }
            });
}

function renameNode(nodeId, nodeNewTitle) {
    if ($.trim(nodeId) == "")
        nodeId = createdNodeId;
    var actionUrl = "/Home/RenameNode?nodeId=" + nodeId + "&nodeNewTitle=" + nodeNewTitle;
    $.ajax({
                type: "POST",
                url: actionUrl,
                data: null,
                dataType: "json",
                success: function (data) {
                },
                error: function (req, status, error) {
                }
            });

}

function deleteSubNode(nodeId) {
    var actionUrl = "/Home/DeleteSubNode?folderId=" + nodeId;
    $.ajax({
                type: "POST",
                url: actionUrl,
                data: null,
                dataType: "json",
                success: function (data) {
                },
                error: function (req, status, error) {
                }
            });
}
