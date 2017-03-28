<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 8:50 AM
 */

namespace EONConsulting\Graphs;


/**
 * Class InteractiveGraphs
 * @package EONConsulting\InteractiveGraphs
 */
class Graphs {

    /**
     * @return mixed
     */
  

    public function drawgraph($this, $code, $divreplace) {



if ($this.hasClass("clicked-once")) {
    // already been clicked once, refresh the page
  //  var code = document.getElementById("textareaCode").value;
   location.reload();
    console.log(code);

}
 else {
    // first time this is clicked, mark it
    $this.addClass("clicked-once");
               
             //   var code = document.getElementById("textareaCode").value;
                $("#preview2").replaceWith(code);

                // var text = document.createElement('div');
                // text.setAttribute('class', 'textareaCode');
                // text.setAttribute('id', 'box2');
                // text.setAttribute('style', 'width:660px; height:660px; float:right;');
             
                // $("#preview1").append(text);

            //    var divreplace = "<div id='box2' class='textareaCode' style=' border: groove;'> ";
                $("#preview1").replaceWith(divreplace);

}





     
    }

        public function fixed() {
                  return TestStencilController::fixed();
        //      return view('ph::lecturer');
    }
        public function interactive () {            
             return TestStencilController::interactive();
        //      return view('ph::lecturer');
    }
}
