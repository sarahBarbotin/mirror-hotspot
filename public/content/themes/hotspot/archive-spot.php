<!doctype html>
<html lang="<?= get_bloginfo('language'); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <?php
    get_header();
    ?>
</head>

<body>
    <!-- Header start-->
    <?php
    get_template_part('partials/navbar.tpl');
    get_template_part('partials/banner.tpl');

    ?>
    <!-- Header end -->



    <section class="blog_area">
        <div class="container">
            <div class="row">

                <!-- list left col -->
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <!-- Spots List -->
                        <?php
                        get_template_part('partials/spots/spots-list.tpl');
                        
                        ?>

                    </div>
                </div>

                <!-- end left col -->

                <!-- Aside (right col) -->
                <div class="col-lg-4 mt-5">
                    <div class="blog_right_sidebar">

                    <?php
                        get_template_part('partials/aside/filter-taxonomy-level.tpl');
                        get_template_part('partials/aside/filter-taxonomy-departement.tpl');
                        ?>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- Footer start -->
    <?php
    get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php
    get_footer();
    ?>
</body>

</html>