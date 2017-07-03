$(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
    $(".button-collapse").sideNav();
    //$('.activity-links').pushpin({ top: $('.activity-links').offset().top });
    //$('.popout').pushpin({ top: $('.popout').offset().top });

    $('.row.subtopic-cards .s4').hover(function() {
    	$(this).find('.card-description').stop(true, true).fadeToggle(800);
    });
    $('.row.subtopic-cards .s3').hover(function() {
        $(this).find('.card-description').stop(true, true).fadeToggle(800);
    });

    $('.show-more').click(function() {
    	$(this).siblings('ul.hidden-list').stop().slideToggle();
    	$(this).text(function(i, text){
			return text === "Show more..." ? "Show less..." : "Show more...";
		})
    });

    $('.child-menu .collapsible-header').click(function() {
    	$(this).find('i').text(function(i, text){
			return text === "keyboard_arrow_right" ? "keyboard_arrow_down" : "keyboard_arrow_right";
		})
    });

    $('.icon-link').click(function() {
        var div = $(this).attr('href');
        $('html,body').animate({
           scrollTop: $(div).offset().top
        });
    });

    /** Graph change function **/
    $('a').click(function() {
        if ($(this).attr('graph') !== undefined) {
            // attribute is present
            var graph = $(this).attr('graph');
            var source = $(this).attr('src');
            $('.'+graph).attr('src',source);
        } else {
            // does not exist
        }
    });
    /** Graph slider function **/
   /* var oldValue = 0;
    $("input.affect").on("input change", function() {
        if (this.value > oldValue) {
            // Show decresing graph for each respective step
            if (this.value == 1) { $(this).parent('.asset').find('.range-affect img').attr('src','630.svg'); }
            if (this.value == 2) { $(this).parent('.asset').find('.range-affect img').attr('src','631.svg'); }
            if (this.value == 3) { $(this).parent('.asset').find('.range-affect img').attr('src','632.svg'); }
            if (this.value == 4) { $(this).parent('.asset').find('.range-affect img').attr('src','633.svg'); }
            if (this.value == 5) { $(this).parent('.asset').find('.range-affect img').attr('src','634.svg'); }
            if (this.value == 6) { $(this).parent('.asset').find('.range-affect img').attr('src','635.svg'); }

            //$(this).parent('.asset').find('.range-affect img').attr('src','../img/graphs/[UECA-234][2]PPC21.svg');
        } else if (oldValue > this.value) {
            // Show increasing graph for each respective step
            if (this.value == 1) { $(this).parent('.asset').find('.range-affect img').attr('src','630.svg'); }
            if (this.value == 2) { $(this).parent('.asset').find('.range-affect img').attr('src','631.svg'); }
            if (this.value == 3) { $(this).parent('.asset').find('.range-affect img').attr('src','632.svg'); }
            if (this.value == 4) { $(this).parent('.asset').find('.range-affect img').attr('src','633.svg'); }
            if (this.value == 5) { $(this).parent('.asset').find('.range-affect img').attr('src','634.svg'); }
            if (this.value == 6) { $(this).parent('.asset').find('.range-affect img').attr('src','635.svg'); }

            //$(this).parent('.asset').find('.range-affect img').attr('src','../img/graphs/[UECA-233][2]PPC20.svg');
        }
        console.log(oldValue + ' vs ' + this.value); ;
        oldValue = this.value;
    });

    $(".balance input").on("input change", function() {
        var min = $(this).attr('min');
        var max = $(this).attr('max');

        var laptop = 4000 - ($(this).val() * 10);
        var laptopZoom = 100 - ($(this).val() * 0.5);
        $(this).parent('.balance').find('.laptop .balance-value').text(laptop);
        $(this).parent('.balance').find('.laptop img').css('zoom', laptopZoom + '%')

        var phone = 10000 + ($(this).val() * 80);
        var phoneZoom = ($(this).val() / 2) + 50;
        $(this).parent('.balance').find('.phone .balance-value').text(phone);
        $(this).parent('.balance').find('.phone img').css('zoom', phoneZoom + '%')
        console.log(phone);
    });

    $('#allocate input').on("input change", function() {
        var allocation = $(this).val();

        $('#allocate .col img').hide();
        if (allocation == 1) {$('#allocate .1, #allocate .10').show()}
        if (allocation == 2) {$('#allocate .3, #allocate .4, #allocate .5, #allocate .10, #allocate .9').show()}
        if (allocation == 3) {$('#allocate .4, #allocate .5, #allocate .10, #allocate .9').show()}
        if (allocation == 4) {$('#allocate .4, #allocate .5, #allocate .10, #allocate .9, #allocate .8').show()}
        if (allocation == 5) {$('#allocate .5, #allocate .10, #allocate .9, #allocate .8, #allocate .7').show()}
    });*/

    /** Popout function **/
    $('.popout').prepend('<i class="material-icons toggle tooltipped" data-position="bottom" data-delay="50" data-tooltip="Toggle view">launch</i>');
    $('.popout').before('<div class="popout-placeholder"></div>');

    $('.popout').each(function() {
        var divHeight = $(this).height();
        var divWidth = $(this).width();
        $(this).attr('height', divHeight);
        $(this).attr('width', divWidth);
        $(this).prev('.popout-placeholder').css({
            "width": divWidth,
            //"height": divHeight,
        });
    });

    $('.popout .toggle').click(function() {
        $(this).text(function(i, text){
            return text === "launch" ? "input" : "launch";
        })
        $(this).parent('.popout').toggleClass('fixed');
        //$(this).parent('.popout').prev('.popout-placeholder').toggleClass('fixed');

        //$(this).parent('.popout').prev('.popout-placeholder').toggleClass('expanded');
        // $(this).parent('.popout').prev('.popout-placeholder').css({
        //     "width": $(this).parent('.popout').attr('width'),
        //     "height": $(this).parent('.popout').attr('height')
        // });
        $(this).parent('.popout').css({
            "width": $(this).parent('.popout').attr('width'),
            "height": $(this).parent('.popout').attr('height')
        });
        //$(this).parent('.popout').
    });
});

