<!-- banner part start-->

<section class="banner_part">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="banner_text text-center">
                    <div class="banner_text_iner">
                        <h1> Hotspot</h1>
                        <p><?=get_bloginfo('description');?></p>

                        <?php
                            if(!is_user_logged_in()) {
                                echo '<a href="' . wp_login_url() . '" class="btn_1 ">Connexion</a>';
                                echo '<a href="'. wp_registration_url() .'" class="btn_1">Inscription</a>';
                            }
                            else {
                                $user = wp_get_current_user();
                                global $router;
                                
                                // TODO
                                //route custom pour afficher le profil
                                // echo '<li><a href="' . $url . '">' . $user->display_name . '</a></li>';
                                echo '<a href="#" class="btn_1">Mon Profil</a>';
                                echo '<a href="'. wp_logout_url() .'" class="btn_1">Déconnexion</a>';
                        
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner part start-->