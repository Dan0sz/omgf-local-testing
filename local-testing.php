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
define( 'LOCAL_TESTING_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LOCAL_TESTING_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function remove_ssl_verify() {
	add_filter( 'https_ssl_verify', '__return_false' );
}

add_action( 'init', 'remove_ssl_verify' );

function use_local_licensing_endpoint() {
	return 'https://daan.dev.local';
}

add_filter( 'ffwp_license_manager_api_url', 'use_local_licensing_endpoint' );

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

function add_webfont_loader() {
	wp_enqueue_script( 'csf-google-web-fonts', esc_url( '//ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js' ), [], null );

	wp_localize_script( 'csf-google-web-fonts', 'WebFontConfig', [ 'google' => [ 'families' => [ "ABeeZee:400", "Lato:500,600" ] ] ] );
}

add_action( 'wp_enqueue_scripts', 'add_webfont_loader' );

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

//add_action( 'wp_head', 'add_async_stylesheet_with_import' );

function add_non_enqueued_stylesheet() {
	?>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?display=swap&amp;family=Quattrocento+Sans%3A300%2C400%2C300%2C400%7CRoboto%3A300%2C400%2C300%2C400" media="all">
	<?php
}

//add_action( 'wp_head', 'add_non_enqueued_stylesheet' );

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

function add_inline_stylesheet() {
	?>
    <style>
        /* devanagari */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 500;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLGT9Z11lFc-K.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF9, U+200C-200D, U+20A8, U+20B9, U+20F0, U+25CC, U+A830-A839, U+A8E0-A8FF, U+11B00-11B09;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 500;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLGT9Z1JlFc-K.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 500;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLGT9Z1xlFQ.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* devanagari */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 600;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLEj6Z11lFc-K.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF9, U+200C-200D, U+20A8, U+20B9, U+20F0, U+25CC, U+A830-A839, U+A8E0-A8FF, U+11B00-11B09;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 600;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLEj6Z1JlFc-K.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 600;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLEj6Z1xlFQ.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* devanagari */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 800;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLDD4Z11lFc-K.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF9, U+200C-200D, U+20A8, U+20B9, U+20F0, U+25CC, U+A830-A839, U+A8E0-A8FF, U+11B00-11B09;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 800;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLDD4Z1JlFc-K.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 800;
            src: url(https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLDD4Z1xlFQ.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
	<?php
}

// add_action( 'wp_head', 'add_inline_stylesheet' );

function add_inline_kit_url() {
	?>
    <style f-forigin="undefined" f-origin="3" f-family="'eXchiWe9OMT:::Regular:::Rubik'" type="text/css">@font-face {
            font-family: 'eXchiWe9OMT:::Regular:::Rubik';
            font-style: normal;
            src: url('https://fonts.gstatic.com/l/font?kit=iJWZBXyIfDnIV5PNhY1KTN7Z-Yh-B4i1UFc0brT0qw&skey=cee854e66788286d&v=v31');
        }</style>
	<?php
}

// add_action( 'wp_head', 'add_inline_kit_url' );