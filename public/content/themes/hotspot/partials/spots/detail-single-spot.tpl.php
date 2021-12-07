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
                            <div class="blog-author">
                                <div class="media align-items-center">
                                    <img src="<?= $imageURL; ?>" alt="">
                                    <div class="media-body">
                                        <a href="#">
                                            <h4><?= get_the_title() ?></h4>
                                        </a>
                                        <p><i class="fas fa-swimmer"></i>
                                            <?php
                                            $spotAdress = get_field('level');
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-sm-block mb-5 pb-4">
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

                    <!-- profile description -->
                    <div class="quote-wrapper">
                        <div class="quotes">
                            <?= get_the_content(); ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>