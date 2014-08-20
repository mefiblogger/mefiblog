$(function() {
    // logo animacio
    window.addEventListener("scroll", function (e) {
        var y = window.pageYOffset || document.documentElement.scrollTop,
            jumpOn = 240,
            header = $("#main-header"),
            container = $("#container"),
            logo = $("#logo"),
            basePadding = 225;

        if (y > jumpOn) {
            logo.css("padding-top", "30px")
            header.addClass("smaller");
            container.addClass("smaller");
        } else {
            if (header.hasClass("smaller")) {
                header.removeClass("smaller");
                container.removeClass("smaller");
            }
            logo.css("padding-top", basePadding + y + "px");
        }
    });

    // kereses megnyitasa
    $("#search").click(function (e) {
        if ("search-field" != $(e.target).attr("id")) {
            $(this).toggleClass('open');
            $("#search-field").focus();
        }
    });

    // kereses bezarasa
    $("#search-field").blur(function () {
        $("#search").removeClass("open");
    });
});
