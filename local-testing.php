<?php
/**
 * Plugin Name: Local Testing
 * Description: Local Testing
 * Version: 1.0.0
 * Author: Daan from Daan.dev
 * Author URI: https://daan.dev
 * License: GPL2v2 or later
 */

defined( 'ABSPATH' ) || exit;

define( 'LOCAL_TESTING_PLUGIN_FILE', __FILE__ );
define( 'LOCAL_TESTING_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function remove_ssl_verify() {
	add_filter( 'https_ssl_verify', '__return_false' );
}

add_action( 'init', 'remove_ssl_verify' );

/**
 * Test WebFont Loader
 */
function add_webfont_loader_sync_js() {
	?>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ['Droid Sans', 'Droid Serif']
            }
        });
    </script>
	<?php
}

//add_action( 'wp_head', 'add_webfont_loader_sync_js' );

function add_webfont_loader_async_js() {
	?>
    <script>
        WebFontConfig = {
            google: {families: ['Lato', 'Roboto']}
        };

        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
	<?php
}

// add_action( 'wp_head', 'add_webfont_loader_async_js' );

/**
 * Test Local Stylesheets
 */
function add_local_stylesheets() {
	wp_enqueue_style( 'local-stylesheet', LOCAL_TESTING_PLUGIN_URL . 'assets/css/import-statements.css' );
}

//add_action( 'wp_enqueue_scripts', 'add_local_stylesheets' );

/**
 * Test External Stylesheets
 */

/**
 * Test Async Google Fonts
 */
function add_async_google_fonts() {
	?>
    <script>
        let head_element = document.getElementsByTagName('head')[0];
        let link_element = document.createElement('link');
        link_element.rel = 'stylesheet';
        link_element.href = 'https://fonts.googleapis.com/css?family=Poppins:100,400,700&display=swap';
        link_element.async = true;
        head_element.appendChild(link_element);
    </script>
	<?php
}

//add_action( 'wp_head', 'add_async_google_fonts' );

function add_async_stylesheet_with_import() {
	?>
    <script>
        let di = document.createElement('style');
        di.id = 'async-stylesheet-with-import';
        di.textContent = `@import"https://fonts.googleapis.com/css?family=Nunito:700&display=swap";*,:before,:after{--tw-border-spacing-x: 0;--tw-border-spacing-y: 0;--tw-translate-x: 0;--tw-translate-y: 0;--tw-rotate: 0;--tw-skew-x: 0;--tw-skew-y: 0;--tw-scale-x: 1;--tw-scale-y: 1;`
        document.head.appendChild(di);
    </script>
	<?php
}

add_action( 'wp_head', 'add_async_stylesheet_with_import' );

/**
 * Uses font-families from @see add_async_google_fonts()
 * @return void
 */
function add_async_google_fonts_stylesheet() {
	wp_enqueue_style( 'async-google-fonts-stylesheet', LOCAL_TESTING_PLUGIN_URL . 'assets/css/async-google-fonts.css' );
}

//add_action( 'wp_enqueue_scripts', 'add_async_google_fonts_stylesheet' );

/**
 * This stylesheet uses the craziest axis definitions, etc. This needs to be tested with Unloading.
 *
 * @return void
 */
function add_the_ultimate_google_fonts_stylesheet_request() {
	wp_enqueue_style(
		'the-ultimate-google-fonts-stylesheet',
		'view-source:https://fonts.googleapis.com/css2?display=swap&family=Roboto:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Cormorant+Infant:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Rowdies:wght@300;400;700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&subset=latin,latin-ext'
	);
}

//add_action( 'wp_enqueue_scripts', 'add_the_ultimate_google_fonts_stylesheet_request' );

function material_icons() {
	wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons&#038;display=swap&#038;ver=6.8' );
}

//add_action( 'wp_enqueue_scripts', 'material_icons' );

/**
 * I use this function if I need OMGF to generate some Google Fonts for me.
 *
 * @return void
 */
function generate_me_something() {
	wp_enqueue_style( 'daan-license-manager', 'https://fonts.googleapis.com/css?family=Poppins:500,600,800|Public+Sans:400,400italic,600,600italic' );
}

// add_action( 'wp_enqueue_scripts', 'generate_me_something' );