<?php /* Template Name: Page contact */ ?>
<!doctype html>
<html lang="<?=get_bloginfo('language');?>">

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
    ?>

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">

            <?php
                get_template_part('partials/map.tpl');
            ?>

            </div>

            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title mt-5">Restons en contact</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">

                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre message'" placeholder='Votre message'></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre nom'" placeholder='Votre nom'>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre email'" placeholder='Votre email'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm btn_1">Envoyer</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Wonderland, Chameleon.</h3>
                            <p>Spica, SP 99666</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>00 (440) 9865 562</h3>
                            <p>Les jours de joyeux non-anniversaire, de 9h à 17h</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>support@hotspot.com</h3>
                            <p>Joyeux Noël 2021 !</p>
                        </div>
                    </div>
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