<!-- hotel list css start-->
<?php

$taxonomyFilter = get_query_var('taxonomy');
$termFilter = get_query_var('term');

if (!empty($taxonomyFilter) && !empty($termFilter)) {
    $spotList = new WP_Query(
        [
            'post_type' => 'spot',
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomyFilter,
                    'terms' => $termFilter,
                    'field' => 'slug',
                )
            ),
            'posts_per_page' => 10,
            'order' => 'ASC',
            'orderby' => 'rand'
        ],
    );
    
} else {
    $spotList = new WP_Query(
        [
            'post_type' => 'spot',
            'posts_per_page' => 10,
            'order' => 'ASC',
            'orderby' => 'rand'
        ],
    );
}
?>

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

            <?php if ($spotList->have_posts()) : ?>
                <?php while ($spotList->have_posts()) : $spotList->the_post(); ?>

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

                    $city = get_post_field('city');
                    
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
                                    <p>
                                        <?php
                                        if (!empty($city)) {

                                            echo $city;

                                        } else {

                                            echo '-';
                                        }
                                        ?> 
                                    </p>
                                </div>
                                <div class="details_icon text-right">
                                    <a href="<?php echo  get_the_permalink(); ?>"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php endwhile; ?>

            <?php endif; ?>

        </div>

        <?php
            get_template_part('partials/pagination.tpl');
            get_template_part('partials/spots/spot-form.tpl');
        ?>

    </div>
</section>
<!-- spot list css end -->