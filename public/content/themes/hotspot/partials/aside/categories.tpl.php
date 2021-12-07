
<?php
    // Récupération des taxonomies
    $taxonomies = get_terms();
    // dump($taxonomies);
?>


<aside class="single_sidebar_widget post_category_widget">
    <h4 class="widget_title">Category</h4>
    <ul class="list cat-list">

<?php foreach ($taxonomies as $taxonomy){ ?>

        <li>
            <a href="#" class="d-flex">
                <p><?php echo $taxonomy->name; ?></p>
                <p>(37)</p>
            </a>
        </li>
        
        <?php } ?>
        
    </ul>
</aside>   

