var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
        /*.browserify(["StripeBilling.js"], "..resources/assets/js/StripeBilling2.js")*/
        .scripts([
            "vendor/jquery/dist/jquery.js",
            "vendor/jquery-ui/ui/core.js",
            "vendor/jquery-ui/ui/widget.js",
            "vendor/jquery-ui/ui/datepicker.js",
            "vendor/bootstrap/dist/js/bootstrap.js",
            "vendor/bootstrap/js/tab.js",
            "switch/bootstrap-switch.js"
        ], "public/js/all.js")
        .scripts([
            "vendor/vue/dist/vue.js",
            "vue/datepickerDirective.js",
            "vue/selectedDirective.js",
            "booking.js"
        ], "public/js/booking.js")
        .copy('resources/assets/js/StripeBilling.js', 'public/js')
        .copy('resources/assets/js/editBooking.js', 'public/js')
        .copy('resources/assets/css', 'public/css')
        .copy('public', 'public_html');
});
