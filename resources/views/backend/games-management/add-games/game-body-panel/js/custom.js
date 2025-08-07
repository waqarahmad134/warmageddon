$(function(){
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
        $('html, body').animate({scrollTop: 0}, 1000);
    });
    
});