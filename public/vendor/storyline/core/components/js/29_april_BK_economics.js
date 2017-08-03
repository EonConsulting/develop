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
    var oldValue = 0;
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
    });

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

/******Embedded activities******/
//var $select5 = $('#asset5 .dropdown-activity select'); //Cache the select
//$select5.on('change', function() {
//    var valid = true; //Flag
//
//    $select5.each(function() {
//        return valid = !!this.value //Assign the flag a bolean is valid or not
//    });
//    $(this).parents('form').siblings(".feedback").toggle(valid); //Display/hide
//    //parent.iframeLoaded();
//    if (valid == true) {
//        var activityBlock = $(this).parents('.asset').attr('id');
//        activityDone(activityBlock);
//    }
//
//});
//
//var $select6 = $('#asset6 .dropdown-activity select'); //Cache the select
//$select6.on('change', function() {
//    var valid = true; //Flag
//
//    $select6.each(function() {
//        return valid = !!this.value //Assign the flag a bolean is valid or not
//    });
//    $(this).parents('form').siblings(".feedback").toggle(valid); //Display/hide
//    if (valid == true) {
//        var activityBlock = $(this).parents('.asset').attr('id');
//        activityDone(activityBlock);
//    }
//});

var markChanged = $(function(){
    $('body').on('change', 'div.dropdown-activity select', function(){

        $(this).addClass('changed');
        var total_selected = $(this).parents('div.dropdown-activity').find('select.changed').length;

        if(total_selected == 2){
            $(this).parents('div.dropdown-activity').find('select.changed').parent().parent().parent().next().slideDown(200);
        }

        var current_select = $(this).attr('data');
//        var other_select =






//        if(){


    });
});

//$('.radio-activity .with-gap').change(function () {
//    $(this).parents('form').find('.with-gap').each(function() {
//        $(this).attr('disabled', 'disabled');
//    });
//    $(this).parents('form').siblings(".feedback").show();
//    var activityBlock = $(this).parents('.asset').attr('id');
//    activityDone(activityBlock);
//});

// $('.checkbox').change(function () {
//     $(this).parents('form').find('.checkbox').each(function() {
//         $(this).attr('disabled', 'disabled');
//     });
//     $(this).parents('form').siblings(".feedback").show();
// });
$('.check-activity .submit').on('click', function() {
    $(this).parents('form').siblings('.feedback').show();
    $(this).parents('form').find('.checkbox').attr('disabled', 'disabled');
    //$('#PPC37 .checkbox').attr('disabled', 'disabled');
    var activityBlock = $(this).parents('.asset').attr('id');
    activityDone(activityBlock);
});

$('#PPC29 .submit').on('click', function() {

    $(this).parents('form').siblings('.feedback').show();

    $('#PPC29 .checkbox').each(function() {
        var capital = $(this).attr('capital');
        if (this.checked && capital == 'true') {
            $(this).siblings('label').css('color', 'green');
        }
        if (!this.checked && capital == 'true') {
            $(this).siblings('label').css('color', 'red');
            this.setAttribute("checked", "checked");
            this.checked = true;
        }
        if (!this.checked && capital == undefined) {
            $(this).siblings('label').css('color', 'green');
        }
        if (this.checked && capital == undefined) {
            $(this).siblings('label').css('color', 'red');
            this.setAttribute("checked", ""); // For IE
            this.removeAttribute("checked"); // For other browsers
            this.checked = false;
        }
    });

    $('#PPC29_7').siblings('label').css('color', 'green');
    $('#PPC29_7').prop("indeterminate", true);

    $(this).parents('form').find('.checkbox').attr('disabled', 'disabled');
    var activityBlock = $(this).parents('.asset').attr('id');
    activityDone(activityBlock);
});




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
    var materialize = "../components/css/materialize.css";
    var ttro = "../components/css/economics.css";
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
function activityDone(activityBlock) {
    var block = "#" + activityBlock;
    console.log(block);
    var iFrameID = window.parent.document.getElementById('idIframe');
    if(iFrameID) {
        // here you can make the height, I delete it first, then I make it again
        //iFrameID.height = "";
        iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px"; //scrollHeight
    }
    //document.getElementById(activityBlock).scrollIntoView(true);
    // $('html,body').animate({
    //     scrollTop: $(block).offset().top - 10
    // });
}
// end measure height of iframe and resize


jQuery(document).ready(function($) {
/*
    $.ajax({
        type: 'GET',
        url: '../assets/subtopic2-q1.xml',
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
  */  
     // the code below shows the answer and disbles all other radios in the form
     
    var disableChildRadio = function(parent){
        parent.children().find('*').attr('disabled', true);
    };

    $('.radio-activity input').on('change', function(){
        console.log("RADIO ACTIVITY");
        var form = $(this).parent('p').parent('div').parent('div').parent('form');
        var feedback = form.siblings();
        $(feedback).slideDown(200);
        activityDone();
        disableChildRadio(form);
    });


    function resetBodyPadding(){
        $('body').css('padding', '0px');
    }
    // this function disables other form elements when the form is submitted in
    // TODO: refine later for more flexibility


    $('a.btn').on('click', function(){
       var form = $(this).parent('div').parent('div').parent('div').parent('form');
       form.siblings('.feedback').css({'display' : 'block', 'margin-top': '-20px'});
       disableChildRadio(form);
       resetBodyPadding();
    });

    //This function resizes the iframe inside an iframe. for some reason I could not reuse the existing one
    $(function(){
        $('#idIframe2').load(function () {
            $('#idIframe2').height($('#idIframe2').contents().height() + 70);
            console.log($('#idIframe2').height());
        });
    });

    $(function(){
        $('.idIframe2').load(function () {
            $(this).height($(this).contents().height() + 70);
            console.log($(this).height());
        });
    });

});


$( window ).load(function() {
    iframeLoaded();
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

    var changeGraphImage = function(value){
        switch(parseInt(value)){
            case 0:
                $('.graph-3-image').attr('src', '624.svg');
                break;
            case 20:
                $('.graph-3-image').attr('src', '625.svg');
                break;

            case 40:
                $('.graph-3-image').attr('src', '626.svg');
                break;

            case 60:
                $('.graph-3-image').attr('src', '627.svg');
                break;

            case 80:
                $('.graph-3-image').attr('src', '628.svg');
                break;

            case 100:
                $('.graph-3-image').attr('src', '629.svg');
                break;
        }
    };

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

    $('#graph3').on('change', function(){
        var value = $(this).val();
        changeGraphImage(value);
    });

    $('#resize').click(function(){
        activityDone();
    });

    $(".selection").on('click', function(){
        $(this).parent('p').siblings('.feedback').slideDown();
        iframeLoaded();
    });

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