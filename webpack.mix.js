const mix = require("laravel-mix");

/**
 * For frontend start
 */
mix.combine(
    [
        "public_html/frontend/lib/jquery/jquery.min.js",
        "public_html/frontend/lib/bootstrap/js/bootstrap.min.js",
        "public_html/frontend/lib/owlcarousel/owl.carousel.min.js",
        "public_html/frontend/lib/venobox/venobox.min.js",
        "public_html/frontend/lib/knob/jquery.knob.js",
        "public_html/frontend/lib/wow/wow.min.js",
        "public_html/frontend/lib/parallax/parallax.js",
        "public_html/frontend/lib/easing/easing.min.js",
        "public_html/frontend/lib/nivo-slider/js/jquery.nivo.slider.js",
        "public_html/frontend/lib/appear/jquery.appear.js",
        "public_html/frontend/lib/isotope/isotope.pkgd.min.js",
        "public_html/frontend/contactform/contactform.js",
        "public_html/frontend/js/main.js"
    ],
    "public_html/compiled/frontend/frontend.js"
);

mix.styles(
    [
        "public_html/frontend/lib/bootstrap/css/bootstrap.min.css",
        "public_html/frontend/lib/nivo-slider/css/nivo-slider.css",
        "public_html/frontend/lib/owlcarousel/owl.carousel.css",
        "public_html/frontend/lib/owlcarousel/owl.transitions.css",
        "public_html/frontend/lib/animate/animate.min.css",
        "public_html/frontend/lib/venobox/venobox.css",
        "public_html/frontend/css/nivo-slider-theme.css",
        "public_html/frontend/css/style.css",
        "public_html/frontend/css/responsive.css"
    ],
    "public_html/compiled/frontend/frontend.css"
);

/** For frontend stop */

/**For client start */
mix.combine(
    [
        "public_html/client/vendor/jquery/jquery.min.js",
        "public_html/client/vendor/bootstrap/js/bootstrap.bundle.min.js",
        "public_html/client/vendor/jquery-easing/jquery.easing.min.js",
        "public_html/client/js/sb-admin-2.min.js",
        // "public_html/'client/vendor/chart.js/Chart.min.js",
        "public_html/client/js/demo/chart-area-demo.js",
        "public_html/client/js/demo/chart-pie-demo.js"
    ],
    "public_html/compiled/client/client.js"
);
/** For client stop */