<?php
// STEP E9 Router Initialisation du router

// déclaration du router. Nous allons avoir besoin de ce router dans de nombreux fichier. Ce n'est pas propre mais pour des raisons de simplicité de code ; nous déclarons ce router comme étant une variable globale

use Hotspot\Controllers\SurferController;
use Hotspot\Controllers\SpotController;
use Hotspot\Controllers\EventController;
use Hotspot\Controllers\TestController;

global $router;


// instanciation du router
$router = new AltoRouter();
// dirname permet de supprimer le nom de fichier dans une chaine de caractère contenant un "chemin fichier"
$baseURI = dirname($_SERVER['SCRIPT_NAME']);

// configuration de l'url racine de notre site aurpès d'altorouter
$router->setBasePath($baseURI);

// configuration des routes

$router->map(
    'GET', // surveille les appels HTTP de type GET
    '/surfer/my-profile/', // url a surveiller
    function() {
        $surferController = new SurferController();
        $surferController->home();
    },
    'surfer-home'
);


$router->map(
    'GET',
    '/surfer/confirm-delete-account/',
    function() {
        $surferController = new SurferController();
        $surferController->confirmDeleteAccount();
    },
    'surfer-confirm-delete-account'
);

$router->map(
    'GET',
    '/surfer/event-update-form/[i:eventId]/',
    function($eventId) {
        $eventController = new EventController();
        $eventController->update($eventId);
    },
    'event-update-form'
);

$router->map(
    'POST',
    '/surfer/event-update-form/[i:eventId]/',
    function($eventId) {
        $eventController = new EventController();
        $eventController->handleUpdateEventForm($eventId);
    },
    'event-update-post'
);

$router->map(
    'GET',
    '/surfer/event-confirm-delete/[i:eventId]/',
    function($eventId) {
        $eventController = new EventController();
        $eventController->handleEventConfirmDelete($eventId);
    },
    'event-confirm-delete'
);

$router->map(
    'POST',
    '/surfer/event-confirm-delete/[i:eventId]/',
    function($eventId) {
        $eventController = new EventController();
        $eventController->handleEventDelete($eventId);
    },
    'event-delete-post'
);


// ===========================================================
// Routes pour tester nos modèles
// ===========================================================
$router->map(
    'GET',
    '/model-tests/test/',
    function() {
        $testController = new TestController();
        $testController->test();
    },
    'model-tests-test'
);

//Participation
$router->map(
    'GET',
    '/surfer/event/participate/[i:eventId]/',
    function($eventId) {

        $userController = new SurferController();
        $userController->participateToEvent($eventId);

    },
    'surfer-event-participate'
);

$router->map(
    'GET',
    '/surfer/event/leave/[i:eventId]/',
    function($eventId) {

        $userController = new SurferController();
        $userController->leaveEvent($eventId);

    },
    'surfer-event-leave'
);

// Profil User Update
$router->map(
    'GET',
    '/surfer/surfer-profile-update-form/[i:surferId]/',
    function($surferId) {
        $surferController = new SurferController();
        $surferController->updateForm($surferId);
    },
    'surfer-profile-update-form'
);

$router->map(
    'POST',
    '/surfer/surfer-profile-update-form/[i:surferId]/',
    function($surferId) {
        $surferController = new SurferController();
        $surferController->handleUpdateSurferProfileForm($surferId);
    },
    'surfer-profile-update-post'
);