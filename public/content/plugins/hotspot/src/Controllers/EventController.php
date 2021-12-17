<?php

namespace Hotspot\Controllers;

use Hotspot\Models\SurferEventModel;
use WP_Query;


class EventController extends CoreController
{
    public function __construct()
    {
        add_action(
            'template_redirect',
            [$this, 'handleAddEventForm']
        );

        add_action(
            'template_redirect',
            [$this, 'handleAddComment']
        );
    }

    public  function handleAddEventForm()
    {
        if (isset($_POST['addEvent'])) {

            if (wp_verify_nonce($_POST['lol'], 'marie')) {
                extract($_POST['addEvent']);

                $name = filter_var($name, FILTER_SANITIZE_STRING);
                $date =  preg_replace("([^0-9/])", "", $date);
                $description = filter_var($description, FILTER_SANITIZE_STRING);
                $levelId = filter_var($levelId, FILTER_VALIDATE_INT);
                if (isset($spotEvent)) {
                    $spotEvent = filter_var($spotEvent, FILTER_VALIDATE_INT);
                }

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
                        $attachment_id = media_handle_upload('upload_file', $postId);
                        
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

                // Adding user's participation to the event
                $surferEventModel = new SurferEventModel;
                $surferEventModel->insert(get_current_user_id(), $postId);

            }
        }
    }

    public function update($eventId)
    {
        $this->show('views/event-update-form.view',
        ['eventId' => $eventId]
    );
    }

    public function handleUpdateEventForm($eventId)
    {
        if (isset($_POST['updateEventForm'])) {

            if (wp_verify_nonce($_POST['updateEventForm'], 'updateEventToken')) {
                extract($_POST['updateEvent']);

                $name = filter_var($name, FILTER_SANITIZE_STRING);
                $date =  preg_replace("([^0-9/])", "", $date);
                $description = filter_var($description, FILTER_SANITIZE_STRING);
                $levelId = filter_var($levelId, FILTER_VALIDATE_INT);
                if (isset($spotEvent)) {
                    $spotEvent = filter_var($spotEvent, FILTER_VALIDATE_INT);
                }
                
                // TODO filtrage du tableau $disciplines
                // $picture_upload = filter_var($picture_upload, FILTER_SANITIZE_URL);

                // Envoi du nouvel event
                $data = [
                        'ID' => $eventId,
                        'post_author' => get_current_user_id(),
                        'post_type' => 'event',
                        'post_status' => 'publish',
                        'meta_input' => array()
                    ];
                if (!empty($description)) {
                    $data['post_content'] = $description;
                }
                if (!empty($name)) {
                    $data['post_title'] = $name;
                }
                if (!empty($date)) {
                    $data['meta_input']['date'] = $date;
                }
                if (!empty($spotEvent)) {
                    $data['meta_input']['spot_id'] = $spotEvent;
                }
                
                    
                $postId = wp_insert_post($data);
                if (!empty($levelId)) {
                    wp_set_object_terms($postId, array($levelId), 'level');
                }
                if (!empty($discipline)) {
                    wp_set_object_terms($postId, $discipline, 'event_discipline');
                }

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
                
                // redirection toward the updated event
                if ($postId) {
                    wp_redirect(get_permalink($postId), 302);
                    exit();
                }
            
            }
        }

        
    }

    public function handleEventConfirmDelete($eventId) 
    {
        if (!$this->isConnected()) {
            get_permalink(get_page_by_title('404'));
            exit();
        } else {
            $this->show(
                'views/event-confirm-delete.view',
                ['eventId' => $eventId]
            );
        }
    }
    

    public function handleEventDelete($eventId)
    {

            if ($eventId) {
                $deleted = wp_delete_post($eventId, true);

                if ($deleted) {
                    $surferEventModel = new SurferEventModel();
                    $surferEventModel->deleteByEventId($eventId);
            
                    wp_redirect(get_post_type_archive_link('event'), 302);
                    exit();
                } else {
                    echo 'erreur lors de la suppression de l\'événement';
                }
            } else {
                get_permalink(get_page_by_title('404'));
                exit();
            }
        
    }

    public function handleAddComment()
    {
        if (isset($_POST['addComment'])) {

            $postId = get_the_id();
            $user = wp_get_current_user();

            extract($_POST['addComment']);

            $content = filter_var($content, FILTER_SANITIZE_STRING);

            if (!empty($content)) {
                $data = ['comment_content' => $content,
                    'comment_post_ID' => $postId,
                    'user_id' => $user->ID,
                    'comment_author' => $user->data->user_login];
                
                $commentId = wp_insert_comment($data);
            }


            if (isset($commentId)) {
                wp_redirect(get_permalink($postId), 302);
                exit();
            }
        }
    }

    
}
