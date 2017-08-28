$developer = true;
$collapsed = false;

console.log(window.global_conf.subdir);

$(document).ready(function() {

    initPrefs();
    windowCheck();

    if(localStorage.getItem("sidebar-collapse") === "true") {
        collapseMenu();
    }

    $('body').show();
});

$(window).resize(function() {
    windowCheck();
});

//click on the left arrow button
$("#collapse-menu").click(function () {
    collapseMenu();
    localStorage.setItem("sidebar-collapse", "true");
});

//click on the hamburger
$("#expand-menu").click(function () {
    if ($(window).width() < 750) {
        expandMenuOverlay();
    } else {
        expandMenu();
    }

    localStorage.setItem("sidebar-collapse", "false");
});

//assign click function to accordion buttons
$(".accordian").click(function(){

    if($collapsed) {
        expandMenuOverlay();
    }

    $('.accordian').not(this).each(function(){
        $(this).next().addClass("hidden",1000);
        $(this).find("i.toggle").removeClass("fa-minus");
        $(this).find("i.toggle").addClass("fa-plus");
    });

    $(this).find("i.toggle").toggleClass("fa-plus fa-minus");
    $(this).next().toggleClass("hidden", 1000);

});

//collapseAccordians
function resetAccordians() {

    $(".accordian").next().addClass("hidden",1000);
    $(".accordian").find("i.toggle").removeClass("fa-minus");
    $(".accordian").find("i.toggle").addClass("fa-plus");

    $developer ? window.console&&console.log('Reset Accordians.') : '';

}

//initiate prefs in localStorage if not done yet
function initPrefs() {
    if (localStorage.getItem("sidebar-collapse") === null) {
        localStorage.setItem("sidebar-collapse", "false");
    }
}

//check window size
function windowCheck() {
    if ($(window).width() < 750) {
        collapseMenu();
        $developer ? window.console&&console.log('Small window detected.') : '';
    } else {
        $developer ? window.console&&console.log('Large window detected.') : '';

        if(localStorage.getItem("sidebar-collapse") === "false") {
            expandMenu();
        }
    }
}

//collapse function
function collapseMenu() {

    resetAccordians();

    $(".menu-area").addClass("menu-area-collapse", 1000 );
    $(".menu-area").removeClass("menu-area-overlay", 1000 );
    $(".rightside-area").addClass("rightside-area-expand", 1000 );

    $("#menu-open").addClass("hidden", 1000);
    $("#menu-closed").removeClass("hidden", 1000);

    $(".menu_collapse").each(function( index ) {
        $(this).addClass("hidden", 1000);
    });

    $collapsed = true;

    $developer ? window.console&&console.log('Menu Collapsed.') : '';
    //update collapse setting
}

//expand function
function expandMenu() {
    $(".menu-area").removeClass("menu-area-collapse", 1000 );
    $(".rightside-area").removeClass("rightside-area-expand", 1000 );

    $("#menu-open").removeClass("hidden", 1000);
    $("#menu-closed").addClass("hidden", 1000);

    $(".menu_collapse").each(function( index ) {
        $(this).removeClass("hidden", 1000);
    });

    $collapsed = false;

    $developer ? window.console&&console.log('Menu Expanded.') : '';
    //update collapse setting
}

function expandMenuOverlay() {
    $(".menu-area").removeClass("menu-area-collapse", 1000 );
    $(".menu-area").addClass("menu-area-overlay", 1000 );

    $("#menu-open").removeClass("hidden", 1000);
    $("#menu-closed").addClass("hidden", 1000);

    $(".menu_collapse").each(function( index ) {
        $(this).removeClass("hidden", 1000);
    });

    $collapsed = false;

    $developer ? window.console&&console.log('Menu Overlay Expanded.') : '';

}
