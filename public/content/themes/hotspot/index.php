<!doctype html>
<html lang="<?=get_bloginfo('language');?>">

<head>
<?php get_header(); ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <!-- <link rel="icon" href="<?php echo get_theme_file_uri('assets/img/favicon.png');?>">
     -->
</head>

<body>

    <!-- Header start-->
    <?php
        get_template_part('partials/navbar.tpl');
    ?>
    <?php
        get_template_part('partials/home/jumbotron.tpl');
    ?>
    <!-- Header end -->

    <!-- Content start -->
    <?php
        get_template_part('partials/home/home-spots.tpl');
    ?>

    <?php
        get_template_part('partials/home/home-events.tpl');
    ?>
    <!-- Content end -->


    <!-- Footer start -->
    <?php
        get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php get_footer(); ?>
</body>

</html>