$(document).ready(function () {
    $(window).scroll(function () {
        var e = $(this).scrollTop(),
            o = $(".banner-sticky-top");
        e >= 80 ? o.addClass("banner-manu-black") : o.removeClass("banner-manu-black")
    }),  
        $("a.smooth-s").on("click", function () {
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
            var e = $(this.hash);
            if ((e = e.length ? e : $("[name=" + this.hash.slice(1) + "]")).length) return $("html, body").animate({
                scrollTop: e.offset().top
            }, 1e3), !1
        }
    }), $(window).scroll(function () {
        $(this).scrollTop() > 100 ? $(".top-up").fadeIn() : $(".top-up").fadeOut()
    }), $(".top-up").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 2e3)
    }), 
        (new WOW).init()
});
