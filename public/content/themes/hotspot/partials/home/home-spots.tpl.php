<!--top place start-->

<?php
$args = array(
    'post_type' => 'spot',
    'posts_per_page' => 6
);
$the_query = new WP_Query( $args ); ?>


<section class="top_place section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section_tittle text-center">
                    <h2>Top Spots</h2>
                    <p>Waters make fish every without firmament saw had. Morning air subdue. Our. Air very one. Whales grass is fish whales winged.</p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <?php
                // Récupération des images thumbnail
                $articleId = get_the_id();
                $hasImage = has_post_thumbnail($articleId);
                if($hasImage) {
                    $imageURL = get_the_post_thumbnail_url();
                }
                else {
                    $imageURL = 'https://picsum.photos/300/200?random=1';
                }

                // Récupération des taxonomies
                $taxonomies = wp_get_post_terms( $post->ID, ['level','departement'] );

                //dump($the_query);

                $fields = get_fields();
            ?>

            <div class="col-lg-4 col-md-6">
                <div class="single_place">
                    <img src="<?=$imageURL;?>" alt="">
                    <div class="hover_Text d-flex align-items-end justify-content-between">
                        <div class="hover_text_iner">

                        <?php if(!empty($taxonomies)) {
                                foreach($taxonomies as $taxonomy) {
                                    echo '<div class="place_btn">'. $taxonomy->name;
                                    echo '</div> ';
                                }
                            } ?>
                            
                            <h3><?php the_title(); ?></h3>
                            <p> 
                                <?php 
                                    if(!empty($fields['city'])){

                                        echo $fields['city'];
                                    } else {
                                        echo '-';
                                    }
                                ?> 
                            
                            </p>
                            <!-- REVIEWS Spots -->
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
                            <a href="<?php echo  get_the_permalink();?>"><i class="ti-face-smile"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile; ?>  
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>

            
            <a href="<?=get_post_type_archive_link('spot');?>" class="btn_1 text-cnter">Discover more</a>
        </div>
    </div>
</section>
<!--top place end-->