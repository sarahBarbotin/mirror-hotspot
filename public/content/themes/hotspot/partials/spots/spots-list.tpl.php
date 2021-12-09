<!-- hotel list css start-->

<?php
$args = array(
    'post_type' => 'spot',
    'posts_per_page' => 9
);
$the_query = new WP_Query($args); ?>


<section class="top_place section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section_tittle text-center">
                    <h2>Spots</h2>
                    <p>Retrouvez une sélection des spots de surfs les plus agréables créés par les surfers eux-mêmes</p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                    <?php
                    // Récupération des images thumbnail
                    $articleId = get_the_id();
                    $hasImage = has_post_thumbnail($articleId);
                    if ($hasImage) {
                        $imageURL = get_the_post_thumbnail_url();
                    } else {
                        $imageURL = 'https://picsum.photos/300/200?random=1';
                    }

                    // Récupération des taxonomies
                    $taxonomies = wp_get_post_terms($post->ID, ['level', 'departement']);

                    //dump($the_query);

                    $fields = get_fields();
                    ?>


                    <div class="col-lg-6 col-md-6">
                        <div class="single_place" style="background-color: #e6f4fe;">
                            <picture>
                                <img src="<?= $imageURL; ?>" alt="" class="img-fluid">
                            </picture>
                            <div class="hover_Text d-flex align-items-end justify-content-between">
                                <div class="hover_text_iner">
                                    <?php if (!empty($taxonomies)) {
                                        foreach ($taxonomies as $taxonomy) {
                                            echo '<div class="place_btn mr-1">' . $taxonomy->name;
                                            echo '</div>';
                                        }
                                    } ?>
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php
                                        if (!empty($fields['city'])) {

                                            echo $fields['city'];
                                        } else {
                                            echo '-';
                                        }
                                        ?> </p>
                                    <!-- <div class="place_review">
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <span>(210 review)</span>
                            </div> -->
                                </div>
                                <div class="details_icon text-right">
                                    <a href="<?php echo  get_the_permalink(); ?>"><i class="ti-face-smile"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

            <?php endif; ?>

        </div>
        <?php if (is_user_logged_in()) : ?>

            <section class="contact-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h2 class="contact-title">Créez votre spot!</h2>
                        </div>
                        <div class="col-lg-12">
                            <form class="form-contact contact_form" action="#" method="post" id="addSpotForm" novalidate="novalidate" enctype="multipart/form-data">

                                <?php wp_nonce_field('jean', 'coucou'); ?>

                                <div class="row align-items-center ">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="addSpot[name]" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom du spot'" placeholder='Nom du spot'>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group d-flex justify-content-around">
                                            <label for="levelid">Difficulté du spot:</label>
                                            <select name="addSpot[levelId]" id="levelId">
                                                <?php $levelTerms = get_terms(['taxonomy' => 'level', 'hide_empty' => false,]); ?>
                                                <?php foreach ($levelTerms as $level) {
                                                    echo '<option value="' . $level->term_id . '">' . $level->name . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="addSpot[address]" id="address" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Adresse'" placeholder='Adresse'>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="addSpot[city]" id="city" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ville'" placeholder='Ville'>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="addSpot[zipcode]" id="zipcode" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Code postal'" placeholder='Code postal' min="01000" max="99999">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group d-flex justify-content-around">
                                            <label for="departementid">Département :</label>
                                            <select name="addSpot[departementId]" id="departementid">
                                                <?php $departementTerms = get_terms(['taxonomy' => 'departement', 'hide_empty' => false]); ?>
                                                <?php foreach ($departementTerms as $departement) {
                                                    $zipcode = get_field('zipcode', $departement);
                                                    echo '<option value="' . $departement->term_id . '">' . $zipcode . ' - ' . $departement->name . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="picture_upload" id="picture_upload" type="file" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Photo du spot'" placeholder='Photo du spot' accept=".png, .jpeg, .jpg">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="addSpot[description]" id="description" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" placeholder='Description' rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="addSpot[latitude]" id="latitude" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Latitude'" placeholder='Latitude'>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="addSpot[longitude]" id="longitude" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Longitude'" placeholder='Longitude'>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <?php
                                        get_template_part('partials/map.tpl');
                                        ?>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit" class="button button-contactForm btn_1">Créez votre spot</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

    </div>
</section>
<!-- spot list css end -->