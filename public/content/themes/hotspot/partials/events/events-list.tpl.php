<!-- Event list left col -->

<?php

$taxonomyFilter = get_query_var('taxonomy');
$termFilter = get_query_var('term');
$pageFilter = get_query_var('paged');

if (!empty($taxonomyFilter) && !empty($termFilter)) {

    $paged = ( $pageFilter ) ? $pageFilter : 1; 
    $eventList = new WP_Query(
        [
            'post_type' => 'event',
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomyFilter,
                    'terms' => $termFilter,
                    'field' => 'slug',
                )
            ),
            'paged' => $paged,
            'posts_per_page' => 6,
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_key' => 'date',
        ],
    );
    
} else {

    $paged = ( $pageFilter ) ? $pageFilter : 1; 
    $eventList = new WP_Query(
        [
            'post_type' => 'event',
            'paged' => $paged,
            'posts_per_page' => 6,
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_key' => 'date'
        ],
    );
}



if ($eventList->have_posts()) {
    while ($eventList->have_posts()) {
        $eventList->the_post();
?>

        <article class="blog_item">
            <div class="blog_item_img">
                <?php
                $articleId = get_the_id();
                $hasImage = has_post_thumbnail($articleId);
                if ($hasImage) {
                    $imageURL = get_the_post_thumbnail_url();
                } else {
                    $imageURL = 'https://picsum.photos/300/200?random=1';
                }
                ?>
                <img class="card-img rounded-0" src="<?= $imageURL ?>" alt="image de l'event">
                <div class="blog_item_date">
                    <h3><?= date("d", strtotime($post->date)); ?></h3>
                    <p><?= date("M", strtotime($post->date)); ?></p>
                </div>
            </div>

            <div class="blog_details">
                <a class="d-inline-block" href="<?= get_the_permalink() ?>">
                    <h2><?= get_the_title() ?></h2>
                </a>
                <p><?= get_the_excerpt() ?></p>
                <ul class="blog-info-link">
                    <li><i class="far"></i>
                        <?php
                        $disciplines = wp_get_post_terms($post->ID, 'event_discipline');
                        if (empty($disciplines)) {
                            echo ("Libre");
                        } else {
                            foreach ($disciplines as $discipline) {
                                echo ('<span>' . $discipline->name . "</span>");
                            }
                        }
                        ?>
                    </li>
                    <li><i class="far"></i>
                        <?php
                        $levels = wp_get_post_terms($post->ID, 'level');
                        if (empty($levels)) {
                            echo ("Tout niveaux");
                        } else {
                            foreach ($levels as $level) {
                                echo ('<span>' . $level->name . "</span>");
                            }
                        }
                        ?>
                    </li>
                    <li><i class="far fa-comments"></i> <?= get_comments_number() ?> Commentaires</li>
                </ul>
            </div>
        </article>

<?php }
} ?>

<?php if (function_exists('custom_pagination')) { $paginationLinks = custom_pagination($eventList->max_num_pages, "", $paged);}?> 
                                        
<?php wp_reset_postdata(); ?> 

<?php
    get_template_part('partials/pagination.tpl', null, ['pagination_links' => $paginationLinks]);
?>