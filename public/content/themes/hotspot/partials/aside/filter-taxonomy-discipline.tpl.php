<?php

    // Récupération des taxonomies
    $disciplines = get_terms(array('event_discipline'));
?>

<!-- Discipline -->

<aside class="single_sidebar_widget post_category_widget">
<h4 class="widget_title">Disciplines</h4>
<ul class="list cat-list">

<?php foreach ($disciplines as $discipline){ ?>

    <li>
        <a href="<?= get_term_link( $discipline, 'event_discipline' );?>" class="d-flex">
            <p><?= $discipline->name; ?></p>
        </a>
    </li>
    
    <?php } ?>
    
</ul>
</aside>  