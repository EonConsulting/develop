<?php
error_reporting(0);
ini_set('display_errors', 'On');

function Open_File($folder, $XML_Asset_Number) {
    libxml_disable_entity_loader(false);
    libxml_use_internal_errors(true);
    $root = simplexml_load_file($folder . $XML_Asset_Number . ".xml");
    if ($root === false) {
        echo "Failed loading XML\n";
        foreach(libxml_get_errors() as $error) {
            echo "\t", $error->message;
        }
    }
    return($root);
}

function Build_Storyline($folder, $XML_Asset_Number, $Base_Level, $IsRoot, $current_level) {

    /*open root file*/
    $StoryLine_Root = Open_File($folder, $XML_Asset_Number);

    /*display Root*/
    if ($IsRoot == true) {
        $current_level = $current_level+1;
        Display_Storyline_Root_Start($StoryLine_Root, $XML_Asset_Number, $current_level);
    }
    else {
        Display_Storyline_Branch_Start($StoryLine_Root, $XML_Asset_Number, $current_level);
        $current_level = $current_level+1;
    }

    /*get Storyline_Collection*/
    $Storyline_Collection = $StoryLine_Root->storyline_collection[0];

    /*Loop through Storyline_Collection children*/
    foreach($Storyline_Collection->children() as $child) {

        /*Check if child has nested storylines*/
        $ChildType = get_Attribute($child, 'type');

        if ($ChildType == 'branch') {

            /*If child has nested storylines, then recurse*/
            $config = get_Attribute($child, 'config');

            if (!$Base_Level) {
                Build_Storyline($folder ,$config,  $Base_Level, false, $current_level);
            }
            else {
                Display_Storyline_Branch($child, $config, $current_level);
            }
        }

        if ($ChildType == 'leaf') {
            Display_Storyline_Leaf($child, $XML_Asset_Number, $current_level);
        }
    }

    /*display Root*/
    if ($IsRoot == true) {
        Display_Storyline_Root_End($StoryLine_Root, $XML_Asset_Number, $current_level);
    }
    else {
        Display_Storyline_Branch_End($StoryLine_Root, $XML_Asset_Number, $current_level);
    }
}

function get_Attribute($n, $Attribute) {
    //echo $n;
    return ($n->attributes()->$Attribute);
}


//NOTICE - link could appear more than once
function getNextNode($link, $XML_root) {
    //find matching node based on link attr.
    //return next node

    $nodes = $XML_root->xpath('//storyline[@link="' . $link . '"]');
    $nextNode = $nodes[0]->xpath('following-sibling::storyline[1]');
    return($nextNode);
}

function getPrevNode($link, $XML_root) {
    //find matching node based on link attr.
    //return prev node
    $nodes = $XML_root->xpath('//storyline[@link="' . $link . '"]');
    $prevNode = $nodes[0]->xpath('preceding-sibling::storyline[1]');
    return($prevNode);
}
