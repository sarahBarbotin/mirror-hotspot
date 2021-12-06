<?php

namespace Hotspot;

use Hotspot\Models\SurferEventModel;
use Hotspot\CustomPostType\Spot;
use Hotspot\CustomPostType\Event;
use Hotspot\CustomTaxonomy\Level;
use Hotspot\CustomTaxonomy\Departement;
use Hotspot\CustomTaxonomy\EventDiscipline;

class Plugin
{

    // ===========================================================
    // CPT (custom post type)
    // ===========================================================

    /**
     * Propriété gérant le custom post type Spot
     *
     * @var Spot
     */
    protected $spotCPT;

    /**
     * Propriété gérant le custom post type Spot
     *
     * @var Event
     */
    protected $eventCPT;
    


    // ===========================================================
    // Custom taxonomies
    // ===========================================================

    /**
     * @var Level;
     */
    protected $levelTaxonomy;

    /**
     * @var Departement;
     */
    protected $departementTaxonomy;

    /**
     * @var Departement;
     */
    protected $eventDisciplineTaxonomy;


    // ===========================================================
    // Classes "utilitaires"
    // ===========================================================

 
    /**
     * Propriété gérant tous les traitements concernant les roôles
     *
     * @var RoleManager
     */
    protected $roleManager;

    // ===========================================================
    // Classes du modèle
    // ===========================================================

    /**
     * @var SurferEventModel;
     */
    protected $surferEventModel;

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
        // enregistrement des CPT
        $this->spotCPT = new Spot();
        $this->eventCPT = new Event();

        // enregistrement des taxonomies custom
        $this->levelTaxonomy = new Level();
        $this->departementTaxonomy = new Departement();
        $this->eventDisciplineTaxonomy = new EventDiscipline();

        
        // enregistrement du gestionnaire de roles
        $this->roleManager = new RoleManager();

        //instanciation d'un SurferEventModel
        $this->surferEventModel = new SurferEventModel;
        
    }

    // déclenché à l'activation du plugin
    public function activate()
    {
        // à l'activation du plugin, nous initialisons ce dernier
        $this->initialize();

        $this->roleManager->giveAllCapabilitiesOnCPT('event', 'administrator');
        $this->roleManager->giveAllCapabilitiesOnCPT('spot', 'administrator');

        //création de la table custom hs_surfer_event_participation
        $this->surferEventModel->createTable();
    }

    // déclénché lors de la désactivation du plugin
    public function deactivate()
    {
        $this->initialize();
    }
}
