<?php
// STEP E9 Router Initialisation du router

// déclaration du router. Nous allons avoir besoin de ce router dans de nombreux fichier. Ce n'est pas propre mais pour des raisons de simplicité de code ; nous déclarons ce router comme étant une variable globale


global $router;


// instanciation du router
$router = new AltoRouter();
// dirname permet de supprimer le nom de fichier dans une chaine de caractère contenant un "chemin fichier"
$baseURI = dirname($_SERVER['SCRIPT_NAME']);

// configuration de l'url racine de notre site aurpès d'altorouter
$router->setBasePath($baseURI);

// configuration des routes



