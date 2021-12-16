<?php
global $router;

//TODO WP_QUERY dans le plugin

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

<!DOCTYPE html>
<html lang="<?=get_bloginfo('language');?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <?php
        get_header();
    ?>
</head>

<?php get_template_part('partials/navbar.tpl'); ?>

<!--================================================================================-->


<section class="blog_area single-post-area my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 posts-list">
                <div class="single-post">
                    <!-- Author -->

<form class="form-contact contact_form" action="#" method="post" id="updateSurferProfileForm" novalidate="novalidate" enctype="multipart/form-data">


    <?php wp_nonce_field('updateSurferProfileToken', 'updateSurferForm'); ?>

    <input id="surferProfileId" name="updateSurferProfile[surferProfileId]" type="hidden" value="<?= $post->ID ?>">

                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="<?= $imageURL; ?>" alt="">
                            <div class="media-body">
                                <a href="#">
                                    <h4>
                                    
                                    <div class="form-group">
                                        <input class="form-control" name="updateSurferProfile[name]" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $surferTitle ?>'" placeholder='<?= $surferTitle ?>' value="<?= $surferTitle ?>">
                                    </div>
                                
                                </h4>
                                </a>
                                <p><i class="fas fa-swimmer"></i>

                                <select name="updateSurferProfile[levelId]" id="levelId"> 
                                <?php 
                                    if ($surferLevel == 1) {
                                        echo '<option value="1" selected>Débutant</option>
                                        <option value="2">Intermédiaire</option>
                                        <option value="3">Expert</option>';
                                    } elseif($surferLevel == 2) {
                                        echo '<option value="1">Débutant</option>
                                        <option value="2" selected>Intermédiaire</option>
                                        <option value="3">Expert</option>';
                                    }elseif($surferLevel == 3) {
                                        echo '<option value="1">Débutant</option>
                                        <option value="2">Intermédiaire</option>
                                        <option value="3" selected>Expert</option>';
                                    }else {
                                        echo '<option value="1">Débutant</option>
                                        <option value="2">Intermédiaire</option>
                                        <option value="3">Expert</option>';
                                    }
                                ?>
                                </select>

                                </p>
                                

                                <a href="#">
                                    <h4>
                                    <!-- <i class="fas fa-map-marker-alt"></i> -->
                                    <div class="form-group mt-3">
                                        <input class="form-control" name="updateSurferProfile[city]" id="city" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $city ?>'" placeholder='<?php if(!empty($city)){echo $city;}else{echo 'Ville';} ?>' value="<?= $city ?>">
                                    </div>
                                
                                </h4>
                                </a>

                                <div class="col-sm-8 pr-sm-2 form-group">


                                <select name="updateSurferProfile[departement]" id="departement">
                                    <?php $departements = get_terms(['taxonomy' => 'departement', 'hide_empty' => false,]);?>
                                    <?php foreach ($departements as $departement) {
                                        if ($surferDepartement[0]->term_id == $departement->term_id) {
                                            echo '<option value="' . $departement->term_id . '" selected>' . $departement->name . '</option>';
                                        }else {
                                            echo '<option value="' . $departement->term_id . '">' . $departement->name . '</option>';
                                        }
                                    } ?>

                                    
                                </select>
                                </div>

                                <div class="form_group">
                    <label for="picture_upload">Changez votre photo de profil :</label>
                    <input type="file" id="picture_upload" name="picture_upload" placeholder="Importez une image" accept=".png, .jpeg, .jpg">
                </div>
                            </div>
                        </div>
                    </div>
                    <!-- profile description -->
                    <div class="quote-wrapper">
                        <div class="quotes">

                            <a href="#">
                                    <h4>
                                    <!-- <i class="fas fa-map-marker-alt"></i> -->
                                    <div class="form-group mt-3">
                                        <input class="form-control" name="updateSurferProfile[content]" id="content" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $content ?>'" placeholder='<?php if(!empty($content)){echo $content;}else {echo 'Description';}  ?>' value="<?= $content ?>">
                                    </div>
                                
                                </h4>
                                </a>
                        </div>
                    </div>
                </div>
        <button type="submit" class="btn_1">Modifier mon profil</button>

                <?php
                   
                    $url = $router->generate(
                        'surfer-confirm-delete',
                        [
                            'surferId' => $surferId
                        ]
                    );

                    echo '<a href="' . $url . '" class="genric-btn success circle mr-5 leave">Supprimer mon compte </a>';
                

                ?>
            </div>
        </div>
    </div>
</section>
</form>

<?php get_template_part('partials/footer.tpl'); ?>
<?php get_footer();?>
</body>
</html>