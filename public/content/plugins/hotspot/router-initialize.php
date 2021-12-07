<?php
// STEP E9 Router Initialisation du router

// déclaration du router. Nous allons avoir besoin de ce router dans de nombreux fichier. Ce n'est pas propre mais pour des raisons de simplicité de code ; nous déclarons ce router comme étant une variable globale

use Hotspot\Controllers\SurferController;
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
    '/surfer/dashboard/', // url a surveiller
    function() {
        $surferController = new SurferController();
        $surferController->getProfile();
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
    'GET,POST',
    '/surfer/update-form/',
    function() {
        $surferController = new SurferController();
        $surferController->updateForm();
    },
    'surfer-update-form'
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
