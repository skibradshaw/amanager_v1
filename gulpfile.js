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
    // Copy Foundation Elements from Bower to Assets.
    mix.copy('vendor/bower_components/foundation/scss', 'resources/assets/sass');
    mix.copy('vendor/bower_components/foundation/js', 'resources/assets/js');
    mix.copy('vendor/bower_components/jquery-ui/jquery-ui.js', 'resources/assets/js');
    mix.copy('vendor/bower_components/jquery-ui/themes/base/jquery-ui.css', 'resources/assets/sass');
    // Foundation Core and all JavaScript Plugins to Public folder
    mix.copy('resources/assets/js/foundation.min.js', 'public/js/foundation.min.js');
    // Foundation Mondernizr Shim for IE8 to Public folder
    mix.copy('resources/assets/js/vendor/modernizr.js', 'public/js/modernizr.js');

	

    mix.sass([
        // Foundation
    	'foundation.scss',
    	'normalize.scss',
        // jQuery UI
        'jquery-ui.css',
        'responsive-tables.css',
        // App Specific Overrides and Needs
    	'app.scss'
    	]);
    	
    mix.scripts([
        // Foundation (direct link to jQuery in foot)
        'datatables.js',
        'vendor/fastclick.js',
        'vendor/jquery.js',
        'responsive-tables.js',
        // jQuery UI
        'jquery-ui.js',

        
    	]);

    mix.version([
        'public/css/app.css',
        'public/js/all.js'
        ]);

   	
});
