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

// add_filter( 'ffwp_license_manager_api_url', 'use_local_licensing_endpoint' );

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

//add_action( 'wp_enqueue_scripts', 'add_webfont_loader' );

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

function add_ttf_inline() {
    ?>
    <style type="text/css">@font-face {
            font-family: 'Fira Sans';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/firasans/v18/va9E4kDNxMZdWfMOD5VfkA.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Fira Sans';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/firasans/v18/va9B4kDNxMZdWfMOD5VnZKvuQQ.ttf) format('truetype');
        }
    </style>
    <?php
}

//add_action( 'wp_head', 'add_ttf_inline' );

function add_inline_kit_url() {
    ?>
    <style f-forigin="undefined" f-origin="3" f-family="'eXchiWe9OMT:::Regular:::Rubik'" type="text/css">@font-face {
            font-family: 'eXchiWe9OMT:::Regular:::Rubik';
            font-style: normal;
            src: url('https://fonts.gstatic.com/l/font?kit=iJWZBXyIfDnIV5PNhY1KTN7Z-Yh-B4i1UFc0brT0qw&skey=cee854e66788286d&v=v31');
        }</style>
    <?php
}

//add_action( 'wp_head', 'add_inline_kit_url' );

/**
 * This URL will cause a BAD REQUEST 400!!1 from Google, if HTML entities aren't formatted properly.
 *
 * @return void
 */
function add_weirdly_formatted_url() {
    wp_enqueue_style( 'weirdly-formatted-url', 'https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&amp;subset=,latin' );
}

//add_action( 'wp_enqueue_scripts', 'add_weirdly_formatted_url' );

