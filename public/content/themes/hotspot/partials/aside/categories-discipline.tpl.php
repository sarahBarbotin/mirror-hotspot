<?php

    // Récupération des taxonomies
    $eventDisciplines = get_terms(array('event_discipline'));
?>

<!-- Discipline -->

<aside class="single_sidebar_widget post_category_widget">
    <h4 class="widget_title">Disciplines (event)</h4>
    <ul class="list cat-list">

<?php foreach ($eventDisciplines as $eventDiscipline){ ?>

        <li>
            <a href="#" class="d-flex">
                <p><?php echo $eventDiscipline->name; ?></p>
            </a>
        </li>
        
        <?php } ?>
        
    </ul>
</aside>  