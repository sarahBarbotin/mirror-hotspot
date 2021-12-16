<?php

namespace Hotspot\Controllers;


use Hotspot\Models\SurferEventModel;
use WP_Query;

class SpotController extends CoreController
{
    public function __construct() {
        add_action(
            'template_redirect', 
            [ $this,'handleAddSpotForm']
        );
    }


    function handleAddSpotForm() {
        if (isset($_POST['addSpot'])) {
            
             if (wp_verify_nonce($_POST['coucou'], 'jean')) {
    
                extract($_POST['addSpot']);
    
                $name = filter_var($name, FILTER_SANITIZE_STRING);
                $address = filter_var($address, FILTER_SANITIZE_STRING);
                $levelId = filter_var($levelId, FILTER_VALIDATE_INT);
                $city = filter_var($city, FILTER_SANITIZE_STRING);
                $zipcode = filter_var($zipcode, FILTER_VALIDATE_INT);
                $departementId = filter_var($departementId, FILTER_VALIDATE_INT);
                // $picture_upload = filter_var($picture_upload, FILTER_SANITIZE_URL);
                $description = filter_var($description, FILTER_SANITIZE_STRING);
                $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    
                // Gestion des erreurs
                $errorMessages = [];
    
                if (empty($name)) {
                    $errorMessages[] = "Vous n'avez pas donné de nom à votre Spot";
                }
                if (empty($levelId) || $levelId === false) {
                    $errorMessages[] = 'Veuillez renseigner la difficulté du Spot';
                }
                
                if (empty($departementId) || $departementId === false) {
                    $errorMessages[] = 'Veuillez renseigner le département du Spot';
                }
    
                // Envoi du nouveau spot
                if (empty($errorMessages)) {
                    $data = ['post_author' => get_current_user_id(),
                            'post_title' => $name,
                            'post_type' => 'spot',
                            'post_content' => $description,
                            'post_status' => 'publish',
                            'meta_input'   => array(
                                'city' => $city,
                                'address'   => $address,
                                'latitude'   => $latitude,
                                'longitude'   => $longitude,
                                'zipcode'   => $zipcode,
                            ),
                        ];
                    $postId = wp_insert_post($data);
                    wp_set_object_terms( $postId, array( $levelId ), 'level' );
                    wp_set_object_terms( $postId, array( $departementId ), 'departement' );
    
                    if(!empty($_FILES)){
                        require_once( ABSPATH . 'wp-admin/includes/post.php' );
                        require_once( ABSPATH . 'wp-admin/includes/image.php' );
                        require_once( ABSPATH . 'wp-admin/includes/file.php' );
                        require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    
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
                            
                            set_post_thumbnail( $postId, $attachment_id );
                        }
                        
                        
                    }
                } else {
                    foreach ($errorMessages as $message) {
    
                        echo "<br/><div class='container alert alert-danger' role='alert'>$message</div>";
    
                      }
                }
    
                unset($_FILES);
             }
        }
        
    }
    
}

