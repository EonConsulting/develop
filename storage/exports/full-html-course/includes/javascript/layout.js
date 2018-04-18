function resize(){
    $page_height = $('body').height();
    $heading_height = $('.course-title').height();
    
    $('.flex-container').height($page_height - $heading_height - 16)
}

$(document).ready(function(){
    resize();
});

$(window).resize(function(){
    resize();
});
