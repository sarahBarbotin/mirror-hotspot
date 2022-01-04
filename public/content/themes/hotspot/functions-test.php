<?php
// Configuration du thème
use Hotspot\Controllers\SpotController;
// require __DIR__ . '/customizers/banner-picture.php';

// BONUS utilisation d'une constante. Attention les constantes ont une portée globale
if(!defined('THEME_VERSION')) {
    define('THEME_VERSION', '1.0.0');
}


add_action(
    'after_setup_theme', // nom de l'event
    'hotspot_initializeTheme'
);

if (!function_exists('hotspot_initializeTheme')) {
    function hotspot_initializeTheme()
    {
        // DOC add_theme_support : https://developer.wordpress.org/reference/functions/add_theme_support/
        // nous laissons wordpress gérer la balise <title> de notre thème
        add_theme_support('title-tag');

        // les posts de notre thème peuvent avoir une image de mise en avant
        add_theme_support('post-thumbnails');

        // le thème peut gérer des menus
        add_theme_support('menus');
    }
}

if (!function_exists('hotspot_loadAssets')) {
    // chargement des css/js duy thème
    function hotspot_loadAssets()
    {
        // liste des fichier css à charger
        
        $css = [];
        $css[] = "assets/css/bootstrap.min.css";
        $css[] = "assets/css/animate.css";
        $css[] = "assets/css/owl.carousel.min.css";
        $css[] = "assets/css/themify-icons.css";
        $css[] = "assets/css/flaticon.css";
        $css[] = "assets/fontawesome/css/all.min.css";
        $css[] = "assets/css/magnific-popup.css";
        $css[] = "assets/css/gijgo.min.css";
        $css[] = "assets/css/nice-select.css";
        $css[] = "assets/css/slick.css";
        $css[] = "assets/css/style.css";

        foreach($css as $index => $path) {
            wp_enqueue_style(
                'hotspot-styles-' . $index, // identifiant de notre fichier css
                // wordpress nous calcule le chemin vers le fichier assets/css/style.css
                get_theme_file_uri($path)
            );
        }

        // wp_enqueue_style(
        //     'google-font',
        //     'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap'
        // );

        // wp_enqueue_script(
        //     'three', // nom du script
        //     'https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js',
        //     [],
        //     THEME_VERSION,
        //     true
        // );

        // wp_enqueue_script(
        //     'vanta', // nom du script
        //     'https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js',
        //     [],
        //     THEME_VERSION,
        //     true
        // );

        $javascripts = [
            "assets/js/jquery-1.12.1.min.js",
            "assets/js/popper.min.js",
            "assets/js/bootstrap.min.js",
            "assets/js/jquery.magnific-popup.js",
            "assets/js/owl.carousel.min.js",

            "assets/js/masonry.pkgd.js",
            "assets/js/jquery.nice-select.min.js",
            "assets/js/gijgo.min.js",
            "assets/js/jquery.ajaxchimp.min.js",
            "assets/js/jquery.form.js",
            "assets/js/jquery.validate.min.js",
            "assets/js/mail-script.js",
            "assets/js/contact.js",
            "assets/js/custom.js",
            
        ];

        foreach($javascripts as $index => $path) {
            // DOC wp_enqueue_script https://developer.wordpress.org/reference/functions/wp_enqueue_script/
            wp_enqueue_script(
                'hotspot-js-' . $index, // nom du script
                get_theme_file_uri($path),
                [], // category.js n'a pas besoin d'autre javascript pour fonctionner
                THEME_VERSION, // version de notre javascript
                true // la balise script sera injectée dans le footer
            );
        }


        
        // Map

        //? css dans le header.php pour le moment
        // Load the theme stylesheets
        // function theme_styles_map()  
        // { 
        //     wp_register_style( 'leafletcss', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css',array(), '3.3.1', true );


        //     wp_enqueue_style('leafletcss');
        //     wp_style_add_data('leafletcss',array( 'integrity', 'crossorigin' ) , array( 'sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==', 'anonymous' ));

        // }
        // add_action('wp_enqueue_scripts', 'theme_styles_map');

        wp_register_script('leafletjs', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), '3.3.1', true); // jQuery v3
        wp_enqueue_script('leafletjs');
        wp_script_add_data( 'leafletjs', array( 'integrity', 'crossorigin' ) , array( 'sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==', 'anonymous' ) );

        // wp_enqueue_script(
        //     'google-map', // nom du script
        //     'https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA',
        //     [],
        //     THEME_VERSION,
        //     true
        // );

    }
}

// chargement des assets du thème
add_action(
    'wp_enqueue_scripts', // event pour charger nos assets
    'hotspot_loadAssets'
);

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

/**
 * Generate breadcrumbs
 * @author CodexWorld
 * @authorURL www.codexworld.com
 */
function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                if (get_post_type(get_the_ID()) === 'event') {
                    
                    echo ("Liste des évènements");
                    echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
                }
                elseif (get_post_type(get_the_ID()) === 'spot') {
                    
                    echo ("Liste des spots");
                    echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
                }
                the_title();
            }
    } elseif (is_post_type_archive( 'event' )) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo ("Liste des évènement");
    } elseif (is_post_type_archive( 'spot' )) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo ("Liste des spots");
    }  elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    }  elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}
