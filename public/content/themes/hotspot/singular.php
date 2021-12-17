<?php
the_post();

use Hotspot\Models\SurferEventModel;

global $router;

//get user id
$userId = get_current_user_id();


// Images thumbnail
$articleId = get_the_id();
$hasImage = has_post_thumbnail($articleId);
if ($hasImage) {
    $imageURL = get_the_post_thumbnail_url();
} else {
    $imageURL = 'https://picsum.photos/300/200?random=1';
}

//get spot datas of current event
$spotId = get_post_field('spot_id');
$spot = get_post($spotId);
$spotCity = get_post_field('city', $spotId);
$spotDepartement = wp_get_post_terms($spotId, 'departement');

// binding participation between the current user/surfer and the event
$surferEventModel = new SurferEventModel();
$participation = $surferEventModel->isParticipating($userId, $articleId);
$participants = $surferEventModel->getSurfersByEventId($articleId);

// Taxonomies
$taxonomies = wp_get_post_terms($post->ID, ['departement', 'event_discipline']);

// Commentaires
$postCommentCount = get_comments_number($post->ID);
$comments = get_comments(['post_id' => $articleId]);

/*
* Comment author information fetched from the comment cookies.
*/
$commenter = wp_get_current_commenter();

?>


<!doctype html>
<html lang="<?= get_bloginfo('language'); ?>">