/** Print handling functionality **/
$('.print-button').click(function() {
    var embed = $('.composite-embed').attr('src');

    parts = embed.split('/'),
    lastPart = parts.pop();
    var win = window.open('../print/index.html#' + lastPart, '_blank');
    if(win){
        //Browser has allowed it to be opened
        win.focus();
    }else{
        //Broswer has blocked it
        alert('Please allow popups for this site');
    }
});

function positionPopup() {
    //
}



// Prototype functions
// Remove if not approved
$( document ).ready(function() {
    var url = $(location).attr('href');
    // Get second last segment
    var urlChunks = url.split('/');
    var segment = urlChunks[urlChunks.length - 2];
    if (segment == 'subtopic') {
        $('.collapsible:eq(0)').hide();
        //$('.container').css('max-width', 800);
        $('.col.m8.offset-m2 img').css('width', '100%');
    }
});

/* Measure height of iFrame and resize */
function iframeLoaded() {
  var iFrameID = document.getElementById('idIframe');
  if(iFrameID) {
    console.log(iFrameID.height);
        // here you can make the height, I delete it first, then I make it again
        iFrameID.height = "";
        iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px"; //scrollHeight
  }

    var head = $("#idIframe").contents().find("head");
    var html = $("#idIframe").contents().find("html");
    var materialize = "../../components/css/materialize.css";
    var ttro = "../../components/css/economics.css";
    $(head).prepend($("<link/>", { rel: "stylesheet", href: ttro, type: "text/css" } ));
    $(head).prepend($("<link/>", { rel: "stylesheet", href: materialize, type: "text/css" } ));
    $(html).css('overflow', 'hidden');
}
function iframeLoadedPrint(entry) {
  var iFrameID = document.getElementById('idIframe-' + entry);
  if(iFrameID) {
        // here you can make the height, I delete it first, then I make it again
        iFrameID.height = "";
        iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px"; //scrollHeight
  }

    var head = $("#" + iFrameID).contents().find("head");
    var html = $("#" + iFrameID).contents().find("html");
    var materialize = "../../components/css/materialize.css";
    var ttro = "../../components/css/economics.css";
    $(head).prepend($("<link/>", { rel: "stylesheet", href: ttro, type: "text/css" } ));
    $(head).prepend($("<link/>", { rel: "stylesheet", href: materialize, type: "text/css" } ));
    $(html).css('overflow', 'hidden');
}
function iframInaIframeHeight(){
    var iFrame = document.getElementById('idIframe2');
    return;
}
function activityDone(activityBlock, frame_padding=0) {
    //var frame_padding=0;
    var block = "#" + activityBlock;
    console.log(block);
    var iFrameID = window.parent.document.getElementById(activityBlock);
    var parentiFrameID = window.parent.parent.document.getElementById('idIframe');
    //alert(parentiFrameID);
    
    var frameHeight = iFrameID.contentWindow.document.body.scrollHeight+frame_padding + "px";
    console.log(frameHeight);
    $(parent.document).find(block).height(frameHeight);
    
    console.log(parentiFrameID);
    var compositeHeight = parentiFrameID.contentWindow.document.body.scrollHeight+frame_padding + "px";
    $(parent.parent.document).find('.composite-embed').height(0);
    $(parent.parent.document).find('.composite-embed').height(compositeHeight);
 
}
// end measure height of iframe and resize



