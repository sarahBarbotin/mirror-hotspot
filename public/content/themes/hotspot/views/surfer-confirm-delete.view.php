<?php
global $router;

// current user data
$user = wp_get_current_user();
$userId = $user->ID;
// CPT id
$surferId = $router->match()['params']['surferId'];


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
                    
                    echo 'Etes-vous certain de vouloir supprimer votre compte? Toute suppression est irréversible.</br>';                        
                    echo '<form method="POST" id="surfer_delete_button" action="#">';
                    echo '<button type="submit" for="surfer_delete_button" class="genric-btn success circle mr-5 mt-5 leave">Supprimer mon compte </button>';
                    echo '</form>';

                    dump($surferId);
                    dump(wp_get_current_user()->ID);

                ?>

                
                    
                </div>
            </div>
        </div>
</section>



<!--================================================================================-->
<!-- Footer start -->
<?php
        get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->
    
<?php get_footer(); ?>

</body>

</html>