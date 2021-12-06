<?php

namespace Hotspot\CustomPostType;

class Spot 
{

    public function __construct()
    {
        register_post_type(
            'spot', // identifiant du CPT
            [
                'label'=> 'Spot',
                'show_in_rest' => true,

                // administrable depuis le backoffice de wordpress
                'public' => true,

                // Le type "Spot" n'a pas "d'enfants" ; ce choix est arbitraire (pour des questions de simplicité)
                'hierarchical' => false,

                // icone qui s'affiche dans l'interface d'administration de wordpress
                'menu_icon' => 'dashicons-star-filled',

                'has_archive' => true,

                // les fonctionnalités activé sur notre type de contenu custom
                // NOTICE PLUGIN, fonctionnalités activable pour un cpt :  ‘title’, ‘editor’, ‘comments’, ‘revisions’, ‘trackbacks’, ‘author’, ‘excerpt’, ‘page-attributes’, ‘thumbnail’, ‘custom-fields’, and ‘post-formats’.
                'supports' => [
                    'title',
                    'excerpt',
                    'thumbnail',
                    'editor',
                    'author',
                ],
                // ACL : Access Control List
                'capability_type' => 'spot',
                'map_meta_cap' => true,
        
            ]
        );
        
    }

}