$(document).ready(function() {
    
    //smooth animation scroll js
    $('a.smooth-s').on('click', function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
    
    //Topup smooth animation scroll
    $(window).scroll(function(){
    if($(this).scrollTop() > 100){
        $('.top-up').fadeIn();
    }
    else{
        $('.top-up').fadeOut();
    }
        
    });
    $('.top-up').click(function(){
        $('html, body').animate({scrollTop: 0}, 2000);
    });
    
    // wow js 
    new WOW().init();
    
    //For Filter
    var filterList = {
		init: function () {
			// https://mixitup.kunkalabs.com/
			$('#gallery').mixItUp({
                animation: {
                    duration: 350,
                    nudge: true,
                    reverseOut: true,
                    effects: "fade rotateX(90deg) rotateY(90deg) rotateZ(180deg) stagger(50ms)"
                },
				selectors: {
                    target: '.gallery-item',
                    filter: '.filter'	
                },
                load: {
                    filter: '.black, .craps, .classic, .roulette, .poker, .bingo, .sicbo, .keno, .scratch, .baccarat, .other' // show all items on page load.
                }     
			});								
		}
	};
	// Filter ALL the things
	filterList.init();
});