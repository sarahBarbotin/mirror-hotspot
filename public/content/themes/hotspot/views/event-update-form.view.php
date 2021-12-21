<!--=================================  DATAS   ===============================================-->

<?php
global $router;

// CPT id
$eventId = $router->match()['params']['eventId'];
$eventCPTObject = get_post($eventId);
$eventTitle = $eventCPTObject->post_title;
$eventContent = $eventCPTObject->post_content;

$hasImage = has_post_thumbnail($eventId);
if ($hasImage) {
    $imageURL = get_the_post_thumbnail_url($eventId);
} else {
    $imageURL = 'https://picsum.photos/300/200?random=1';
}

// Taxonomies
$taxonomies = wp_get_post_terms($eventCPTObject->ID, ['level', 'event_discipline']);

?>

<!--=================================== HEAD =============================================-->

<!DOCTYPE html>
<html lang="<?= get_bloginfo('language'); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <?php get_header(); ?>
</head>

<body>

    <?php get_template_part('partials/navbar.tpl'); ?>
    <?php get_template_part('partials/banner.tpl'); ?>


<!--=================================== BODY =============================================-->

    <section class="contact-section ">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-9 mb-3">
                    <h2 class="contact-title">Modifiez votre Événement</h2>
                </div>

                <div class="col-lg-9">

                    <!-- ======== Event update form ======== -->

                    <form class="form-contact contact_form" action="#" method="post" id="updateEventForm" novalidate="novalidate" enctype="multipart/form-data">

                        <?php wp_nonce_field('updateEventToken', 'updateEventForm'); ?>

                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Nom de votre Event :</label>
                                    <input class="form-control" name="updateEvent[name]" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $eventTitle ?>'" placeholder='<?= $eventTitle ?>' value="<?= $eventTitle ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="spotEvent" class="d-block">Spot :</label>
                                        <?php
                                        $spotQuery = new WP_Query(['post_type' => 'spot']);
                                        $spotId = get_post_field("spot_id", $eventId);
                                        ?>
                                        <select id="spotEvent" name="updateEvent[spotEvent]" class="nice-select nc-select w-100">
                                            <option selected disabled>Choisissez un Spot *</option>

                                            <?php if ($spotQuery->have_posts()) {
                                                while ($spotQuery->have_posts()) {
                                                    $spotQuery->the_post();
                                                    if ($spotId == get_the_ID()) {
                                                        echo '<option value="' . get_the_ID() . '" selected>' . get_the_title() . '</option>';
                                                    } else {
                                                        echo '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <div class="form_group">
                                    <label for="date" class="d-block">La date de votre Event :</label>
                                    <input type="date" name="updateEvent[date]" value="" class="nice-select nc-select w-100">
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center mb-4">
                            <div class="col-sm-7">
                                <div class="form_group">
                                    <label for="picture_upload">Modifiez ou gardez l'image ci-contre :</label>
                                    <input type="file" id="picture_upload" name="picture_upload" placeholder="Importez une image" accept=".png, .jpeg, .jpg">
                                </div>
                            </div>
                            <div class="col-sm-5 d-flex justify-content-end">
                                <div class="form_group">
                                    <figure class="pt-3">
                                        <img src="<?= $imageURL ?>" alt="" class="img-fluid rounded">
                                    </figure>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description de votre Event :</label>
                                    <textarea class="form-control w-100" name="updateEvent[description]" id="description" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description de votre Event'" placeholder='<?= $eventContent ?>'><?= $eventContent ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 pr-sm-2">
                                <div class="form-group">
                                        <?php $eventLevel = get_the_terms($eventId, 'level') ?>
                                        <label for="dlevelId" class="d-block">Niveau accepté :</label>
                                        <select name="updateEvent[levelId]" id="levelId" class="nice-select nc-select w-100">
                                            <?php $levelTerms = get_terms(['taxonomy' => 'level', 'hide_empty' => false,]); ?>
                                            <?php foreach ($levelTerms as $level) {
                                                if ($eventLevel[0]->term_id == $level->term_id) {
                                                    echo '<option value="' . $level->term_id . '" selected>' . $level->name . '</option>';
                                                } else {
                                                    echo '<option value="' . $level->term_id . '">' . $level->name . '</option>';
                                                }
                                            } ?>
                                        </select>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label for="discipline" class="d-block">Disciplines : </label>
                                <div class="form-group">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <?php $eventDisciplines = get_the_terms($eventId, 'event_discipline') ?>
                                        <?php $disciplineQuery = get_terms(['taxonomy' => 'event_discipline', 'hide_empty' => false]) ?>
                                        <?php
                                        foreach ($disciplineQuery as $discipline) {
                                            if (!empty($eventDisciplines)) {
                                                foreach ($eventDisciplines as $eventDiscipline) {
                                                    if ($eventDiscipline->term_id == $discipline->term_id) {
                                                        echo '<div>
                                            <input type="checkbox" id="discipline-' . $discipline->term_id . '" name="updateEvent[discipline][]" value="' . $discipline->name . '" checked>
                                            <label for="discipline-' . $discipline->term_id . '">' . $discipline->name . '</label>
                                                </div>';
                                                        continue 2;
                                                    }
                                                }
                                            }
                                            echo '<div>
                                                <input type="checkbox" id="discipline-' . $discipline->term_id . '" name="updateEvent[discipline][]" value="' . $discipline->name . '">
                                                <label for="discipline-' . $discipline->term_id . '">' . $discipline->name . '</label>
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
     
                        <!-- Submit button -->
                        <div class="form_btn col-sm-8 d-flex mt-4">
                            <button type="submit" class="btn_1">Modifier l'Evènement</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </section>

    <!--=============================== FOOTER =================================================-->

    <!-- Footer start -->
    <?php get_template_part('partials/footer.tpl'); ?>

    <!-- Footer end -->
    <?php get_footer();?>

</body>

</html>