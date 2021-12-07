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
            'post_type' => 'surfer'

        ]);

        $profile = $query->post;

        return $profile;
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

    public function participateToEvent($eventId)
    {
        // TODO vérifier que l'utilisateur est connecté et qu'il a le rôle developer

        $model = new SurferEventModel();
        $user = wp_get_current_user();
        $userId = $user->ID;
        

        $model->insert(
            $userId,
            $eventId
        );

        $url = get_post_type_archive_link('event');
        header('Location: ' . $url);
    }

    public function leaveEvent($eventId)
    {
        $model = new SurferEventModel();
        $user = wp_get_current_user();
        $userId = $user->ID;

        $model->delete($eventId, $userId);

        $url = get_post_type_archive_link('event');
        header('Location: ' . $url);
    }
}
