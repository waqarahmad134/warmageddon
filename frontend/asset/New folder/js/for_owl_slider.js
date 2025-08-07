$(document).ready(function () {
    // Declare Carousel jquery object
    var owl = $('.owl-carousel');

    // Carousel initialization
    owl.owlCarousel({
        loop: true,
        items: 1,
        margin: 0,
        nav: false,
        navSpeed: 3000,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
    });
    /*owl.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });*/


    // add animate.css class(es) to the elements to be animated
    function setAnimation(_elem, _InOut) {
        // Store all animationend event name in a string.
        // cf animate.css documentation
        var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

        _elem.each(function () {
            var $elem = $(this);
            var $animationType = 'animated ' + $elem.data('animation-' + _InOut);

            $elem.addClass($animationType).one(animationEndEvent, function () {
                $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
            });
        });
    }

    // Fired before current slide change
    owl.on('change.owl.carousel', function (event) {
        var $currentItem = $('.owl-item', owl).eq(event.item.index);
        var $elemsToanim = $currentItem.find("[data-animation-out]");
        setAnimation($elemsToanim, 'out');
    });

    // Fired after current slide has been changed
    owl.on('changed.owl.carousel', function (event) {

        var $currentItem = $('.owl-item', owl).eq(event.item.index);
        var $elemsToanim = $currentItem.find("[data-animation-in]");
        setAnimation($elemsToanim, 'in');
    })

});