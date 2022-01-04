<!--=================================  DATAS  ===============================================-->
<?php

global $router;

// CPT id
$surferId = $router->match()['params']['surferId'];

$authorProfileQuery = new WP_Query([
    'post_type' => 'surfer-profile',
    'author' => get_the_author_meta($surferId),
]);
$post = $authorProfileQuery->posts[0];
$surferTitle = $post->post_title;
$content = $post->post_content;
$surferLevel = get_field('level');
$surferDepartement = wp_get_post_terms($post->ID, 'departement');
$city = get_post_field('city', $post->ID);

$hasImage = has_post_thumbnail($post->ID);
if ($hasImage) {
    $imageURL = get_the_post_thumbnail_url($post->ID);
} else {
    $imageURL = 'https://picsum.photos/300/200?random=1';
}

?>

<!--=================================  HEAD   ===============================================-->

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
<?php get_template_part('partials/banner.tpl'); ?>


<!--==================================  BODY  ==============================================-->


<section class="blog_area single-post-area my-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-12 posts-list">

                <div class="single-post">

                    <!-- ======== Surfer update form ======== -->

                    <form class="form-contact contact_form" action="#" method="post" id="updateSurferProfileForm" novalidate="novalidate" enctype="multipart/form-data">

                        <?php wp_nonce_field('updateSurferProfileToken', 'updateSurferForm'); ?>

                        <div class="row align-items-center ">

                            <div class="col-sm-12">

                                <div class="blog-author">

                                    <div class="media row align-items-center ">

                                        <!-- ======= Avatar ======= -->

                                        <div class="col-lg-3 text-center">

                                            <img src="<?= $imageURL; ?>" alt="">

                                        </div>

                                        <!-- ===== Informations profil ========-->

                                        <div class="col-lg-9 py-4">

                                            <div class="media-body">

                                            

                                                <div class="row align-items-center ">

                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label for="name">Mon pseudo</label>
                                                            <input class="form-control" name="updateSurferProfile[name]" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $surferTitle ?>'" placeholder='<?= $surferTitle ?>' value="<?= $surferTitle ?>">
                                                        </div>

                                                    </div>

                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label for="city">Ma ville</label>
                                                            <input class="form-control" name="updateSurferProfile[city]" id="city" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $city ?>'" placeholder='
                                                        <?= !empty($city) ? $city : 'Ville' ?>' value="<?= $city ?>">
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6 pb-5">

                                                        <div class="form-group">

                                                            <select name="updateSurferProfile[levelId]" id="levelId" class="nice-select nc-select">
                                                                <?php
                                                                if ($surferLevel == 1) {
                                                                    echo '<option value="1" selected>Débutant</option>
                                                        <option value="2">Intermédiaire</option>
                                                        <option value="3">Expert</option>';
                                                                } elseif ($surferLevel == 2) {
                                                                    echo '<option value="1">Débutant</option>
                                                        <option value="2" selected>Intermédiaire</option>
                                                        <option value="3">Expert</option>';
                                                                } elseif ($surferLevel == 3) {
                                                                    echo '<option value="1">Débutant</option>
                                                        <option value="2">Intermédiaire</option>
                                                        <option value="3" selected>Expert</option>';
                                                                } else {
                                                                    echo '<option value="1">Débutant</option>
                                                        <option value="2">Intermédiaire</option>
                                                        <option value="3">Expert</option>';
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>

                                                    </div>


                                                    <div class="col-md-6 pb-5">

                                                        <div class="form-group">

                                                            <select name="updateSurferProfile[departement]" id="departement" class="nice-select nc-select">
                                                                <?php $departements = get_terms(['taxonomy' => 'departement', 'hide_empty' => false,]); ?>
                                                                <?php foreach ($departements as $departement) {
                                                                    if ($surferDepartement[0]->term_id == $departement->term_id) {
                                                                        echo '<option value="' . $departement->term_id . '" selected>' . $departement->name . '</option>';
                                                                    } else {
                                                                        echo '<option value="' . $departement->term_id . '">' . $departement->name . '</option>';
                                                                    }
                                                                } ?>
                                                            </select>

                                                        </div>

                                                    </div>


                                                <div class="col-sm-12">

                                                        <div class="form_group d-flex flex-column">

                                                            <label for="picture_upload" class="pb-3">Changez votre photo de profil :</label>
                                                            <input type="file" id="picture_upload" name="picture_upload" placeholder="Importez une image" accept=".png, .jpeg, .jpg">

                                                        </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- =========== profile description ========= -->

                            <div class="row align-items-center ">

                                <div class="col-sm-12">

                                    <div class="quote-wrapper">

                                        <div class="quotes">

                                            <div class="form-group mt-3">

                                                <label for="content">Ma biographie</label>

                                                <textarea class="form-control" name="updateSurferProfile[content]" id="content" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $content ?>'" placeholder='<?= !empty($content) ? $content : 'Description' ?>' rows="5"><?= $content ?></textarea>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- ========= Submit buttom  =========-->

                            <button type="submit" class="btn_1 mb-3">Modifier mon profil</button>

                            <?php
                            $url = $router->generate(
                                'surfer-confirm-delete',
                                [
                                    'surferId' => $surferId
                                ]
                            );
                            echo '<a href="' . $url . '" class="btn_2 mb-3">Supprimer mon compte </a>';
                            ?>

                        </div>

                

                     </form> 
                    
                </div>

            </div>

        </div>

    </div>

</section>

<!--==================================  FOOTER  ==============================================-->


<?php get_template_part('partials/footer.tpl'); ?>
<?php get_footer(); ?>

</body>

</html>