const mix = require("laravel-mix");

/**
 * For frontend start
 */
mix.combine(
    [
        "public/frontend/lib/jquery/jquery.min.js",
        "public/frontend/lib/bootstrap/js/bootstrap.min.js",
        "public/frontend/lib/owlcarousel/owl.carousel.min.js",
        "public/frontend/lib/venobox/venobox.min.js",
        "public/frontend/lib/knob/jquery.knob.js",
        "public/frontend/lib/wow/wow.min.js",
        "public/frontend/lib/parallax/parallax.js",
        "public/frontend/lib/easing/easing.min.js",
        "public/frontend/lib/nivo-slider/js/jquery.nivo.slider.js",
        "public/frontend/lib/appear/jquery.appear.js",
        "public/frontend/lib/isotope/isotope.pkgd.min.js",
        "public/frontend/js/main.js"
    ],
    "public/compiled/frontend/frontend.js"
);

mix.styles(
    [
        "public/frontend/lib/bootstrap/css/bootstrap.min.css",
        "public/frontend/lib/nivo-slider/css/nivo-slider.css",
        "public/frontend/lib/owlcarousel/owl.carousel.css",
        "public/frontend/lib/owlcarousel/owl.transitions.css",
        "public/frontend/lib/animate/animate.min.css",
        "public/frontend/lib/venobox/venobox.css",
        "public/frontend/css/nivo-slider-theme.css",
        "public/frontend/css/style.css",
        "public/frontend/css/responsive.css"
    ],
    "public/compiled/frontend/frontend.css"
);

/** For frontend stop */

/**For client start */
mix.combine(
    [
        "public/client/vendor/jquery/jquery.min.js",
        "public/client/vendor/bootstrap/js/bootstrap.bundle.min.js",
        "public/client/vendor/jquery-easing/jquery.easing.min.js",
        "public/client/js/sb-admin-2.min.js",
        "public/client/js/demo/chart-area-demo.js",
        "public/client/js/demo/chart-pie-demo.js"
    ],
    "public/compiled/client/client.js"
);
/** For client stop */

/**
 * For admin start
 */
mix.styles(
    [
        "public/admin/css/bootstrap.min.css",
        "public/admin/css/sb-admin.css",
    ],
    "public/compiled/admin/admin.css"
);
mix.combine([
    "public/admin/js/jquery.min.js",
    "public/admin/js/bootstrap.bundle.min.js",
    "public/'admin/js/sb-admin.min.js'"
], "public/compiled/admin/admin.js");
 /**For admin stop */
