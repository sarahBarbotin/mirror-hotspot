<!doctype html>
<html lang="<?= get_bloginfo('language'); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <?php
    get_header();
    ?>
</head>

<body>

    <!-- Header start-->
    <?php
    get_template_part('partials/navbar.tpl');
    get_template_part('partials/banner.tpl');
    // echo get_post_type_archive_link('spot'). '<br/>';
    // echo get_post_type_archive_link('event'). '<br/>';
    // echo 'http://localhost'.$_SERVER['REQUEST_URI'] . '<br/>';
?>


    <!-- ================ contact section start ================= -->


    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-8 mb-4">
                    <h2 class="contact-title">Créez votre spot!</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="#" method="post" id="addSpotForm" novalidate="novalidate" enctype="multipart/form-data">

                    <?php wp_nonce_field('jean', 'coucou'); ?>

                        <div class="row align-items-center ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="addSpot[name]" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom du spot'" placeholder='Nom du spot'>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group d-flex justify-content-around">
                                    <label for="levelid">Difficulté du spot:</label>
                                    <select name="addSpot[levelId]" id="levelId">
                                        <option value="1">Débutant</option>
                                        <option value="2">Intermédiaire</option>
                                        <option value="3">Expert</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="addSpot[address]" id="address" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Adresse'" placeholder='Adresse'>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="addSpot[city]" id="city" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ville'" placeholder='Ville'>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="addSpot[zipcode]" id="zipcode" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Code postal'" placeholder='Code postal' min="01000" max="99999">
                                </div>
                            </div>
                            <!-- TODO Dépratement = menu déroulant des départements existants -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="addSpot[departementId]" id="departementId" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Departement'" placeholder='Departement'>
                                </div>
                            </div>
                            

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="picture_upload" id="picture_upload" type="file" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Photo du spot'" placeholder='Photo du spot' accept=".png, .jpeg, .jpg">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="addSpot[description]" id="description" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" placeholder='Description' rows="8"></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <?php
                                get_template_part('partials/map.tpl');
                            ?>
                        </div>
                        <div class="col-sm-6">
                                <div class="form-group mt-3">
                                    <input class="form-control" name="addSpot[latitude]" id="latitude" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Latitude'" placeholder='Latitude'>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="addSpot[longitude]" id="longitude" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Longitude'" placeholder='Longitude'>
                                </div>
                            </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm btn_1">Créez votre spot</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

    <!-- Footer start -->
    <?php
    get_template_part('partials/footer.tpl');
    ?>
    <!-- Footer end -->

    <?php
    get_footer();
    ?>
</body>

</html>