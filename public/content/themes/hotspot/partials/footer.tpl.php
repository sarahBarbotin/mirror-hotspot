<!-- footer part start-->
<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-8 col-md-7">
                <div class="single-footer-widget">
                    <h4>Découvrir plus</h4>
                    <ul>
                        <li><a href="<?= get_permalink( get_page_by_title( 'mentions'
                                    ) ); ?>">Mentions Légales</a></li>
                        <li><a href="<?= get_permalink( get_page_by_title( 'about'
                                    ) ); ?>">About</a></li>
                    </ul>
                    <a class="navbar-brand mt-4" href="<?= get_home_url(); ?>"> <img src="<?php echo get_theme_file_uri('assets/img/logo.png'); ?>" alt="logo"> </a>

                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="single-footer-widget footer_icon">
                    <h4>Contactez nous</h4>
                    <p>99666, Chamelon, Wonderland
                        +880 362 352 783</p>
                    <span>suppot@hotspot.com</span>
                    <div class="social-icons">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                        <a href="#"><i class="ti-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="copyright_part_text text-center">
                    <p class="footer-text m-0">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer part end-->