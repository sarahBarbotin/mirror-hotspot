<?php

namespace Hotspot;

use Hotspot\Models\SurferEventModel;
use Hotspot\CustomPostType\Spot;
use Hotspot\CustomPostType\Event;
use Hotspot\CustomPostType\SurferProfile;
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
     * Propriété gérant le custom post type Event
     *
     * @var Event
     */
    protected $eventCPT;

    /**
     * Propriété gérant le custom post type SurferProfile
     *
     * @var SurferProfile
     */
    protected $surferProfileCPT;
    


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
     * @var EventDiscipline;
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

        /**
     * Configuration du router wordpress
     *
     * @var WordpressRouter
     */
    protected $wordpressRouter;

     /**
     * @var UserRegistration
     */
    protected $userRegistration;

        /**
     *
     * @var CustomFields
     */
    protected $customFields;


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
        $this->surferProfileCPT = new SurferProfile();

        // enregistrement des taxonomies custom
        $this->levelTaxonomy = new Level();
        $this->departementTaxonomy = new Departement();
        $this->eventDisciplineTaxonomy = new EventDiscipline();

        
        // enregistrement du gestionnaire de roles
        $this->roleManager = new RoleManager();

        // Gestion du formulaire d'inscription
        $this->userRegistration = new UserRegistration();

        // chargement du router wordpress
        $this->wordpressRouter = new WordpressRouter();

        // chargement des custom fields acf à activer lorsque ACF sera configuré
        //$this->customFields = new CustomFields();

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
        $this->roleManager->giveAllCapabilitiesOnCPT('surfer-profile', 'administrator');

        // création des rôles custom de notre plugin
        $this->roleManager->createSurferRole();

        //création de la table custom hs_surfer_event_participation
        $this->surferEventModel->createTable();
    }

    // déclénché lors de la désactivation du plugin
    public function deactivate()
    {
        $this->initialize();
    }
}
