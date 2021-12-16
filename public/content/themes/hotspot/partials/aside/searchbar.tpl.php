<aside class="single_sidebar_widget search_widget">
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="form-group">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder='Recherche'
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Recherche'" value="<?php echo get_search_query(); ?>" name="s">
                <div class="input-group-append">
                    <button class="btn" type="button"><i class="ti-search"></i></button>
                </div>
            </div>
        </div>
        <button class="button rounded-0 primary-bg text-white w-100 btn_1"
            type="submit" value="Recherche">Recherche</button>
    </form>
</aside>