
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

    <section class="blog_area single-post-area section_padding">
        <div class="container">
            <div>
                <img src="<?= get_theme_file_uri('assets/img/404.png'); ?>" alt="error 404 - surfer falling" class="img-fluid">
            </div>
            <div class="row justify-content-center my-3">
                <div>
                    <a href="<?= get_home_url() ?>" class="btn_1">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </section>


<!-- Footer start -->
<?php
        get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php get_footer(); ?>
</body>

</html>