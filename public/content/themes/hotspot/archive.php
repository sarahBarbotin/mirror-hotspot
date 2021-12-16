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
    ?>

    <?php
    get_template_part('partials/banner.tpl');
    ?>

    <!-- Header end -->
    <!--================Blog Area =================-->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">

                <!-- Event list left col -->
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        <!-- Liste -->
                        <?php
                        get_template_part('partials/events/events-list.tpl');
                        ?>

                        <!-- Pagination -->
                        <?php
                        get_template_part('partials/pagination.tpl');
                        ?>

                    </div>
                </div>
                <!-- end left col -->

                <!-- Aside (right col) -->
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">

                        <?php
                        get_template_part('partials/aside/searchbar.tpl');
                        ?>

                        <?php

                        get_template_part('partials/aside/filter-taxonomy-level.tpl');
                        get_template_part('partials/aside/filter-taxonomy-discipline.tpl');

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section mx-sm-4">
    <div class="container">
            <div class="row">
        <?php
        get_template_part('partials/events/event-form.tpl');
        ?>
            </div>
    </div>
    </section>
    <!--================Blog Area =================-->

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