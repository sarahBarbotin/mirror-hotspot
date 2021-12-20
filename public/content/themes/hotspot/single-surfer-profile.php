<?php
the_post();

$articleId = get_the_id();
$hasImage = has_post_thumbnail($articleId);
if ($hasImage) {
    $imageURL = get_the_post_thumbnail_url();
} else {
    $imageURL = 'https://picsum.photos/300/200?random=1';
}
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
    <!--================Surfer Profile Area =================-->
    <section class="blog_area single-post-area my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 posts-list mb-5">
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
                                        if ($surferLevel == 1) {
                                            echo 'Débutant';
                                        } elseif ($surferLevel == 2) {
                                            echo 'Intermédiaire';
                                        } elseif ($surferLevel == 3) {
                                            echo 'Expert';
                                        } else {
                                            echo 'Niveau non renseigné';
                                        }
                                        ?>
                                    </p>
                                    <p><i class="fas fa-map-marker-alt"></i>
                                        <?php
                                        $surferCity = get_field('city');
                                        if (!empty($surferCity)) {
                                            echo $surferCity;
                                        } else {
                                            echo 'Ville non renseignée';
                                        }
                                        ?>
                                    </p>
                                    <p><i class="fas fa-home"></i>
                                        <?php
                                        $surferDepartement = wp_get_post_terms($articleId, 'departement');
                                        if (!empty($surferDepartement)) {
                                            echo $surferDepartement[0]->name;
                                        } else {
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
                    if (get_current_user_id() == get_the_author_meta('ID')) {
                        $updateSurferUrl = $router->generate(
                            'surfer-profile-update-form',
                            [
                                'surferId' => $articleId
                            ]
                        );


                        echo '<a href="' . $updateSurferUrl . '" class="button button-contactForm btn_1"> Editer mon profil </a>';
                    }

                    ?>
                </div>

                <div class="col-12 my-5">
                    <h2 class="contact-title">Evénements auxquels vous participez</h2>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <?php
                                    $articleId = get_the_id();
                                    $hasImage = has_post_thumbnail($articleId);
                                    if ($hasImage) {
                                        $imageURL = get_the_post_thumbnail_url();
                                    } else {
                                        $imageURL = 'https://picsum.photos/300/200?random=1';
                                    }
                                    ?>
                                    <img class="card-img rounded-0" src="<?= $imageURL ?>" alt="image de l'event">
                                    <div class="blog_item_date">
                                        <h3><?= date("d", strtotime($post->date)); ?></h3>
                                        <p><?= date("M", strtotime($post->date)); ?></p>
                                    </div>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="<?= get_the_permalink() ?>">
                                        <h2><?= get_the_title() ?></h2>
                                    </a>
                                    <p><?= get_the_excerpt() ?></p>
                                    <ul class="blog-info-link">
                                        <li><i class="far"></i>
                                            <?php
                                            $disciplines = wp_get_post_terms($post->ID, 'event_discipline');
                                            if (empty($disciplines)) {
                                                echo ("Libre");
                                            } else {
                                                foreach ($disciplines as $discipline) {
                                                    echo ('<span>' . $discipline->name . "</span>");
                                                }
                                            }
                                            ?>
                                        </li>
                                        <li><i class="far"></i>
                                            <?php
                                            $levels = wp_get_post_terms($post->ID, 'level');
                                            if (empty($levels)) {
                                                echo ("Tout niveaux");
                                            } else {
                                                foreach ($levels as $level) {
                                                    echo ('<span>' . $level->name . "</span>");
                                                }
                                            }
                                            ?>
                                        </li>
                                        <li><i class="far fa-comments"></i> <?= get_comments_number() ?> Commentaires</li>
                                    </ul>
                                </div>
                            </article>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================EVENT Area =================-->

    <!-- Footer start -->
    <?php
    get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php get_footer(); ?>
</body>

</html>