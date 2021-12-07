<!--top place start-->

<?php
$args = array(
    'post_type' => 'event',
    'posts_per_page' => 3
);
$the_query = new WP_Query( $args ); ?>

<section class="event_part section_padding">
    <div class="container">  
        <div class="row">
            <div class="col-lg-12">
                <div class="event_slider owl-carousel" >
                    
                <?php if ( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>


                    <div class="single_event_slider">
                        <div class="row justify-content-end">
                            <div class="col-lg-6 col-md-6">
                                <div class="event_slider_content">
                                    <h5>Upcoming Event</h5>
                                    <h2><?php the_title(); ?></h2>
                                    <p><?php the_excerpt(); ?>
                                    </p>
                                    <p>date: <span>12 Aug 2019</span> </p>
                                    <p>Cost: <span>Start from $820</span> </p>
                                    <p>Organizer: <span><a href="<?php echo  get_the_permalink();?>"> <?php the_author(); ?></a></span> </p>
                                    <div class="rating">
                                        <span>Rating:</span>
                                        <div class="place_review">
                                            <a href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                        </div>
                                    </div>
                                    <a href="#" class="btn_1">Plan Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>  
                    <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>  


<!--top place end-->