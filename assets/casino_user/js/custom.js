$(document).ready(function() {
    //loading setting a timeout
//    setTimeout(function() {
//        $('body').addClass('loaded');
//    }, 3500);
    
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
    
    // wow js 
    new WOW().init();

    // Bar chart
    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
          labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
          datasets: [
            {
              label: "Earning Lavel",
              backgroundColor: ["#f7941d", "#c45850","#8e5ea2","#e8c3b9","#3e95cd","#ed1c24","#3cba9f"],
              data: [3569,5267,2515,3125,1856,4356,1456]
            }
          ]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: 'EARNING STAT'
          }
        }
    });
    
    //line chart
    new Chart(document.getElementById("line-chart"), {
      type: 'line',
      data: {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        datasets: [{ 
            data: [0,85,115,75,20,100,133],
            label: "All Games",
            borderColor: "#bc8b2c",
            fill: false
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Game Winnig STAT'
        }
      }
    });
    

    
});