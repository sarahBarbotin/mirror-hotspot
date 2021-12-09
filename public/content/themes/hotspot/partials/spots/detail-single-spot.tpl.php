<?php

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

$fields = get_fields();


?>

<section class="blog_area single-post-area my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 posts-list">
                <div class="single-post">
                    <!-- Author -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog-author" style="margin-top:0;height:100%;">
                                <div class="media align-items-center">
                                    <img src="<?= $imageURL; ?>" alt="">
                                    <div class="media-body">
                                        <a href="#">
                                            <h4><?= get_the_title() ?></h4>
                                        </a>
                                        <p><i class="fas fa-swimmer"></i>
                                            <?php
                                            $taxonomies = wp_get_post_terms($post->ID, ['level']);
                                            if (!empty($taxonomies)) {
                                                foreach ($taxonomies as $taxonomy) {
                                                    echo $taxonomy->name;
                                                }
                                            }
                                            ?>
                                        </p>
                                        <p><i class="fas fa-map-pin"></i>
                                            <?php
                                            $surferCity = get_field('city');
                                            echo $surferCity;
                                            ?>
                                        </p>
                                        <p><i class="fas fa-map-marker-alt"></i>
                                            <?php
                                            $surferZipcode = get_field('zipcode');
                                            echo $surferZipcode;
                                            ?>
                                        </p>
                                        <p><i class="fas fa-swimmer"></i>
                                            <?php
                                            $taxonomies = wp_get_post_terms($post->ID, ['departement']);
                                            if (!empty($taxonomies)) {
                                                foreach ($taxonomies as $taxonomy) {
                                                    echo $taxonomy->name;
                                                }
                                            }
                                            ?>
                                        </p>
                                    </div>

                                </div>
                                <div class="mt-3">
                                    <?= get_the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-sm-block">
                                <div id="map" style="height: 480px;"></div>



                            </div>
                        </div>
                    </div>

                  
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</section>