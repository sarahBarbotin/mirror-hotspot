
<?php

$levels = get_terms(array('level'));

?>

<!-- Niveau -->
<aside class="single_sidebar_widget post_category_widget">
<h4 class="widget_title">Niveaux</h4>
<ul class="list cat-list">

<?php foreach ($levels as $level){ ?>

    <li>
        <p>
            <a href="<?= get_term_link( $level, 'level' );?>" class="d-flex">
                <?= $level->name; ?>
            </a>
        </p>
    </li>
    
    <?php } ?>
    
</ul>
</aside>   





