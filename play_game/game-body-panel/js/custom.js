$(document).ready(function() {
    //Navbar bg when scroll 
    $(window).scroll(function(){
        var scrolling = $(this).scrollTop();
        var sticky = $(".banner-sticky-top");
        if(scrolling >=80){
            sticky.addClass("banner-manu-black");
        }
        else{
            sticky.removeClass("banner-manu-black");
        }
    });
    
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
});