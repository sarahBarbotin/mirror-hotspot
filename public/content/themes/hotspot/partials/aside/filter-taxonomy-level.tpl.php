
<?php

$levels = get_terms(array('level'));
$postType = get_query_var('post_type');

?>

<!-- Niveau -->
<aside class="single_sidebar_widget post_category_widget">
<h4 class="widget_title">Niveaux</h4>
<ul class="list cat-list">

<?php foreach ($levels as $level){ ?>

    <li>
        <p>
            <a href="<?= add_query_arg('post_type', $postType, get_term_link( $level, 'level' ));?>" class="d-flex">
                <?= $level->name; ?>
            </a>
        </p>
    </li>
    
    <?php } ?>
    
</ul>
</aside>   