function load_all_fonts() {
    ?>
    <style type='text/css'>@import url('https://fonts.googleapis.com/css?family=ABeeZee|Abel|Abril+Fatface|Aclonica|Acme|Actor|Adamina|Advent+Pro|Aguafina+Script|Akronim|Aladin|Aldrich|Alef|Alegreya|Alegreya+SC|Alegreya+Sans|Alegreya+Sans+SC|Alex+Brush|Alfa+Slab+One|Alice|Alike|Alike+Angular|Allan|Allerta|Allerta+Stencil|Allura|Almendra|Almendra+Display|Almendra+SC|Amarante|Amaranth|Amatic+SC|Amatica+SC|Amethysta|Amiko|Amiri|Amita|Anaheim|Andada|Andika|Angkor|Annie+Use+Your+Telescope|Anonymous+Pro|Antic|Antic+Didone|Antic+Slab|Anton|Arapey|Arbutus|Arbutus+Slab|Architects+Daughter|Archivo+Black|Archivo+Narrow|Aref+Ruqaa|Arima+Madurai|Arimo|Arizonia|Armata|Artifika|Arvo|Arya|Asap|Asar|Asset|Assistant|Astloch|Asul|Athiti|Atma|Atomic+Age|Aubrey|Audiowide|Autour+One|Average|Average+Sans|Averia+Gruesa+Libre|Averia+Libre|Averia+Sans+Libre|Averia+Serif+Libre|Bad+Script|Baloo|Baloo+Bhai|Baloo+Da|Baloo+Thambi|Balthazar|Bangers|Basic|Battambang|Baumans|Bayon|Belgrano|Belleza|BenchNine|Bentham|Berkshire+Swash|Bevan|Bigelow+Rules|Bigshot+One|Bilbo|Bilbo+Swash+Caps|BioRhyme|BioRhyme+Expanded|Biryani|Bitter|Black+Ops+One|Bokor|Bonbon|Boogaloo|Bowlby+One|Bowlby+One+SC|Brawler|Bree+Serif|Bubblegum+Sans|Bubbler+One|Buda|Buenard|Bungee|Bungee+Hairline|Bungee+Inline|Bungee+Outline|Bungee+Shade|Butcherman|Butterfly+Kids|Cabin|Cabin+Condensed|Cabin+Sketch|Caesar+Dressing|Cagliostro|Cairo|Calligraffitti|Cambay|Cambo|Candal|Cantarell|Cantata+One|Cantora+One|Capriola|Cardo|Carme|Carrois+Gothic|Carrois+Gothic+SC|Carter+One|Catamaran|Caudex|Caveat|Caveat+Brush|Cedarville+Cursive|Ceviche+One|Changa|Changa+One|Chango|Chathura|Chau+Philomene+One|Chela+One|Chelsea+Market|Chenla|Cherry+Cream+Soda|Cherry+Swash|Chewy|Chicle|Chivo|Chonburi|Cinzel|Cinzel+Decorative|Clicker+Script|Coda|Coda+Caption|Codystar|Coiny|Combo|Comfortaa|Coming+Soon|Concert+One|Condiment|Content|Contrail+One|Convergence|Cookie|Copse|Corben|Cormorant|Cormorant+Garamond|Cormorant+Infant|Cormorant+SC|Cormorant+Unicase|Cormorant+Upright|Courgette|Cousine|Coustard|Covered+By+Your+Grace|Crafty+Girls|Creepster|Crete+Round|Crimson+Text|Croissant+One|Crushed|Cuprum|Cutive|Cutive+Mono|Damion|Dancing+Script|Dangrek|David+Libre|Dawning+of+a+New+Day|Days+One|Dekko|Delius|Delius+Swash+Caps|Delius+Unicase|Della+Respira|Denk+One|Devonshire|Dhurjati|Didact+Gothic|Diplomata|Diplomata+SC|Domine|Donegal+One|Doppio+One|Dorsa|Dosis|Dr+Sugiyama|Droid+Sans|Droid+Sans+Mono|Droid+Serif|Duru+Sans|Dynalight|EB+Garamond|Eagle+Lake|Eater|Economica|Eczar|Ek+Mukta|El+Messiri|Electrolize|Elsie|Elsie+Swash+Caps|Emblema+One|Emilys+Candy|Engagement|Englebert|Enriqueta|Erica+One|Esteban|Euphoria+Script|Ewert|Exo|Exo+2|Expletus+Sans|Fanwood+Text|Farsan|Fascinate|Fascinate+Inline|Faster+One|Fasthand|Fauna+One|Federant|Federo|Felipa|Fenix|Finger+Paint|Fira+Mono|Fira+Sans|Fjalla+One|Fjord+One|Flamenco|Flavors|Fondamento|Fontdiner+Swanky|Forum|Francois+One|Frank+Ruhl+Libre|Freckle+Face|Fredericka+the+Great|Fredoka+One|Freehand|Fresca|Frijole|Fruktur|Fugaz+One|GFS+Didot|GFS+Neohellenic|Gabriela|Gafata|Galada|Galdeano|Galindo|Gentium+Basic|Gentium+Book+Basic|Geo|Geostar|Geostar+Fill|Germania+One|Gidugu|Gilda+Display|Give+You+Glory|Glass+Antiqua|Glegoo|Gloria+Hallelujah|Goblin+One|Gochi+Hand|Gorditas|Goudy+Bookletter+1911|Graduate|Grand+Hotel|Gravitas+One|Great+Vibes|Griffy|Gruppo|Gudea|Gurajada|Habibi|Halant|Hammersmith+One|Hanalei|Hanalei+Fill|Handlee|Hanuman|Happy+Monkey|Harmattan|Headland+One|Heebo|Henny+Penny|Herr+Von+Muellerhoff|Hind|Hind+Guntur|Hind+Madurai|Hind+Siliguri|Hind+Vadodara|Holtwood+One+SC|Homemade+Apple|Homenaje|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Iceberg|Iceland|Imprima|Inconsolata|Inder|Indie+Flower|Inika|Inknut+Antiqua|Irish+Grover|Istok+Web|Italiana|Italianno|Itim|Jacques+Francois|Jacques+Francois+Shadow|Jaldi|Jim+Nightshade|Jockey+One|Jolly+Lodger|Jomhuria|Josefin+Sans|Josefin+Slab|Joti+One|Judson|Julee|Julius+Sans+One|Junge|Jura|Just+Another+Hand|Just+Me+Again+Down+Here|Kadwa|Kalam|Kameron|Kanit|Kantumruy|Karla|Karma|Katibeh|Kaushan+Script|Kavivanar|Kavoon|Kdam+Thmor|Keania+One|Kelly+Slab|Kenia|Khand|Khmer|Khula|Kite+One|Knewave|Kotta+One|Koulen|Kranky|Kreon|Kristi|Krona+One|Kumar+One|Kumar+One+Outline|Kurale|La+Belle+Aurore|Laila|Lakki+Reddy|Lalezar|Lancelot|Lateef|Lato|League+Script|Leckerli+One|Ledger|Lekton|Lemon|Lemonada|Libre+Baskerville|Libre+Franklin|Life+Savers|Lilita+One|Lily+Script+One|Limelight|Linden+Hill|Lobster|Lobster+Two|Londrina+Outline|Londrina+Shadow|Londrina+Sketch|Londrina+Solid|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Lovers+Quarrel|Luckiest+Guy|Lusitana|Lustria|Macondo|Macondo+Swash+Caps|Mada|Magra|Maiden+Orange|Maitree|Mako|Mallanna|Mandali|Marcellus|Marcellus+SC|Marck+Script|Margarine|Marko+One|Marmelad|Martel|Martel+Sans|Marvel|Mate|Mate+SC|Maven+Pro|McLaren|Meddon|MedievalSharp|Medula+One|Meera+Inimai|Megrim|Meie+Script|Merienda|Merienda+One|Merriweather|Merriweather+Sans|Metal|Metal+Mania|Metamorphous|Metrophobic|Michroma|Milonga|Miltonian|Miltonian+Tattoo|Miniver|Miriam+Libre|Mirza|Miss+Fajardose|Mitr|Modak|Modern+Antiqua|Mogra|Molengo|Molle|Monda|Monofett|Monoton|Monsieur+La+Doulaise|Montaga|Montez|Montserrat|Montserrat+Alternates|Montserrat+Subrayada|Moul|Moulpali|Mountains+of+Christmas|Mouse+Memoirs|Mr+Bedfort|Mr+Dafoe|Mr+De+Haviland|Mrs+Saint+Delafield|Mrs+Sheppards|Mukta+Vaani|Muli|Mystery+Quest|NTR|Neucha|Neuton|New+Rocker|News+Cycle|Niconne|Nixie+One|Nobile|Nokora|Norican|Nosifer|Nothing+You+Could+Do|Noticia+Text|Noto+Sans|Noto+Serif|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Numans|Nunito|Odor+Mean+Chey|Offside|Old+Standard+TT|Oldenburg|Oleo+Script|Oleo+Script+Swash+Caps|Open+Sans|Open+Sans+Condensed|Oranienbaum|Orbitron|Oregano|Orienta|Original+Surfer|Oswald|Over+the+Rainbow|Overlock|Overlock+SC|Ovo|Oxygen|Oxygen+Mono|PT+Mono|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|PT+Serif|PT+Serif+Caption|Pacifico|Palanquin|Palanquin+Dark|Paprika|Parisienne|Passero+One|Passion+One|Pathway+Gothic+One|Patrick+Hand|Patrick+Hand+SC|Pattaya|Patua+One|Pavanam|Paytone+One|Peddana|Peralta|Permanent+Marker|Petit+Formal+Script|Petrona|Philosopher|Piedra|Pinyon+Script|Pirata+One|Plaster|Play|Playball|Playfair+Display|Playfair+Display+SC|Podkova|Poiret+One|Poller+One|Poly|Pompiere|Pontano+Sans|Poppins|Port+Lligat+Sans|Port+Lligat+Slab|Pragati+Narrow|Prata|Preahvihear|Press+Start+2P|Pridi|Princess+Sofia|Prociono|Prompt|Prosto+One|Proza+Libre|Puritan|Purple+Purse|Quando|Quantico|Quattrocento|Quattrocento+Sans|Questrial|Quicksand|Quintessential|Qwigley|Racing+Sans+One|Radley|Rajdhani|Rakkas|Raleway|Raleway+Dots|Ramabhadra|Ramaraja|Rambla|Rammetto+One|Ranchers|Rancho|Ranga|Rasa|Rationale|Redressed|Reem+Kufi|Reenie+Beanie|Revalia|Rhodium+Libre|Ribeye|Ribeye+Marrow|Righteous|Risque|Roboto|Roboto+Condensed|Roboto+Mono|Roboto+Slab|Rochester|Rock+Salt|Rokkitt|Romanesco|Ropa+Sans|Rosario|Rosarivo|Rouge+Script|Rozha+One|Rubik|Rubik+Mono+One|Rubik+One|Ruda|Rufina|Ruge+Boogie|Ruluko|Rum+Raisin|Ruslan+Display|Russo+One+=>+Russo+One|Ruthie|Rye|Sacramento|Sahitya|Sail|Salsa|Sanchez|Sancreek|Sansita+One|Sarala|Sarina|Sarpanch|Satisfy|Scada|Scheherazade|Schoolbell|Scope+One|Seaweed+Script|Secular+One|Sevillana|Seymour+One|Shadows+Into+Light|Shadows+Into+Light+Two|Shanti|Share|Share+Tech|Share+Tech+Mono|Shojumaru|Short+Stack|Shrikhand|Siemreap|Sigmar+One|Signika|Signika+Negative|Simonetta|Sintony|Sirin+Stencil|Six+Caps|Skranji|Slabo+13px|Slabo+27px|Slackey|Smokum|Smythe|Sniglet|Snippet|Snowburst+One|Sofadi+One|Sofia|Sonsie+One|Sorts+Mill+Goudy|Source+Code+Pro|Source+Sans+Pro|Source+Serif+Pro|Space+Mono|Special+Elite|Spicy+Rice|Spinnaker|Spirax|Squada+One|Sree+Krushnadevaraya|Sriracha|Stalemate|Stalinist+One|Stardos+Stencil|Stint+Ultra+Condensed|Stint+Ultra+Expanded|Stoke|Strait|Sue+Ellen+Francisco|Suez+One|Sumana|Sunshiney|Supermercado+One|Sura|Suranna|Suravaram|Suwannaphum|Swanky+and+Moo+Moo|Syncopate|Tangerine|Taprom|Tauri|Taviraj|Teko|Telex|Tenali+Ramakrishna|Tenor+Sans|Text+Me+One|The+Girl+Next+Door|Tienne|Tillana|Timmana|Tinos|Titan+One|Titillium+Web|Trade+Winds|Trirong|Trocchi|Trochut|Trykker|Tulpen+One|Ubuntu|Ubuntu+Condensed|Ubuntu+Mono|Ultra|Uncial+Antiqua|Underdog|Unica+One|UnifrakturCook|UnifrakturMaguntia|Unkempt|Unlock|Unna|VT323|Vampiro+One|Varela|Varela+Round|Vast+Shadow|Vesper+Libre|Vibur|Vidaloka|Viga|Voces|Volkhov|Vollkorn|Voltaire|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Warnes|Wellfleet|Wendy+One|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yantramanav|Yatra+One|Yellowtail|Yeseva+One|Yesteryear|Yrsa|Zeyada');</style>
    <?php
}

