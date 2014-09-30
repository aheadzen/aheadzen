// DOM Ready
jQuery.noConflict();
jQuery(function() {

    var $el, leftPos, newWidth;
    
    /* Add Magic Line markup via JavaScript, because it ain't gonna work without */
    jQuery("#main-menu ul").append("<li id='magic-line'></li>");
    
    /* Cache it */
    var $magicLine = jQuery("#magic-line");
    
    $magicLine
        .width(jQuery(".current_page_item").width())
        .css("left", jQuery(".current_page_item a").position().left)
        .data("origLeft", $magicLine.position().left)
        .data("origWidth", $magicLine.width());
        
    jQuery("#main-menu ul li").find("a").hover(function() {
        $el = jQuery(this);
        leftPos = $el.position().left;
        newWidth = $el.parent().width();
        
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        });
    }, function() {
        $magicLine.stop().animate({
            left: jQuery(".current_page_item a").position().left,
            width: jQuery(".current_page_item").width() 
        });
    });
    
});