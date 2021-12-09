<?php
// Configuration du thème

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

        wp_enqueue_script(
            'three', // nom du script
            'https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js',
            [],
            THEME_VERSION,
            true
        );

        wp_enqueue_script(
            'vanta', // nom du script
            'https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js',
            [],
            THEME_VERSION,
            true
        );

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

function handleAddSpotForm() {

    if (isset($_POST['addSpot'])) {
        
         if (wp_verify_nonce($_POST['coucou'], 'jean')) {

            extract($_POST['addSpot']);

            $name = filter_var($name, FILTER_SANITIZE_STRING);
            $address = filter_var($address, FILTER_SANITIZE_STRING);
            $levelId = filter_var($levelId, FILTER_VALIDATE_INT);
            $city = filter_var($city, FILTER_SANITIZE_STRING);
            $zipcode = filter_var($zipcode, FILTER_VALIDATE_INT);
            $departementId = filter_var($departementId, FILTER_VALIDATE_INT);
            // $picture_upload = filter_var($picture_upload, FILTER_SANITIZE_URL);
            $description = filter_var($description, FILTER_SANITIZE_STRING);
            $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

            // Gestion des erreurs
            $errorMessages = [];

            if (empty($name)) {
                $errorMessages[] = "Vous n'avez pas donné de nom à votre Spot";
            }
            if (empty($levelId) || $levelId === false) {
                $errorMessages[] = 'Veuillez renseigner la difficulté du Spot';
            }
            
            if (empty($departementId) || $departementId === false) {
                $errorMessages[] = 'Veuillez renseigner le département du Spot';
            }

            // Envoi du nouveau spot
            if (empty($errorMessages)) {
                $data = ['post_author' => get_current_user_id(),
                        'post_title' => $name,
                        'post_type' => 'spot',
                        'post_content' => $description,
                        'post_status' => 'publish',
                        'meta_input'   => array(
                            'city' => $city,
                            'address'   => $address,
                            'latitude'   => $latitude,
                            'longitude'   => $longitude,
                            'zipcode'   => $zipcode,
                        ),
                    ];
                $postId = wp_insert_post($data);
                wp_set_object_terms( $postId, array( $levelId ), 'level' );
                wp_set_object_terms( $postId, array( $departementId ), 'departement' );

                if(!empty($_FILES)){
                    require_once( ABSPATH . 'wp-admin/includes/post.php' );
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                
                    // upload image dans la librairie
                    $file = $_FILES['picture_upload'];
    
                    $_FILES = array("upload_file" => $file);
                    $attachment_id = media_handle_upload("upload_file", $postId);
    
                    if (is_wp_error($attachment_id)) {
                        // There was an error uploading the image.
                        $errorMessages[] = "Error adding file";

                        foreach ($errorMessages as $message) {
                            echo "<div class='container alert alert-danger' role='alert'>$message</div>";
                          }
                        
                    } else {
                        // The image was uploaded successfully!
                        // lier l'image et le nouveau post en thumbnail
                        
                        set_post_thumbnail( $postId, $attachment_id );
                    }
                    
                    
                }
            } else {
                foreach ($errorMessages as $message) {

                    echo "<br/><div class='container alert alert-danger' role='alert'>$message</div>";

                  }
            }

            
         }
    }
    
}


// gestion du formulaire d'ajout de spot
add_action(
    'template_redirect', 
    'handleAddSpotForm'
);