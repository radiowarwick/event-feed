$('.navbar-default').mouseover(function() {
	$(this).css('background-color', 'rgba(248, 248, 248, 0.95)');
});

$('.navbar-default').mouseout(function() {
	var window_top = $(window).scrollTop();
	if (window_top > 70) {
		$(this).css('background-color', 'rgba(248, 248, 248, 0.4)');
	}
});

$(window).scroll(function(){
    var window_top = $(window).scrollTop();
    if (window_top > 70) {
        $('.navbar-default').css('background-color', 'rgba(248, 248, 248, 0.4)');
    } else {
        $('.navbar-default').css('background-color', 'rgba(248, 248, 248, 0.95)');
    }
});

// stop change if hovered.