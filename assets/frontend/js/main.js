/* ======================================
 
 Template: ProperSix Casino
 Css Name: Main Js
 Version: 1
 Design and Developed by: ikonami
 
 ========================================= */

/*================================================
 [  Table of contents  ]
 ================================================
 
 01. Menu Navvar
 02. Nav Var Remove Add
 03. Scrool Spy
 04. Sticky Header
 05. Counter Up
 06. Testimonial Owl Active
 07. Slider Full Carousel
 08. Slider Text Carousel
 09. Screenshot Slider
 10. scrollUp
 
 ================================================*/

(function ($) {
    "use strict";

    //  01. Menu Navvar
    $(".navbar-nav a, .scroll-icon a, .appai-preview .button-group a").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function () {
                window.location.hash = hash;
            });
        }
    });

    // 02. Nav Var Remove Add
    $(document).on("click", ".navbar-nav a", function () {
        $(".navbar-nav").find("li").removeClass("active");
        $(this).closest("li").addClass("active");
    });

    // 03. Scrool Spy
    $('body').scrollspy({target: '#navigation'})

    // 04. Sticky Header
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 0) {
            $('#header-top').addClass("navbar-fixed-top");
        } else {
            $('#header-top').removeClass("navbar-fixed-top");
        }
    });

    // 05. Counter Up
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });

    // 06. Testimonial Owl Active
    $('.testimonial-active').owlCarousel({
        items: 1,
        lazyLoad: true,
        dots: false,
        loop: false,
        margin: 10
    });



    // 09. Slider Full Carousel
    $(".slider-full-carousel").owlCarousel({
        loop: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 2500,
        nav: true,
        navText: ["<i class='icofont icofont-thin-left'></i>", "<i class='icofont icofont-thin-right'></i>"],
        items: 1,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // 10. Slider Text Carousel
    $(".slider-carousel").owlCarousel({
        loop: true,
        smartSpeed: 2500,
        nav: true,
        navText: ["<i class='icofont icofont-thin-left'></i>", "<i class='icofont icofont-thin-right'></i>"],
        items: 1,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });


    // 12. Screenshot Slider
    $('.screenshot-slider').slick({
        centerMode: true,
        centerPadding: '0',
        slidesToShow: 3,
        dots: false,
        arrows: false,
        autoplay: true,
        prevArrow: '<button class="slick-prev ss2-prev" type="button"><i class="icofont icofont-thin-left"></i></i></button>',
        nextArrow: '<button class="slick-next ss2-next" type="button"><i class="icofont icofont-thin-right"></i></button>',
    });

    // 13. scrollUp
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

})(jQuery);

/* START SLICK JS */
$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    autoplay: true,
    asNavFor: '.slider-nav',
});
$('.slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: true,
    autoplay: true,
    focusOnSelect: true,
    responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
});


/* Latest compiled and minified JavaScript included as External Resource */

$(document).ready(function () {

    $(".filter-button").click(function () {
        var value = $(this).attr('data-filter');

        if (value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        } else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');

        }
    });

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");

});

/*START CONTACT MAP JS*/
function initialize() {
    var mapOptions = {
        zoom: 16,
        scrollwheel: false,
        center: new google.maps.LatLng(35.920149, 14.491264)
    };
    var map = new google.maps.Map(document.getElementById('map'),
            mapOptions);
    var marker = new google.maps.Marker({
        position: map.getCenter(),
        icon: 'assets/frontend/img/icon/map-icon.png',
        map: map
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
/*END CONTACT MAP JS*/

/* Animation of Elements */
AOS.init();

/* Feature Divs Equal Height */
var maxHeight = 0;

$(".card-box").each(function(){
   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
});

$(".card-box").height(maxHeight);


/* Date Picker */
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});


/* Data Tables*/
$(document).ready(function () {
    $('#deposit-table').DataTable();
    $('#withdraw-table').DataTable();
    $('#other-transactions-table').DataTable();
    $('#single-player-table').DataTable();
    $('#multiplayer-bingo-table').DataTable();
    $('#multiplayer-lottery-table').DataTable();
    $('#multiplayer-racing-table').DataTable();
    $('#multiplayer-scibo-table').DataTable();
    $('#multiplayer-am-roulette-table').DataTable();
    $('#multiplayer-eu-roulette-table').DataTable();
    $('#slots-tournament-table').DataTable();
    $('#prizes-table').DataTable();
    $('#admin-messages-table').DataTable();
    $('#lgoin-history-table').DataTable();
    $('#instant-bonuses-table').DataTable();
  
});