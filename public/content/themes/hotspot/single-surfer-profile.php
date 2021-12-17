<?php
the_post();
?>

<!doctype html>
<html lang="<?= get_bloginfo('language'); ?>">

<head>
    <?php get_header(); ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <!-- <link rel="icon" href="<?php echo get_theme_file_uri('assets/img/favicon.png'); ?>">
     -->
</head>

<body>
    <!-- Header start-->
    <?php
    get_template_part('partials/navbar.tpl');
    ?>

    <?php
    get_template_part('partials/banner.tpl');
    ?>
    <!-- Header end -->

    <?php
    $articleId = get_the_id();
    $hasImage = has_post_thumbnail($articleId);
    if ($hasImage) {
        $imageURL = get_the_post_thumbnail_url();
    } else {
        $imageURL = 'https://picsum.photos/300/200?random=1';
    }
    ?>


    <section class="blog_area single-post-area my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 posts-list">
                    <div class="single-post">
                        <!-- Author -->
                        <div class="blog-author">
                            <div class="media align-items-center">
                                <img src="<?= $imageURL; ?>" alt="">
                                <div class="media-body">
                                    <a href="#">
                                        <h4><?= get_the_title() ?></h4>
                                    </a>
                                    <p><i class="fas fa-swimmer"></i>
                                        <?php
                                        $surferLevel = get_field('level');
                                            if($surferLevel == 1){
                                                echo 'Débutant';
                                            }
                                            elseif($surferLevel == 2){
                                                echo 'Intermédiaire';
                                            }
                                            elseif($surferLevel == 3){
                                                echo 'Expert';
                                            }
                                            else{
                                                echo 'Niveau non renseigné';
                                            }  
                                        ?>
                                    </p>
                                    <p><i class="fas fa-map-marker-alt"></i>
                                    <?php
                                        $surferCity = get_field('city');
                                        if (!empty($surferCity)){
                                        echo $surferCity; 
                                        }else{
                                            echo 'Ville non renseignée';
                                        }
                                    ?>
                                    </p>
                                    <p><i class="fas fa-home"></i>
                                    <?php
                                        $surferDepartement = wp_get_post_terms($articleId, 'departement');
                                        if(!empty($surferDepartement)){
                                        echo $surferDepartement[0]->name; 
                                        }else{
                                            echo 'Département non renseigné';
                                        }
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- profile description -->
                        <div class="quote-wrapper">
                            <div class="quotes">
                                <?= 
                                    get_the_content();
                                 ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    if(get_current_user_id() == get_the_author_meta( 'ID' )){
                        $updateSurferUrl = $router->generate(
                            'surfer-profile-update-form',
                            [
                                'surferId' => $articleId
                            ]
                        );

                        
                            echo '<a href="'.$updateSurferUrl.'" class="button button-contactForm btn_1"> Editer mon profil </a>';
                    }    

                    ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer start -->
    <?php
    get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php get_footer(); ?>
</body>

</html>