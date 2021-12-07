
<?php
    // Récupération des taxonomies
    $taxonomies = get_terms();

    $levels = get_terms(array('level'));
    $departements = get_terms(array('departement'));
    $eventDisciplines = get_terms(array('event_discipline'));
?>

<!-- Niveau -->
<aside class="single_sidebar_widget post_category_widget">
    <h4 class="widget_title">Niveau(event et spot)</h4>
    <ul class="list cat-list">

<?php foreach ($levels as $level){ ?>

        <li>
            <a href="#" class="d-flex">
                <p><?php echo $level->name; ?></p>
            </a>
        </li>
        
        <?php } ?>
        
    </ul>
</aside>   

<!-- Département -->
<aside class="single_sidebar_widget post_category_widget">
    <h4 class="widget_title">Départements(event et spot)</h4>
    <ul class="list cat-list">

<?php foreach ($departements as $departement){ ?>

        <li>
            <a href="#" class="d-flex">
                <p><?php echo $departement->name; ?></p>
            </a>
        </li>
        
        <?php } ?>
        
    </ul>
</aside>  

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