// add_action( 'wp_head', 'load_all_fonts' );

function load_wp_fonts_local() {
    ?>
    <style class='wp-fonts-local'>
        @font-face {
            font-family: Inter;
            font-style: normal;
            font-weight: 400;
            font-display: fallback;
            src: url('https://staging.ut-lawyer.de/wp-content/uploads/fonts/UcCO3FwrK3iLTeHuS_nVMrMxCp50SjIw2boKoduKmMEVuLyfMZ1rib2Bg-4.woff2') format('woff2');
        }

        @font-face {
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            font-display: fallback;
            src: url('https://staging.ut-lawyer.de/wp-content/uploads/fonts/UcCO3FwrK3iLTeHuS_nVMrMxCp50SjIw2boKoduKmMEVuGKYMZ1rib2Bg-4.woff2') format('woff2');
        }

        @font-face {
            font-family: Inter;
            font-style: normal;
            font-weight: 500;
            font-display: fallback;
            src: url('https://staging.ut-lawyer.de/wp-content/uploads/fonts/UcCO3FwrK3iLTeHuS_nVMrMxCp50SjIw2boKoduKmMEVuI6fMZ1rib2Bg-4.woff2') format('woff2');
        }
    </style>
    <?php
}

// add_action( 'wp_head', 'load_wp_fonts_local' );

