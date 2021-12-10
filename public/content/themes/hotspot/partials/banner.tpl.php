<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-left">
                        <h2>
                            <?php                            
                            if(is_post_type_archive( 'event' )) {
                                echo ("Liste des évènement");
                            } elseif (is_post_type_archive( 'spot' )) {
                                echo ("Liste des spots");
                            } else {
                                echo (get_the_title());
                            }                           
                           ?>
                            
                        </h2>';
                        <p class="breadcrumbs"><?php get_breadcrumb(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
