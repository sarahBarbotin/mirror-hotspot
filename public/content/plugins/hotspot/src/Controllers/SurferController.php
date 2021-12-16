<?php

namespace Hotspot\Controllers;

use Hotspot\Models\SurferEventModel;
use WP_Query;

class SurferController extends CoreController
{

    public function __construct()
    {
        add_action(
            'template_redirect',
            [$this, 'handleUpdateSurferProfileForm']
        );

    }


    public function getProfile()
    {
        $query = new WP_Query([
            'author' => get_current_user_id(),
            'post_type' => 'surfer'

        ]);

        $profile = $query->post;

        return $profile;
    }

    public function home()
    {
        $this->show('views/surfer-home.view');
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
            //

            $this->show('views/surfer-update-form.view', [
                'profile' => $profile
            ]);
        }
    }

    public function handleUpdateSurferProfileForm($surferId)
    {
        
        if (isset($_POST['updateSurferProfile'])) {


            if (wp_verify_nonce($_POST['updateSurferForm'], 'updateSurferProfileToken')) {
                extract($_POST['updateSurferProfile']);


                $name = filter_var($name, FILTER_SANITIZE_STRING);
                $content = filter_var($content, FILTER_SANITIZE_STRING);
                $city = filter_var($city, FILTER_SANITIZE_STRING);
                $surferProfileId = filter_var($surferProfileId, FILTER_VALIDATE_INT);
                $levelId = filter_var($levelId, FILTER_VALIDATE_INT);
                
                $picture_upload = filter_var($picture_upload, FILTER_SANITIZE_URL);
                
                // Envoi du nouvel event
                $data = [
                        'ID' => $surferProfileId,
                        'post_author' => get_current_user_id(),
                        'post_type' => 'surfer-profile',
                        'post_status' => 'publish',
                        'meta_input'   => array(
                            'city' => $city,
                            'level'   => $levelId,
                        ),
                    ];
                if (!empty($content)) {
                    $data['post_content'] = $content;
                }
                if (!empty($name)) {
                    $data['post_title'] = $name;
                }
                    
                $postId = wp_insert_post($data);

                // if (!empty($levelId)) {
                //     wp_set_object_terms($postId, array($levelId), 'level');
                // }

                if (!empty($_FILES)) {
                    require_once(ABSPATH . 'wp-admin/includes/post.php');
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    require_once(ABSPATH . 'wp-admin/includes/media.php');

                    // upload image dans la librairie
                    $file = $_FILES['picture_upload'];

                    $_FILES = array("upload_file" => $file);
                    $attachment_id = media_handle_upload("upload_file", $postId);

                    if (is_wp_error($attachment_id)) {
                        // There was an error uploading the image.
                        $errorMessages[] = "Error adding file";

                        foreach ($errorMessages as $message) {
                            echo "<div class='container alert alert-danger' role='alert'>$message</div>";
                        }
                    } else {
                        // The image was uploaded successfully!
                        // lier l'image et le nouveau post en thumbnail

                        set_post_thumbnail($postId, $attachment_id);
                    }
                } else {
                    foreach ($errorMessages as $message) {
                        echo "<br/><div class='container alert alert-danger' role='alert'>$message</div>";
                    }
                }

                // empty the datas
                unset($_FILES);
                
                // redirection toward the updated surfer profile
                if ($postId) {
                    wp_redirect(get_permalink($postId), 302);
                    exit();
                }
            
            }
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
