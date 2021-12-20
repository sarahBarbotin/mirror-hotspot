<!--::header part start::-->
<header class="main_menu">
    <div class="main_menu_iner">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                        <a class="navbar-brand" href="<?= get_home_url(); ?>"> <img src="<?php echo get_theme_file_uri('assets/img/logo.png');?>" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-center"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="<?=get_home_url();?>">Home</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= get_permalink( get_page_by_title( 'about'
                                    ) ); ?>">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=get_post_type_archive_link('event');?>">Events</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=get_post_type_archive_link('spot');?>">Spots</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= get_permalink( get_page_by_title( 'contact'
                                    ) ); ?>">Contact</a>
                                </li>
                                <li class="nav-item search-form">
                                    <span class="nav-item">
                                        <?php get_search_form(); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <?php
                            if(!is_user_logged_in()) {
                                echo '<a href="' . wp_login_url() . '" class="btn_1 d-none d-lg-block ml-2">Connexion</a>';
                                echo '<a href="'. wp_registration_url() .'" class="btn_2 d-none d-lg-block ml-2">Inscription</a>';
                            }
                            else {
                                $user = wp_get_current_user();
                                global $router;
                                
                                // TODO
                                //route custom pour afficher le profil
                                // echo '<li><a href="' . $url . '">' . $user->display_name . '</a></li>';
                                $userID = get_current_user_id();
                                $surferProfile = new WP_Query(
                                    ['post_type' => 'surfer-profile',
                                    'author' => $userID]
                                );

                                echo '<a href="'. $surferProfile->posts[0]->guid .'" class="btn_1 d-none d-lg-block ml-2">Profil</a>';
                                echo '<a href="'. wp_logout_url() .'" class="btn_2 d-none d-lg-block ml-2">Déconnexion</a>';

                                
                            }
                        ?>


                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header part end-->