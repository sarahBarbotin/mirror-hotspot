<!doctype html>
<html lang="<?= get_bloginfo('language'); ?>">

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

    <!--==============================================-->
    <section class="best_services section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php

                    $s = get_search_query();
                    $args = array(
                        's' => $s
                    );

                    // The Query
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {
                        _e("<h2>Résultats de recherche pour : " . get_query_var('s') . "</h2>");
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                    ?>

                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>

                    <?php }} else { ?>

                        <h2>Rien n'a été trouvé</h2>
                        <div class="alert alert-info">
                            <p class="py-2">Désolé, mais aucun résultat ne correspond à votre recherche.</p>
                            <a class="btn_1" href="<?= get_home_url(); ?>">Retour à l'accueil</a>  
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!--==============================================-->

    <!-- Footer start -->
    <?php
    get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php get_footer(); ?>
</body>

</html>