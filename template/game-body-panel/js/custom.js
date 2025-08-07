$(function(){
   // navbar bg when scroll    
    $(window).scroll(function(){
       var scrolling = $(this).scrollTop();
       var sticky = $(".sticky-top");
       if(scrolling >=5){
           sticky.addClass("navbak");
       }
       else{
           sticky.removeClass("navbak");
       }
    }); 
});