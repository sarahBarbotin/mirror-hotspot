<?php

namespace Hotspot\CustomPostType;


class SurferProfile
{
    public function __construct()
    {
        register_post_type(
            'surfer-profile', // identifiant du custom post type
            [
                'label' => 'Surfer Profile',
                'show_in_rest' => true,

                // le "articles" de type "event" sont administrable depuis le backoffice de wordpress
                'public' => true,

                // Le type "Event" n'a pas "d'enfants" ; ce choix est arbitraire (pour des questions de simplicité)
                'hierarchical' => false,

                // icone qui s'affiche dans l'interface d'administration de wordpress
                'menu_icon' => 'dashicons-id',

                // nécessaire pour activer les pages archives sur le cpt
                'has_archive' => true,


                // les fonctionnalités activé sur notre type de contenu custom
                'supports' => [
                    'title',
                    'excerpt',
                    'thumbnail',
                    'editor',
                    'author',
                ],
                // ACL : Access Control List
                'capability_type' => 'surfer-profile',
                'map_meta_cap' => true,
            ]
        );
    }
}

