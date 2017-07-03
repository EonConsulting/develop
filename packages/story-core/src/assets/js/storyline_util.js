function Open_File(folder,XML_Asset_Number) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET",folder + XML_Asset_Number + ".xml", false);
    xmlhttp.send();
    var xmlDoc = xmlhttp.responseXML;
    console.log(xmlhttp);
    var Root = xmlDoc.documentElement
    return Root;

}

function Build_Storyline(folder, XML_Asset_Number, Base_Level, IsRoot, current_level) {
   
    /*open root file*/
    var StoryLine_Root = Open_File(folder, XML_Asset_Number);

    /*display Root*/
    if (IsRoot == true) {
		    current_level ++;
        Display_Storyline_Root_Start(StoryLine_Root, XML_Asset_Number, current_level);
        }
    else {
        Display_Storyline_Branch_Start(StoryLine_Root, XML_Asset_Number, current_level);
				current_level ++;
        }

    /*get Storyline_Collection*/
    var Storyline_Collection = StoryLine_Root.getElementsByTagName("storyline_collection")[0];
    var Children = Storyline_Collection.childNodes;

    /*Loop through Storyline_Collection children*/
    var i = 0;
    for (i = 0; i < Children.length; i++) {
        var Child = Children[i]

        /*Check if child is a valid element*/
        if (Child.nodeType == 1) {

                    /*Check if child has nested storylines*/
                    var ChildType = get_Attribute(Child, 'type')

                    if (ChildType == 'branch') {

                        config = get_Attribute(Child, 'config');

                        /*If child has nested storylines, then recurse*/
                        if (!Base_Level) {
                           Build_Storyline(folder ,config,  Base_Level, false, current_level);
                        }
                       else {

                           Display_Storyline_Branch(Child, config, current_level);
                        }
                    }

                   if (ChildType == 'leaf') {
                        Display_Storyline_Leaf(Child, XML_Asset_Number, current_level);
                     }
        }
            }
            /*display Root*/
            if (IsRoot == true) {
                Display_Storyline_Root_End(StoryLine_Root, XML_Asset_Number, current_level);
            }
            else {
                Display_Storyline_Branch_End(StoryLine_Root, XML_Asset_Number, current_level);
            }

}

function get_Attribute(n, Attribute) {
   y = n.getAttributeNode(Attribute);
   txt = y.nodeValue;
   return String(txt);
}

/*
//NOTICE - link could appear more than once
function getNextNode(link, XML_root) {
  //find matching node based on link attr.
	//return next node
	nodes = XML_root->xpath('//storyline[@link="' . link . '"]');
	nextNode = nodes[0]->xpath('following-sibling::storyline[1]');
	return(nextNode);
}

function getPrevNode(link, XML_root) {
  //find matching node based on link attr.
	//return prev node
	nodes = XML_root->xpath('//storyline[@link="' . link . '"]');
	prevNode = nodes[0]->xpath('preceding-sibling::storyline[1]');
	return(prevNode);
}
*/
