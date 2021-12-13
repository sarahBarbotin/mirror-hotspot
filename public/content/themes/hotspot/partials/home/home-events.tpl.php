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
                        <?php $spotId = get_field('spot_id'); ?>
                        <!-- Vérification gardée par sécurité -->
                        <?php if(isset($spotId)) {
                            $spot = get_post($spotId);
                         } 
                        
                        $authorProfileQuery = new WP_Query ([
                            'post_type' => 'surfer-profile',
                            'author' => get_the_author_meta('ID')
                        ]) ?>
                                        <div class="single_event_slider">
                                            <div class="row justify-content-end">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="event_slider_content">
                                                        <h5><a href="<?= get_the_permalink() ?>"><?= get_the_title() ?></a></h5>
                                                        <h2><?= $spot->post_title ?></h2>
                                                        <p>
                                                        <?= get_the_excerpt(); ?>
                               
                                                        </p>
                                                        <p>Date: <span><?= date("d/m/Y", strtotime($post->date)); ?></span> </p>
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
                                                        <p>Organisé par: <a href="<?=$authorProfileQuery->posts[0]->guid ?>"> <?= $authorProfileQuery->posts[0]->post_title ?></a> </p>
                                                        
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
                                                        <a href="<?= get_the_permalink() ?>" class="btn_1">Voir l'évènement</a>
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