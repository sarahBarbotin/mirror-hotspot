<?php

namespace Hotspot\Controllers;


class EventController extends CoreController
{
    public function __construct()
    {
        add_action(
            'template_redirect',
            [$this, 'handleAddEventForm']
        );
    }

    function handleAddEventForm()
    {
        if (isset($_POST['addEvent'])) {

            if (wp_verify_nonce($_POST['lol'], 'marie')) {
                dump($_POST);
                extract($_POST['addEvent']);

                dump($discipline);
                $name = filter_var($name, FILTER_SANITIZE_STRING);
                $date =  preg_replace("([^0-9/])", "", $date);
                $description = filter_var($description, FILTER_SANITIZE_STRING);
                $levelId = filter_var($levelId, FILTER_VALIDATE_INT);
                $spotEvent = filter_var($spotEvent, FILTER_VALIDATE_INT);

                // TODO filtrage du tableau $disciplines
                // $picture_upload = filter_var($picture_upload, FILTER_SANITIZE_URL);               

                // Gestion des erreurs
                $errorMessages = [];
                
                if (empty($name)) {
                    $errorMessages[] = "Vous n'avez pas donné de nom à votre Event";
                }
                if (empty($date) || $date === false) {
                    $errorMessages[] = 'Veuillez renseigner la date de votre Event';
                }

                if (empty($spotEvent) || $spotEvent === false) {
                    $errorMessages[] = 'Veuillez renseigner le spot de votre Event';
                }

                // Envoi du nouvel event
                if (empty($errorMessages)) {
                    $data = [
                        'post_author' => get_current_user_id(),
                        'post_title' => $name,
                        'post_type' => 'event',
                        'post_content' => $description,
                        'post_status' => 'publish',
                        'meta_input'   => array(
                            'date' => $date,
                            'spot_id'   => $spotEvent
                        ),
                    ];
                    $postId = wp_insert_post($data);

                    wp_set_object_terms($postId, array($levelId), 'level');                   
                    wp_set_object_terms($postId, $discipline, 'event_discipline');

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
                    }
                } else {
                    foreach ($errorMessages as $message) {

                        echo "<br/><div class='container alert alert-danger' role='alert'>$message</div>";
                    }
                }
            }
        }
    }
}
