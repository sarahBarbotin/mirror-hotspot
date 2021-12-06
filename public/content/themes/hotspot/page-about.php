<!doctype html>
<html lang="<?=get_bloginfo('language');?>">

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


    <?php
        get_template_part('partials/content/who-we-are.tpl');
        get_template_part('partials/content/developpers.tpl');
    ?>


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