<?php

namespace Hotspot;

use WP_User;

// DOC USER REGISTRATION hooks order https://usersinsights.com/wordpress-user-registration-hooks-visualized/

// BONUS E9 REGEXP http://www.expreg.com/ancrages.php

class UserRegistration
{
    public function __construct()
    {

        // customisation du formulaire======================== =========================
        // chargement d'un css custom sur les pages de login/register
        add_action(
            'login_enqueue_scripts',
            [$this, 'loadAssets']
        );


        // ajout de code html dans le formulaire d'inscription de wordpress
        add_action(
            'register_form',
            [$this, 'addCustomFields']
        );


        // Une fois le formulaire soumis, controle des erreurs =========================

        // STEP REGISTER controles custom du formulaire
        add_action(
            'registration_errors',
            [$this, 'checkErrors']
        );

        // Une fois l'utilsateur à été créé ==================================================

        // STEP REGISTER affectation du bon role à l'utilisateur qui vient d'être créé, puis création de sa fiche profil
        add_action(
            'register_new_user',
            [$this, 'setUserRole']
        );
        add_action(
            'register_new_user',
            [$this, 'createUserProfile']
        );

        // STEP REGISTER affectation du mot de passe choisi par l'utilisateur
        add_action(
            'register_new_user',
            [$this, 'setUserPassword']
        );
    }


    // ===========================================================
    // Méthodes appelées une fois l'utilisateur créé
    // ===========================================================
    
    public function createUserProfile($newUserId)
    {


        // récupération de l'utilisateur via l'id founit par wordpress
        $user = new WP_User($newUserId);
        
        // si le role choisi est "surfer" création d'un contenu de type "surfer-profile".
        $postType = 'surfer-profile';
        
        

        // IMPORTANT E9 Création d'un post
        // DOC wp_insert_post https://developer.wordpress.org/reference/functions/wp_insert_post/

        wp_insert_post([
            // l'auteur du nouveau profil est l'utilisateur qui vient d'être créé
            'post_author' => $newUserId,

            'post_status' => 'publish', // le status du "profil" est publié
            "post_title" => $user->data->display_name, // titre du "profil"

            // le type de post
            'post_type' => $postType
        ]);
    }

    public function setUserPassword($newUserId)
    {
        $password = filter_input(INPUT_POST, 'user_password');
        // IMPORTANT E9 REGISTER affecter le mot de passe d'un utilisateur
        wp_set_password($password, $newUserId);
    }

    // ===========================================================
    // Controle du formulaire
    // ===========================================================

    // le paramètre $errors nous est fourni par wordpress
    public function checkErrors($errors)
    {
        // récupération du mot de passe envoyé par l'utilisateur
        $password0 = filter_input(INPUT_POST, 'user_password');
        $password1 = filter_input(INPUT_POST, 'user_password_confirmation');

        // vérification est ce que les deux mots de passe sont identiques
        if($password0 !== $password1) {
            // si les mots de passe sont différent il faut indiquer à wordpress qu'il y a une erreur
            $errors->add(
                'passwords-different',  // identifiant du message d'erreur
                '<strong>' . __('Error: ') . '</strong> The second password must match the first one'    // message d'erreur à aficher
            );
        }

        // si le mot de passe fait moins de 8 caractères
        // BONUS E9 MB_STRLEN attention pour compter les caractère d'une chaine, il faut utiliser mb_strlen
        if(mb_strlen($password0) < 8) {
            $errors->add(
                'password-too-short',
                '<strong>' . __('Error: ') . '</strong> Your password must have 8 characters at minimum'
            );
        }

        // BONUS E9 REGEXP vérifier qu'il y a une majuscule dans une chaine
        if(!preg_match('/[A-Z]/', $password0)) {
            $errors->add(
                'password-no-capitalized-letter',
                '<strong>' . __('Error: ') . '</strong> Your password must have one capitalized letter'
            );
        }

        if(!preg_match('/[a-z]/', $password0)) {
            $errors->add(
                'password-no-lowercase-letter',
                '<strong>' . __('Error: ') . '</strong> Your password must have one lower case letter'
            );
        }

        if(!preg_match('/[0-9]/', $password0)) {
            $errors->add(
                'password-no-number',
                '<strong>' . __('Error: ') . '</strong> Your password must have one number'
            );
        }


        if(!preg_match('/\W/', $password0)) {
            $errors->add(
                'password-no-special-character',
                '<strong>' . __('Error: ') . '</strong> Your password must have special character'
            );
        }

        // BONUS E9 vérifier si une lettre figure dans une chaine de caractère ; attention le test en "triple égalité" (avec le controle du type) est obligatoire
        $letterPosition = strpos($password0, '@');
        if($letterPosition !== false) {
            $errors->add(
                'password-no-special-character',
                '<strong>' . __('Error: ') . '</strong> You can not user "@" character'
            );
        }

        return $errors;
    }

    // ===========================================================
    // Customisation du formulaire
    // ===========================================================

    public function loadAssets()
    {
        wp_enqueue_style(
            'login-form-css',
            get_theme_file_uri('assets/css/user-registration.css')
        );
    }

    // function hotspot_loadAssets()
    // {
    //     // liste des fichier css à charger
        
    //     $css = [];
    //     $css[] = "assets/css/bootstrap.min.css";
    //     $css[] = "assets/css/animate.css";
    //     $css[] = "assets/css/owl.carousel.min.css";
    //     $css[] = "assets/css/themify-icons.css";
    //     $css[] = "assets/css/flaticon.css";
    //     $css[] = "assets/fontawesome/css/all.min.css";
    //     $css[] = "assets/css/magnific-popup.css";
    //     $css[] = "assets/css/gijgo.min.css";
    //     $css[] = "assets/css/nice-select.css";
    //     $css[] = "assets/css/slick.css";
    //     $css[] = "assets/css/style.css";

    //     foreach($css as $index => $path) {
    //         wp_enqueue_style(
    //             'hotspot-styles-' . $index, // identifiant de notre fichier css
    //             // wordpress nous calcule le chemin vers le fichier assets/css/style.css
    //             get_theme_file_uri($path)
    //         );
    //     }

    public function addCustomFields()
    {
        echo '
            <p>
                <label for="user_password">Password</label>
                <input type="text" name="user_password" id="user_password" class="form-control" value="" size="20" autocapitalize="off">
            </p>

            <p>
                <label for="user_password_confirmation">Password confirmation</label>
                <input type="text" name="user_password_confirmation" id="user_password_confirmation" class="form-control" value="" size="20" autocapitalize="off">
            </p>

            <p>
                <label for="user_accept_conditions">Accept terms and conditions</label>
                <input required type="checkbox" name="user_accept_conditions" id="user_accept_conditions"/>
            </p>
        ';
    }
}
