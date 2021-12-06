<?php
/*
Plugin Name: Hotspot
*/

// STEP PLUGIN hotspot-cours.php : fichier de démarrage du plugin
// équivalent aux fichier style.css et functions.php d'un thème


// IMPORTANT PLUGIN ne pas oublier d'inclure l'autoload. Il faut préalablement avoir lancé la commande composer install DANS LE DOSSIER DU PLUGIN

use Hotspot\Plugin;

require __DIR__ .'/vendor-hotspot/autoload.php';

// STEP E9 ROUTER chargement du fichier d'initialisation du router custom
require __DIR__ .'/router-initialize.php';

// instanciation du plugin hotspot ; attention de ne pas oublier la directive "use"
$pluginHotspot = new Plugin();


// DOC WP PLUGININ activation "hook" : https://developer.wordpress.org/reference/functions/register_activation_hook/
// au moment de l'activation du plugin, nous demandons au plugin de lancer les traitements dont il a besoin
register_activation_hook(
    // premier argument, le chemin vers le fichier de déclaration du plugin
    __FILE__, // calcule le chemin absolu ver le fichier hotspot-cours.php
    // appel de la méthode activate sur l'objet $plugin
    // En js la syntaxe serait addEventListener('plugin-activate', pluginHotspot.activate);
    [$pluginHotspot, 'activate']
 );


 register_deactivation_hook(
    __FILE__,
    [$pluginHotspot, 'deactivate']
 );

