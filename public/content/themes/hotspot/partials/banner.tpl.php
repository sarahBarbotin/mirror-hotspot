<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-left">
                    <?php
                    if(is_user_logged_in()) {
                        $user = wp_get_current_user();
                        
                        echo "<h2>Profil</h2>";
                    }
                    else{
                        echo '<h2>Liste d\'event ou de spots (dynamiser)</h2>';
                    }
                ?>
                        
                        <p>home . blog</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
                            }