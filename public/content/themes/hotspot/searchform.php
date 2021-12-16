<div>
<form class="form-contact contact_form" id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="form-control search-input" name="s" placeholder="Recherche" value="<?php echo get_search_query(); ?>">
    <input type="submit" value="Recherche" hidden>
</form>
</div>