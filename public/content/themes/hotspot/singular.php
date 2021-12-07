<?php
the_post();
?>


<!doctype html>
<html lang="<?=get_bloginfo('language');?>">

<head>
<?php get_header(); ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    
</head>

<body>
    <!-- Header start-->
    <?php
        get_template_part('partials/navbar.tpl');
    ?>

    <?php
        get_template_part('partials/banner.tpl');
    ?>
    <!-- Header end -->

    <!--================Blog Area =================-->

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
        $taxonomies = wp_get_post_terms( $post->ID, ['level','departement', 'event_discipline'] );

        dump($taxonomies);
        //dump($the_query);

        $fields = get_fields();
        dump($fields);
    ?>

    <section class="blog_area single-post-area section_padding">
        <div class="container">
            <div class="row">
                <div class="posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <!-- Image -->
                            <img class="img-fluid" src="<?php echo $imageURL?>" alt="">
                        </div>
                        <div class="blog_details">
                            <!-- Title -->
                            <h2><?= get_the_title() ?>
                     </h2>
                            <!-- Tags & nb comments-->
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><i class="far fa-user"></i> 
                                <?php if(!empty($taxonomies)) {
                                foreach($taxonomies as $taxonomy) {
                                    echo $taxonomy->name . ' ';
                                }
                            } ?></li>
                                <li><a href="#"><i class="far fa-comments"></i> 03 Comments</a></li>
                            </ul>
                            <!-- excert -->
                            <p class="excert">
                            <?= get_the_content(); ?>
                            </p>
                            
                            <!-- spot map -->
                            <div class="quote-wrapper">
                                <div class="quotes">
                                <div class="col-lg-6">
                                    MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training.
                                </div>
                                
                                <div class="">
                                <div class="d-none d-sm-block">
                                    <div id="map" style="height: 480px; background-color:aqua;"></div>
                                    <script>
                                        function initMap() {
                                            var uluru = {
                                                lat: -25.363,
                                                lng: 131.044
                                            };
                                            var grayStyles = [{
                                                featureType: "all",
                                                stylers: [{
                                                    saturation: -90
                                                }, {
                                                    lightness: 50
                                                }]
                                            }, {
                                                elementType: 'labels.text.fill',
                                                stylers: [{
                                                    color: '#ccdee9'
                                                }]
                                            }];
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                center: {
                                                    lat: -31.197,
                                                    lng: 150.744
                                                },
                                                zoom: 9,
                                                styles: grayStyles,
                                                scrollwheel: false
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <!-- participation -->
                            <p class="like-info"><span class="align-middle"><i class="far fa-heart"></i></span> Lily and 4 people like this</p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <!-- <p class="comment-count"><span class="align-middle"><i class="far fa-comment"></i></span> 06 Comments</p> -->
                            </div>

                            <!-- SOCIAL MEDIA -->
                            
                            <!-- <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul> -->
                        </div>

                        <!-- NAVIGATION -->

                        <!-- <div class="navigation-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    <div class="thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="img/post/preview.png" alt="">
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white ti-arrow-left"></span>
                                        </a>
                                    </div>
                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="#">
                                            <h4>Space The Final Frontier</h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="#">
                                            <h4>Telescopes 101</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="img/post/next.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>

                    <!-- Author -->
                    <div class="blog-author">
                        <div class="media align-items-center">
                            <div><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></div>
                            <div class="media-body">
                                <a href="#">
                                    <h4><?= get_the_author(); ?></h4>
                                </a>
                                <p>
                                Second divided from form fish beast made. Every of seas all gathered use saying you're, he our dominion twon Second divided from</p>
                            </div>
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="comments-area">
                        <h4>05 Comments</h4>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="<?php echo get_theme_file_uri('assets/img/comment/comment_1.png');?>" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            Multiply sea night grass fourth day sea lesser rule open subdue female fill which them Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                       <a href="#">Emilly Blunt</a>
                                    </h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="<?php echo get_theme_file_uri('assets/img/comment/comment_2.png');?>" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            Multiply sea night grass fourth day sea lesser rule open subdue female fill which them Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                       <a href="#">Emilly Blunt</a>
                                    </h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="<?php echo get_theme_file_uri('assets/img/comment/comment_3.png');?>" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            Multiply sea night grass fourth day sea lesser rule open subdue female fill which them Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                       <a href="#">Emilly Blunt</a>
                                    </h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reply -->
                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form class="form-contact comment_form" action="#" id="commentForm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-contactForm btn_1">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- a lot of asides -->
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->

   
    <!-- Footer start -->
    <?php
        get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php get_footer(); ?>
</body>

</html>