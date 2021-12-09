<!DOCTYPE html>
<html lang="<?=get_bloginfo('language');?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotspot</title>
    <?php
    use Hotspot\Models\SurferEventModel;
    get_header();
    ?>
</head>

<?php get_template_part('partials/navbar.tpl'); ?>

<!--================================================================================-->


        <?php

        $user = wp_get_current_user();
        $userId = $user->ID;
        $avatar = get_field('avatar', 'user_' . $userId);

        if(!empty($avatar)) {
            $backgroundImage = $avatar['url'];
            $style = 'background:' .
            'radial-gradient(circle, rgba(255, 255, 255, 0.5) 45%, rgba(136, 81, 133, 0.5) 100%),' .
            'linear-gradient(100deg, aqua 0%, rgba(0, 255, 255, 0) 100%),'.
            'url(' . $backgroundImage . ')'
        ;
        }
        else {
            $backgroundImage = get_theme_mod('hero-picture');

            $style = '';
            if($backgroundImage) {
                $style = 'background:' .
                    'radial-gradient(circle, rgba(255, 255, 255, 0.5) 45%, rgba(136, 81, 133, 0.5) 100%),' .
                    'linear-gradient(100deg, aqua 0%, rgba(0, 255, 255, 0) 100%),'.
                    'url(' . $backgroundImage . ')'
                ;
            }
        }
        ?>



<?php
    get_footer();
    ?>
</body>
</html>