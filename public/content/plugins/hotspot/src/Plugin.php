<?php

namespace Hotspot;

class Plugin
{

    // ===========================================================
    // CPT (custom post type)
    // ===========================================================

    /**
     * Propriété gérant le custom post type DeveloperProfile
     *
     * @var DeveloperProfile
     */

    


    // ===========================================================
    // Custom taxonomies
    // ===========================================================

    /**
     * @var ActivitySector;
     */


    // ===========================================================
    // Classes "utilitaires"
    // ===========================================================

 
    /**
     *
     * @var CustomFields
     */

    // ===========================================================
    // Classes du modèle
    // ===========================================================

    /**
     * @var DeveloperTechnologyModel;
     */


    // ===========================================================
    // ===========================================================





    public function __construct()
    {

        // nous demandons wordpress d'executer la méthode initialize lorsque l'event "init" (event de wordpress) se déclanchera

        add_action(
            'init',
            // équivalent en js objet.initialize();
            [$this, 'initialize']
        );
    }

    // cette méthode sera appellée lorsque le plugin oprofile sera chargé par wordpress
    public function initialize()
    {

    }

    // déclenché à l'activation du plugin
    public function activate()
    {
        // à l'activation du plugin, nous initialisons ce dernier
        $this->initialize();

    }

    // déclénché lors de la désactivation du plugin
    public function deactivate()
    {
        $this->initialize();
    }
}
