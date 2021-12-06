<?php

namespace Hotspot\Controllers;

use Hotspot\Models\SurferEventModel;
use WP_Query;

class SurferController extends CoreController
{



    public function getProfile()
    {
        $query = new WP_Query([
            'author' => get_current_user_id(),
            'post_type' => 'surfer-profile'

        ]);

        $profile = $query->post;

        return $profile;
    }

    public function home()
    {
        $this->show('views/surfer-home.view');
    }

    public function levels()
    {
        // récupération de l'utilisateur courant
        $currentUser = wp_get_current_user();
        $userId = $currentUser->ID;

        // nous devons récupérer toutes les lignes correspondant au niveau de maitrise de l'utilisateur courant
        $surferEventModel = new SurferEventModel();
        $surfersLevels = $surferEventModel->getBySurferId($userId);

        $this->show('views/surfer-levels.view', [
            'surferLevels' => $surfersLevels
        ]);
    }

    public function confirmDeleteAccount()
    {

        // si l'utilisateur n'est pas connecté, nous affichons une page d'erreur avec l'entête http "forbidden"
        if(!$this->isConnected()) {



            header("HTTP/1.1 403 Forbidden");
            // BONUS il es possible de faire http_response_code(403);
            $this->show('views/surfer-forbidden');
        }
        else {
            $this->show('views/surfer-confirm-delete-account.view');
        }
    }


    public function updateForm()
    {

        // si l'utilisateur n'est pas connecté, nous affichons une page d'erreur avec l'entête http "forbidden"
        if(!$this->isConnected()) {


            // BONUS E10 header il est possible de faire
            header("HTTP/1.1 403 Forbidden"); // équivalent à http_response_code(403);


            $this->show('views/surfer-forbidden');
        }
        else {


            $profile = $this->getProfile();

            $this->show('views/surfer-update-form.view', [
                'profile' => $profile
            ]);
        }
    }

    public function updateLevel()
    {

        // Récupération des données envoyées depuis le formulaire de selectection des niveaux de maitrise des différentes technologies

        // TODO vérifier la validité des données envoyées dans $technologiesLevels
        $technologiesLevels = $_POST['technologiesLevels'];

        // récupération de l'utilisateur courant
        $currentUser = wp_get_current_user();
        $userId = $currentUser->ID;

        // nous devons supprimer toutes les lignes de la table developer_technology pour l'utilisateur courant
        $surferEventModel = new SurferEventModel();
        $surferEventModel->deleteBySurferId($userId);

        // pour chaque technologies, association de la technologie à l'utilisateur

        foreach($technologiesLevels as $termId => $level) {
            $surferEventModel->insert(
                $userId,
                $termId,
                $level
            );
        }

        // redirection vers la page de gestion des compétences
        global $router;
        $skillURL = $router->generate('surfer-skills');

        header('Location: ' . $skillURL);
    }

    public function participateToProject($eventId)
    {
        // TODO vérifier que l'utilisateur est connecté et qu'il a le rôle developer

        $model = new SurferEventModel();
        $user = wp_get_current_user();
        $userId = $user->ID;
        

        $model->insert(
            $userId,
            $eventId
        );

        $url = get_post_type_archive_link('project');
        header('Location: ' . $url);
    }

    public function leaveProject($projectId)
    {
        $model = new SurferEventModel();
        $user = wp_get_current_user();
        $userId = $user->ID;

        $model->delete($projectId, $userId);

        $url = get_post_type_archive_link('project');
        header('Location: ' . $url);
    }
}
