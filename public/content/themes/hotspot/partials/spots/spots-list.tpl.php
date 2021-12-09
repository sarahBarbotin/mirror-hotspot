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
        <?php get_template_part('partials/spots/spot-form.tpl'); ?>
    </div>
</section>
<!-- spot list css end -->