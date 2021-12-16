<?php

    // Récupération des taxonomies
    $departements = get_terms(array('departement'));
?>

<!-- Discipline -->

<aside class="single_sidebar_widget post_category_widget">
<h4 class="widget_title">Départements</h4>
<ul class="list cat-list">

<?php foreach ($departements as $departement){ ?>

    <li>
        <a href="<?= add_query_arg('post_type', 'spot', get_term_link( $departement, 'departement' ));?>" class="d-flex">
            <p><?= $departement->name; ?></p>
        </a>
    </li>
    
    <?php } ?>
    
</ul>
</aside>  