function load_fontawesome() {
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <?php
}

//add_action( 'wp_head', 'load_fontawesome' );

function load_analytics() {
    ?>
    <script async src="https://www.google-analytics.com/analytics.js"></script>
    <?php
}

//add_action( 'wp_head', 'load_analytics' );

function load_protocol_relative_bootstrap() {
    ?>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
    <?php
}

//add_action( 'wp_head', 'load_protocol_relative_bootstrap' );

function load_base64_encoded_script() {
    ?>
    <script src="data:text/javascript;base64,dmFyIHggPSAxOyBjb25zb2xlLmxvZyh4KTs="></script>
    <?php
}

//add_action( 'wp_head', 'load_base64_encoded_script' );

function load_ionicicons() {
    ?>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/fonts/ionicons.ttf?v=2.0.1"/>
    <?php
}

//add_action( 'wp_head', 'load_ionicicons' );

function load_usercentrics() {
    ?>
    <script src="https://app.usercentrics.eu/browser-ui/latest/loader.js" async></script>
    <?php
}

//add_action( 'wp_head', 'load_usercentrics' );

function load_inline_bunnycdn_import_statement() {
    ?>
    <style class="tve_custom_style">@import url(//fonts.bunny.net/css?family=Open+Sans:400,500,700,800,300,600&subset=latin);

        @media (min-width: 300px) {
            [data-css="tve-u-16ac68ee35b"] {min-width: 100%;min-height: 165px !important}

            [data-css="tve-u-16ac68ef5af"] {margin-top: -23px !important;margin-bottom: 0px !important;padding-bottom: 51px !important}

            [data-css="tve-u-16ac68fa786"] {background-image: linear-gradient(rgb(255 255 255 / .96), rgb(255 255 255 / .96)) !important;background-size: auto !important;background-position: 50% 50% !important;background-attachment: scroll !important;background-repeat: no-repeat !important;--background-image: linear-gradient(rgba(255, 255, 255, 0.96), rgba(255, 255, 255, 0.96)) !important;--background-size: auto !important;--background-position: 50% 50% !important;--background-attachment: scroll !important;--background-repeat: no-repeat !important;--tve-applied-background-image: linear-gradient(rgba(255, 255, 255, 0.96), rgba(255, 255, 255, 0.96)) !important}

            [data-css="tve-u-16ac68ff296"] {width: 2000px;float: none;display: inline-block;margin: 25px auto 17px !important;padding-bottom: 0px !important;padding-top: 0px !important}

            [data-css="tve-u-16ac68ef5af"] .tve-page-section-in {display: block}

            [data-css="tve-u-1602adc6335"] {padding: 1px 0px !important;margin: 0px !important}
        }
    </style>
    <?php
}

//add_action( 'wp_head', 'load_inline_bunnycdn_import_statement' );
