const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles([
   		'node_modules/noty/lib/noty.css',
	    'node_modules/semantic-ui/dist/semantic.css',
	    'resources/assets/css/admin/login.css',
	    'resources/assets/css/admin/global.css'
	], 'public/css/admin/admin.css')
   .scripts([
   		'node_modules/noty/lib/noty.js',
	    'node_modules/jquery/dist/jquery.js',
	    'node_modules/form-serializer/jquery.serialize-object.js',
	    'node_modules/semantic-ui/dist/semantic.js',
	    'resources/assets/js/admin/login.js',
	    'resources/assets/js/admin/admin.js'
	], 'public/js/admin/admin.js')
   .styles([
   		'node_modules/noty/lib/noty.css',
	    'node_modules/semantic-ui/dist/semantic.css',
	    'resources/assets/css/police/police.css',
	], 'public/css/police.css')
   .scripts([
   		'node_modules/noty/lib/noty.js',
	    'node_modules/jquery/dist/jquery.js',
	    'node_modules/form-serializer/jquery.serialize-object.js',
	    'node_modules/semantic-ui/dist/semantic.js',
	    'resources/assets/js/police/police.js'
	], 'public/js/police.js')
   ;
