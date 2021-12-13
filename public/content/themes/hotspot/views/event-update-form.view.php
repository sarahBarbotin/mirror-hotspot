<?php
 the_post();

 // Images thumbnail
$articleId = get_the_id();
$hasImage = has_post_thumbnail($articleId);
if($hasImage) {
    $imageURL = get_the_post_thumbnail_url();
}
else {
    $imageURL = 'https://picsum.photos/300/200?random=1';
}

// Taxonomies
$taxonomies = wp_get_post_terms( $post->ID, ['level','departement', 'event_discipline'] );

// Commentaires
$postCommentCount = get_comments_number($post->ID);
$comments = get_comments(['post_id'=>$articleId]);

/*
* Comment author information fetched from the comment cookies.
*/
$commenter = wp_get_current_commenter();
//dump($commenter);

?>

<!DOCTYPE html>
<html lang="<?=get_bloginfo('language');?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <?php
    use Hotspot\Models\SurferEventModel;
    get_header();
    ?>
</head>

<?php get_template_part('partials/navbar.tpl'); ?>

<!--================================================================================-->
<?php
    global $router;
    $updateEventsURL = $router->generate('event-update-form');
?>

<form class="form-contact contact_form" action="<?= $updateEventsURL;?>" method="post" id="updateEventForm" novalidate="novalidate" enctype="multipart/form-data">

<?php wp_nonce_field('mariee', 'lole'); ?>
    <div class="row">
        <div class="col-12">
            <h2 class="contact-title">Créez votre Event</h2>
        </div>
        <div class="col-sm-12 d-flex">
            <div class="col-sm-2">Spot :</div>
            <div class=" col-sm-12 d-flex justify-content-between">
                <?php $spotQuery = new WP_Query(['post_type' => 'spot']) ?>
                <select id="spotEvent" name="updateEvent[spotEvent]" class="nice-select nc-select">
                    <option selected disabled>Choisissez un Spot</option>
                    <?php if ($spotQuery->have_posts()) {
                        while ($spotQuery->have_posts()) {
                            $spotQuery->the_post();
                            echo '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
                        }
                    } ?>
                </select>
                <div>ou</div>
                <a class="btn_1" href="<?=get_post_type_archive_link('spot');?>/#spotForm" target="_blank">
                    Créez votre spot
                </a>
               
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">Donnez un nom à votre Event :</label>
                <input class="form-control" name="updateEvent[name]" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom de votre Event'" placeholder='Nom de votre Event' value="<?= get_the_title() ?>">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form_group">
                <label for="datepicker_1">Choisissez la date de votre Event :</label>
                <input id="datepicker_1" name="updateEvent[date]" placeholder="Choisir une date" value="<?= get_field('date'); ?>">
            </div>
        </div>
        <div class="col-sm-6 mb-sm-4">
            <div class="form_group">
                <label for="picture_upload">Choisissez une image pour illustrer votre Event :</label>
                <input type="file" id="picture_upload" name="picture_upload" placeholder="Importez une image" accept=".png, .jpeg, .jpg" value="<?= $imageURL?>">
            </div>
        </div>
        <div class="col-sm-12"></div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="description">Décrivez votre Event :</label>
                <textarea class="form-control w-100" name="updateEvent[description]" id="description" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description de votre Event'" placeholder='Description de votre Event' value="<?= get_the_content(); ?>"></textarea>
            </div>
        </div>
        <div class="col-sm-12"></div>
        <div class="col-12 col-sm-8 d-sm-flex">
            <div class="col-sm-4 mb-2">Niveaux acceptés : </div>
            <div class="col-sm-8 pr-sm-2 form-group">

            <select name="updateEvent[levelId]" id="levelId">
                <?php $levelTerms = get_terms(['taxonomy' => 'level', 'hide_empty' => false,]); ?>
                <?php foreach ($levelTerms as $level) {
                    echo '<option value="' . $level->term_id . '">' . $level->name . '</option>';
                } ?>
            </select>
            </div>
        </div>
        <div class="col-sm-8 d-sm-flex">
            <div class="col-sm-2 mb-2">Disciplines : </div>
            <div class="col-sm-8 pr-sm-2 form-group d-sm-flex flex-wrap">
                <?php $disciplineQuery = get_terms(['taxonomy' => 'event_discipline', 'hide_empty' => false]) ?>
                <?php foreach ($disciplineQuery as $discipline) {
                    echo '<div class="col-sm-4">
                    <input type="checkbox" id="discipline-'.$discipline->term_id.'" name="updateEvent[discipline][]" value="'.$discipline->name.'">
                    <label for="discipline-'.$discipline->term_id.'">'.$discipline->name.'</label>
                    </div>';
                } ?>
            </div>
        </div>
        
        <div class="form_btn col-sm-8 d-flex justify-content-center mt-4">
            <button type ="submit" class="btn_1">Créer l'Evenement</button>
        </div>
</form>

<!--================================================================================-->
<?php
    get_footer();
    ?>
</body>
</html>