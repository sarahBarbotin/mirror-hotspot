<?php
$articleId = get_the_id();
$hasImage = has_post_thumbnail($articleId);
if ($hasImage) {
    $imageURL = get_the_post_thumbnail_url();
} else {
    $imageURL = 'https://picsum.photos/300/200?random=1';
}
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
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap">
                                </script>

                            </div>
                        </div>
                    </div>

                    
                    <!-- Comments -->
                    <?php
                        // Arguments for the query
                        $args = array();

                        // The comment query
                        $comments_query = new WP_Comment_Query;
                        $comments = $comments_query->query($args);

                        
                    ?>
                    <div class="comments-area">
                        <h4>05 Comments</h4>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="<?php echo get_theme_file_uri('assets/img/comment/comment_1.png'); ?>" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            <?php 
                                                // The comment loop
                                                if (!empty($comments)) {
                                                    foreach ($comments as $comment) {
                                                        echo $comment->comment_content;
                                                    }
                                                } else {
                                                    echo 'No comments found.';
                                                } 
                                            ?>
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
            </div>
        </div>
    </div>
</section>