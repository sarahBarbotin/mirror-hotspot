<!-- banner part start-->

<section class="banner_part">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="banner_text text-center">
                    <div class="banner_text_iner">
                        <h1> Welcome to Hotspot</h1>
                        <p><?=get_bloginfo('description');?></p>

                        <?php
                            if(!is_user_logged_in()) {
                                echo '<a href="' . wp_login_url() . '" class="btn_1 mr-5">Connexion</a>';
                                echo '<a href="'. wp_registration_url() .'" class="btn_1">Inscription</a>';
                            }
                            else {
                                $user = wp_get_current_user();
                                global $router;
                                
                                
                                $userID = get_current_user_id();
                                $surferProfile = new WP_Query(
                                    ['post_type' => 'surfer-profile',
                                    'author' => $userID]
                                );
                                echo '<a href="'; //$surferProfile->posts[0]->guid .
                                echo '" class="btn_1 mr-2">Mon Profil</a>';
                                
                        
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner part start-->