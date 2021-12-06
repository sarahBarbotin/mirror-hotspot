<?php

namespace Hotspot;

class RoleManager
{
    public function __construct()
    {

    }


    public function deleteSurferRole()
    {
        // il serait possible de pourvoir rajouter des traitement ici lorsque l'on supprime le role developer
        remove_role('surfer');
    }
    


    public function createSurferRole()
    {
        // STEP ROLE création d'un rôle
        // DOC add_role https://developer.wordpress.org/reference/functions/add_role/
        add_role(
            'surfer',    // idenfiant du rôle
            'Surfeur',   // Libéllé du rôle

            // Liste des "capabilities" (droits) accordés au rôle "surfer"
            [
                // Cette capability est supprimée manuellement en dessous
                'delete_surfer-profiles' => false,
                'delete_others_surfer-profiles' => false,
                'delete_private_surfer-profiles' => false,
                'delete_published_surfer-profiles' => true,
                'edit_surfer-profiles' => false,
                'edit_others_surfer-profiles' => false,
                'edit_private_surfer-profiles' => false,
                'edit_published_surfer-profiles' => true,
                'publish_surfer-profiles' => false,
                'read_private_surfer-profiles' => true,
            ]
        );
    }

    // cette méthode va nous permettre de donner tous les droits sur un type de post custom à un role
    public function giveAllCapabilitiesOnCPT($cptName, $role)
    {

        // récupération du rôle passé en paramètre
        // DOC get_role https://developer.wordpress.org/reference/functions/get_role/
        $role = get_role($role);

        // on ajoute chacune des capabilties au rôle choisi
        $capabilities = [
            'delete_' . $cptName . 's',
            'delete_others_' . $cptName . 's',
            'delete_private_' . $cptName . 's',
            'delete_published_' . $cptName . 's',
            'edit_' . $cptName . 's',
            'edit_others_' . $cptName . 's',
            'edit_private_' . $cptName . 's',
            'edit_published_' . $cptName . 's',
            'publish_' . $cptName . 's',
            'read_private_' . $cptName . 's',
        ];

        foreach($capabilities as $capability) {
            $role->add_cap($capability);
        }
    }
}