<head>
    <?php get_header(); ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>

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

    <!--================EVENT Area =================-->

    <div class="container">
        <section class="blog_area single-post-area section_padding">
            <div class="container">
                <div class="row">
                    <div class="posts-list">
                        <div class="single-post">
                            <div class="feature-img">
                                <!-- Image -->
                                <img class="img-fluid" src="<?php echo $imageURL ?>" alt="">
                            </div>
                            <div class="blog_details">
                                <!-- Title -->
                                <h2><?= get_the_title() ?></h2>

                                <?php
                                $updateEventUrl = $router->generate(
                                    'event-update-form',
                                    [
                                        'eventId' => $articleId
                                    ]
                                );


                                echo '<a href="' . $updateEventUrl . '" class="button button-contactForm btn_1"> Editer </a>';


                                ?>
                                <!-- Tags & nb comments-->
                                <ul class="blog-info-link mt-3 mb-4">
                                    <li><i class="far fa-user"></i>
                                        <?php if (!empty($taxonomies)) {
                                            foreach ($taxonomies as $taxonomy) {
                                                echo $taxonomy->name . ' ';
                                            }
                                        } ?></li>
                                    <li><i class="ti ti-announcement"></i> <?php if (!empty(get_field('date'))) {
                                                                                $date = get_field('date');
                                                                                echo $date;
                                                                            } else {
                                                                                echo "-";
                                                                            } ?></li>
                                </ul>
                                <!-- excert -->
                                <p class="excert">
                                    <?= get_the_content(); ?>
                                </p>

                                <!-- spot map -->
                                <div class="quote-wrapper">
                                    <div class="quotes">
                                        <div class="col-lg-6">

                                            <h3><a href="<?= get_permalink($spotId) ?>"><?= $spot->post_title ?></a></h3>

                                            <i class="ti-direction"></i>
                                            <?php
                                            if (!empty($spotCity)) {
                                                echo $spotCity;
                                            }
                                            ?>
                                            <br />
                                            <i class="ti-location-pin"></i>
                                            <?php

                                            if (!empty($spotDepartement)) {
                                                echo ($spotDepartement[0]->name);
                                            }
                                            ?>

                                        </div>

                                    </div>

                                    <?php get_template_part('partials/map.tpl', null, ['spotId' => $spotId]); ?>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">

                            <!-- participation -->
                            <p class="like-info"><span class="align-middle"><i class="far fa-heart"></i></span><?= count($participants) ?> personnes participent</p>

                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <!-- <p class="comment-count"><span class="align-middle"><i class="far fa-comment"></i></span> 06 Comments</p> -->
                                <div class="col-sm-4 text-center my-2 my-sm-0">
                                    <!-- <p class="comment-count"><span class="align-middle"><i class="far fa-comment"></i></span> 06 Comments</p> -->
                                    <?php
                                    if (get_the_author_meta('ID') == $userId) {

                                        $url = $router->generate(
                                            'event-confirm-delete',
                                            [
                                                'eventId' => $articleId
                                            ]
                                        );

                                        echo '<a href="' . $url . '" class="btn_2">Supprimer l\'événement</a>';
                                    } elseif ($participation === false) {

                                        $url = $router->generate(
                                            'surfer-event-participate',
                                            [
                                                'eventId' => $articleId
                                            ]
                                        );

                                        echo '<a href="' . $url . '" class="btn_1">Participer</a>';
                                    } elseif ($participation === true) {

                                        $url = $router->generate(
                                            'surfer-event-leave',
                                            [
                                                'eventId' => $articleId
                                            ]
                                        );

                                        echo '<a href="' . $url . '" class="btn_2">Quitter</a>';
                                    }

                                    ?>

                                </div>

                            </div>



                        </div>

                        <!-- Author -->
                        <div class="blog-author">
                            <div class="media align-items-center">
                                <div>
                                    <?php

                                    //TODO Aller chercher le profil de l'auteur et pas WPuser
                                    // $userID = get_current_user_id();
                                    // $surferProfile = new WP_Query(
                                    //     ['post_type' => 'surfer-profile',
                                    //     'author' => $userID]
                                    // );

                                    $authorProfileQuery = new WP_Query([
                                        'post_type' => 'surfer-profile',
                                        'author' => get_the_author_meta('ID')
                                    ]);
                                    //echo get_avatar( get_the_author_meta( 'ID' ), 32 );

                                    ?>
                                </div>
                                <div class="media-body">
                                    <a href="<?= $authorProfileQuery->posts[0]->guid; ?>">
                                        <h4>
                                            <?= $authorProfileQuery->posts[0]->post_title; ?>
                                        </h4>
                                    </a>
                                    <p>
                                        <?= $authorProfileQuery->posts[0]->post_content; ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Comments -->
                        <div class="comments-area">
                            <h4><?php echo $postCommentCount ?> Comments</h4>

                            <?php foreach ($comments as $comment) { ?>
                                <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <?php

                                                $commentAuthorID = $comment->comment_author_id;

                                                echo get_avatar($commentAuthorID);

                                                ?>
                                            </div>
                                            <div class="desc">
                                                <p class="comment">
                                                    <?php echo $comment->comment_content; ?>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <h5>
                                                            <a href="<?php echo $comment->comment_author_url; ?>"><?php echo $comment->comment_author; ?></a>
                                                        </h5>
                                                        <p class="date"><?php echo $comment->comment_date; ?> </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>


                            <!-- Reply -->
                            <?php if (get_current_user_id()) { ?>

                                <div class="comment-form">
                                    <h4>Laissez un commentaire</h4>
                                    <form class="form-contact comment_form" action="#" method="POST" id="commentForm">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control w-100" name="addComment[content]" id="comment" cols="30" rows="9" placeholder="Ecrivez votre commentaire"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <button type="submit" class="button button-contactForm btn_1">Envoyer</button>
                                        </div>
                                    </form>
                                </div>

                            <?php } else { ?>

                                <div class="comment-form">
                                    <h4>Laisser un commentaire</h4>
                                    <p>Inscrivez-vous ou connectez-vous pour laisser un commentaire.</p>
                                </div>

                            <?php }  ?>

                        </div>
                        <!-- a lot of asides -->
                    </div>
                </div>
        </section>
    </div>
    <!--================ Blog Area end =================-->


    <!-- Footer start -->
    <?php
    get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php get_footer(); ?>
</body>

</html>