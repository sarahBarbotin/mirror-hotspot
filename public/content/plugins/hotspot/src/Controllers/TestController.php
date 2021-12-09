<?php

namespace Hotspot\Controllers;

use Hotspot\Models\SurferEventModel;

class TestController extends CoreController
{

    public function test()
    {
        $this->show('views/test.view');
    }


    public function createSurferEventTable()
    {
        $SurferEventModel = new SurferEventModel();
        $SurferEventModel->createTable();

    }

    // STEP E11 INSERT insertion dans la table developer_technology
    public function insertIntoSurferEventTable()
    {
        // Récupération de l'utilisateur courrant
        $user = wp_get_current_user();

        // Récupération de l'id de l'utilisateur
        $userId = $user->ID;


        // STEP E11 TERM select by slug
        // DOC E11 get_term_by https://developer.wordpress.org/reference/functions/get_term_by/
        $term = get_term_by('departement', 'event_discipline', 'level');

        // si l'object retourné à bien une propriété term_id
        if(isset($term->term_id)) {
            $termId = $term->term_id;

            $surferEventModel = new SurferEventModel();

            $surferEventModel->insert(
                $userId,
                $termId,
                3
            );

            echo '<div style="border: solid 2px #F00">';
                echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
                echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
                print_r('INSERT into surfer_event_participation table');
                echo '</pre>';
            echo '</div>';
        }
    }

    // STEP E11 SELECT dans la table surfer_event_participation
    public function selectByDeveloperId()
    {

        $user = wp_get_current_user();
        $userId = $user->ID;

        $surferEventModel = new SurferEventModel();
        $rows = $surferEventModel->getBySurferId($userId);

        echo '<div style="border: solid 2px #F00">';
            echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
            print_r($rows);
            echo '</pre>';
        echo '</div>';
    }

    public function selectByDeveloperIdAndTechnologyId()
    {
        $user = wp_get_current_user();
        $userId = $user->ID;

        $term = get_term_by('slug', 'php', 'technology');


        if(isset($term->term_id)) {
            $developerTechnologyModel = new DeveloperTechnologyModel();
            $rows = $developerTechnologyModel->getByDeveloperIdAndTechnologyId(
                $userId,
                $term->term_id
            );

            echo '<div style="border: solid 2px #F00">';
                echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
                echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
                print_r($rows);
                echo '</pre>';
            echo '</div>';
        }
    }

    public function selectByVariableDeveloperId($developerId)
    {

        $developerTechnologyModel = new DeveloperTechnologyModel();
        $rows = $developerTechnologyModel->getByDeveloperId(
            $developerId
        );

        echo '<div style="border: solid 2px #F00">';
            echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
            print_r($rows);
            echo '</pre>';
        echo '</div>';
    }

    public function insertDynamic($developerId, $term, $level)
    {

        $term = get_term_by('slug', $term, 'technology');

        // si l'object retourné à bien une propriété term_id
        if(isset($term->term_id)) {
            $termId = $term->term_id;

            $developerTechnologyModel = new DeveloperTechnologyModel();

            $developerTechnologyModel->insert(
                $developerId,
                $termId,
                $level
                );

            echo '<div style="border: solid 2px #F00">';
                echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
                echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
                print_r('INSERT into developer_technology table');
                echo '</pre>';
            echo '</div>';
        }
    }

    public function insertIntoProjectDeveloper($projectId, $developerId)
    {
        $model = new ProjectDeveloperModel();
        $model->insert($projectId, $developerId);
        echo '<div style="border: solid 2px #F00">';
            echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
            print_r("INSERT INTO project_developer");
            echo '</pre>';
        echo '</div>';
    }

    public function update($projectId, $developerId)
    {
        $model = new ProjectDeveloperModel();
        $model->updateDateByProjectIdAndDeveloperId($projectId, $developerId);
        echo '<div style="border: solid 2px #F00">';
            echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
            print_r("UPDATE INTO project_developer");
            echo '</pre>';
        echo '</div>';
    }

}
