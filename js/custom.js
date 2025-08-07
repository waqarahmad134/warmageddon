$(function () {
    $('a[href*="#"]:not([href="#').on("click", function () {
        if (
            location.pathname.replace(/^\//, "") ===
                this.pathname.replace(/^\//, "") &&
            location.hostname === this.hostname
        ) {
            var a = $(this.hash);
            if (
                (a = a.length ? a : $("[name=" + this.hash.slice(1) + "]"))
                    .length
            )
                return (
                    $("html, body").animate({ scrollTop: a.offset().top }, 1e3),
                    !1
                );
        }
    });
    var a = {
        opacityIn: [0, 1],
        scaleIn: [0.2, 1],
        scaleOut: 3,
        durationIn: 800,
        durationOut: 600,
        delay: 500,
    };
    anime
        .timeline({ loop: !0 })
        .add({
            targets: ".ml4 .letters-1",
            opacity: a.opacityIn,
            scale: a.scaleIn,
            duration: a.durationIn,
        })
        .add({
            targets: ".ml4 .letters-1",
            opacity: 0,
            scale: a.scaleOut,
            duration: a.durationOut,
            easing: "easeInExpo",
            delay: a.delay,
        })
        .add({
            targets: ".ml4 .letters-2",
            opacity: a.opacityIn,
            scale: a.scaleIn,
            duration: a.durationIn,
        })
        .add({
            targets: ".ml4 .letters-2",
            opacity: 0,
            scale: a.scaleOut,
            duration: a.durationOut,
            easing: "easeInExpo",
            delay: a.delay,
        })
        .add({
            targets: ".ml4 .letters-3",
            opacity: a.opacityIn,
            scale: a.scaleIn,
            duration: a.durationIn,
        })
        .add({
            targets: ".ml4 .letters-3",
            opacity: 0,
            scale: a.scaleOut,
            duration: a.durationOut,
            easing: "easeInExpo",
            delay: a.delay,
        })
        .add({
            targets: ".ml4 .letters-4",
            opacity: a.opacityIn,
            scale: a.scaleIn,
            duration: a.durationIn,
        })
        .add({
            targets: ".ml4 .letters-4",
            opacity: 0,
            scale: a.scaleOut,
            duration: a.durationOut,
            easing: "easeInExpo",
            delay: a.delay,
        })
        .add({
            targets: ".ml4 .letters-5",
            opacity: a.opacityIn,
            scale: a.scaleIn,
            duration: a.durationIn,
        })
        .add({
            targets: ".ml4 .letters-5",
            opacity: 0,
            scale: a.scaleOut,
            duration: a.durationOut,
            easing: "easeInExpo",
            delay: a.delay,
        })
        .add({
            targets: ".ml4 .letters-6",
            opacity: a.opacityIn,
            scale: a.scaleIn,
            duration: a.durationIn,
        })
        .add({
            targets: ".ml4 .letters-6",
            opacity: 0,
            scale: a.scaleOut,
            duration: a.durationOut,
            easing: "easeInExpo",
            delay: a.delay,
        })
        .add({
            targets: ".ml4 .letters-7",
            opacity: a.opacityIn,
            scale: a.scaleIn,
            duration: a.durationIn,
        })
        .add({
            targets: ".ml4 .letters-7",
            opacity: 0,
            scale: a.scaleOut,
            duration: a.durationOut,
            easing: "easeInExpo",
            delay: a.delay,
        })
        .add({
            targets: ".ml4 .letters-8",
            opacity: a.opacityIn,
            scale: a.scaleIn,
            duration: a.durationIn,
        })
        .add({
            targets: ".ml4 .letters-8",
            opacity: 0,
            scale: a.scaleOut,
            duration: a.durationOut,
            easing: "easeInExpo",
            delay: a.delay,
        })
        .add({ targets: ".ml4", opacity: 0, duration: 200, delay: 200 });
});
