 <!--top place start-->
    <section class="event_part section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="event_slider owl-carousel">

                        <?php
                        $homeEvents = new WP_Query(
                            ['post_type' => 'event',
                            'posts_per_page' => 5,
                            'order' => 'ASC',
                            'orderby' => 'meta_value',
                            'meta_key' => 'date']
                        );
                        if ($homeEvents->have_posts()) {

                            while ($homeEvents->have_posts()) {
                                $homeEvents->the_post();
                        ?>                                
                                        <div class="single_event_slider">
                                            <div class="row justify-content-end">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="event_slider_content">
                                                        <h5><?= get_the_title() ?></h5>
                                                        <h2>Nom du spot (à coder)</h2>
                                                        <p>
                                                        <?= get_the_excerpt(); ?>
                               
                                                        </p>
                                                        <p>date: <span><?= date("d/m/Y", strtotime($post->date)); ?></span> </p>
                                                        <p>Disciplines : 
                                                            <?php 
                                                                $disciplines = wp_get_post_terms( $post->ID, 'event_discipline' );
                                                                if (empty($disciplines)) {
                                                                    echo("Libre");
                                                                } else {
                                                                    foreach ($disciplines as $discipline) {
                                                                        echo('<span>'.$discipline->name."</span></br>");
                                                                    }
                                                                }
                                                            ?>
                                                        </p>
                                                        <p>Organisé par: <span> <?= get_the_author(); ?></span> </p>
                                                        <p>Niveaux acceptés : 
                                                            <?php 
                                                                $levels = wp_get_post_terms( $post->ID, 'level' );
                                                                if (empty($levels)) {
                                                                    echo("Tous");
                                                                } else {
                                                                    foreach ($levels as $level) {
                                                                        echo('<span>'.$level->name."</span></br>");
                                                                    }
                                                                }
                                                            ?>
                                                        </p>
                                                        <a href="#" class="btn_1">Je participe (coder la fonction)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        <?php }
                        } ?>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--top place end-->