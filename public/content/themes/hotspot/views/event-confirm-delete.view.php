<?php
global $router;

// current user data
$user = wp_get_current_user();
$userId = $user->ID;
// CPT id
$eventId = $router->match()['params']['eventId'];
$event = get_post($eventId);
$authorId = $event->post_author;

?>

<!--================================================================================-->

<!DOCTYPE html>
<html lang="<?= get_bloginfo('language'); ?>">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <?php


    get_header();
    ?>
</head>
<body>

<?php get_template_part('partials/navbar.tpl'); ?>

<!--================================================================================-->
<section class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <?php 
                    if ($authorId == $userId) {

                        // $url = $router->generate(
                        //     'event-delete-post',
                        //     [
                        //         'eventId' => $eventId
                        //     ]
                        // );
                        echo 'Etes-vous certain de vouloir supprimer cet événement? Toute suppression est irréversible</br>';                        
                        echo '<form method="POST" id="event_delete_button" action="#">';
                        echo '<button type="submit" for="event_delete_button" class="genric-btn success circle mr-5 leave">Supprimer l\'événement</button>';
                        echo '</form>';
                    }
                ?>
                    
                </div>
            </div>
        </div>
</section>



<!--================================================================================-->

<?php get_footer(); ?>

</body>

</html>