jQuery(document).ready(function($) {
    $.ajax({
        type: 'GET',
        url: '../../assets/subtopic2-q1.xml',
        dataType: 'xml',
        success: function(xml){
        //var xmlDoc = $.parseXML(xml); //causing issues :-\
            var fullXml = $(xml);
            var options = fullXml.find( "PROMPT>OPTIONS" );

            //assign the question
            $(".question-1 p:first").html(fullXml.find("PROMPT>QUESTION").text());
            //answers
            fullXml.find("OPTIONS>OPTION").each(function(i,item) {
                $(".question-1 .questions").append("<p><input type='radio' id='PPC32_"+i+"' name='group1' class='with-gap'> <label for='PPC32_"+i+"'>"+$(this).find("LABEL").text()+"</label></p>");
            });

            //add the feedback
            $('.question-1 .feedback').text(fullXml.find("PROMPT>FEEDBACK").text());
        }
    });
    /**
     * the code below shows the answer and disbles all other radios in the form
     */
    var disableChildRadio = function(parent){
        parent.children().find('*').attr('disabled', true);
    };

    


    function resetBodyPadding(){
        $('body').css('padding', '0px');
    }
    // this function disables other form elements when the form is submitted in
    // TODO: refine later for more flexibility


    $('a.btn').on('click', function(){
       var form = $(this).parent('div').parent('div').parent('div').parent('form');
       //make sure they have checked at least 1 option
       var checkboxes_checked = form.find('input[type=checkbox]:checked').length;
       if(checkboxes_checked == 0) {
            return false;
       }
       form.siblings('.feedback').css({'display' : 'block', 'margin-top': '-20px'});
       disableChildRadio(form);
       resetBodyPadding();
    });

    //This function resizes the iframe inside an iframe
    // $(function(){
    //     $('.activity-asset iframe').load(function () {
    //         $(this).height($(this).contents().height());
    //         console.log($(this).height());
    //     });
    // });


});

$( window ).load(function() {
    //iframeLoaded();
});
$(function(){
    $('#graph').parent().css('transition', 'all ease 0.2s');

    //this function changes images src and takes in an int
    var changeImage = function(value){
        switch(parseInt(value)){
            case 0:
                $('.device').attr('src', '678.svg');
                break;
            case 20:
                $('.device').attr('src', '679.svg');
                break;

            case 40:
                $('.device').attr('src', '680.svg');
                break;

            case 60:
                $('.device').attr('src', '681.svg');
                break;

            case 80:
                $('.device').attr('src', '682.svg');
                break;

            case 100:
                $('.device').attr('src', '683.svg');
                break;
        }
    };

    // var changeGraphImage = function(value){
    //     switch(parseInt(value)){
    //         case 0:
    //             $('.graph-3-image').attr('src', '624.svg');
    //             break;
    //         case 20:
    //             $('.graph-3-image').attr('src', '625.svg');
    //             break;

    //         case 40:
    //             $('.graph-3-image').attr('src', '626.svg');
    //             break;

    //         case 60:
    //             $('.graph-3-image').attr('src', '627.svg');
    //             break;

    //         case 80:
    //             $('.graph-3-image').attr('src', '628.svg');
    //             break;

    //         case 100:
    //             $('.graph-3-image').attr('src', '629.svg');
    //             break;
    //     }
    // };

//    this listens for when the text above the graph is clicked and changes the images by calling changeImage();
    $('.values a').on('click',function(){
        var value = $(this).data('val');
        $('#graph').val(value);
        changeImage(value);
    });
//  this function changes the image when the slider postion is moved
    $('#graph').on('change', function(){
        var value = $(this).val();
        changeImage(value);
    });

    // $('#graph3').on('change', function(){
    //     var value = $(this).val();
    //     changeGraphImage(value);
    // });

    $('#resize').click(function(){
        activityDone();
    });

    // $(".selection").on('click', function(){
    //     $(this).parent('p').siblings('.feedback').slideDown();
    //     iframeLoaded();
    // });

});

function $_GET(param) {
 var vars = {};
 window.location.href.replace(
  /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
  function( m, key, value ) { // callback
   vars[key] = value !== undefined ? value : '';
  }
 );

 if ( param ) {
  return vars[param] ? vars[param] : null;
 }
 return vars;
}

//resizing iframes
function resizeIframe() {
 
            var scroll = document.getElementsByName('print_h');
            var i;
  for (i = 0; i < scroll.length; i++) {
                        scroll[i].style.height = scroll[i].contentWindow.document.body.scrollHeight + 'px';
            };
}


function printStoryline (PageSL) {
  /*open root file*/
  var StoryLine_Root = Open_File('../assets/', PageSL);

  // console.log(StoryLine_Root);

  /*get Storyline_Collection*/
  var Storyline_Collection = StoryLine_Root.getElementsByTagName("storyline_collection")[0];
  var Children = Storyline_Collection.childNodes;
  //
  // /*Loop through Storyline_Collection children*/
  var i = 0;
  var pages = new Array();
  for (i = 0; i < Children.length; i++) {
    var Child = Children[i]

    if (Child.nodeType == 1) {
      var ChildType = get_Attribute(Child, 'type');
      var ChildLink = get_Attribute(Child, 'link');

      if (ChildType == 'leaf') {
        console.log(ChildLink);
        pages.push(ChildLink);
        // Display_Storyline_Leaf(Child, XML_Asset_Number);
      }
    }
  }
  console.log(pages);
  return pages;
}

//resizing iframes
function resizeIframe() {
	var scroll = document.getElementsByName('print_h');
	var i;
  for (i = 0; i < scroll.length; i++) {
		scroll[i].style.height = scroll[i].contentWindow.document.body.scrollHeight + 'px';
	};
}
