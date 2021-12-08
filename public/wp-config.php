<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hotspot' );

/** MySQL database username */
define( 'DB_USER', 'hotspot' );

/** MySQL database password */
define( 'DB_PASSWORD', 'hotspot' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '(HtxU3ElG=6V)MkJ_.:`+o-btj8I-y6`J(uNT1tB3<.Ygp7!+|vGi@5%rrJPta/&');
define('SECURE_AUTH_KEY',  'z{O.v{q)E#YZ|&&+aGr:3c(Pq1}K7G1Rh)sdS-LOs!2Th]r/+4TPzA{K/DTt$Jx6');
define('LOGGED_IN_KEY',    'p+@j|OYSW/%TmZ`Z#| Pmt.!to<CasS`u0A*:fG5XC/Y/ VZ$Pem/ZECa6k4;!n`');
define('NONCE_KEY',        '+4{+#6{o@#){e7k9`bQb_*-:`Gw3_6<XFyb+TQu jpVF1-)B$SS;s$DKV`6-s&}@');
define('AUTH_SALT',        'dkx~ex[i3iUATi]>@`KrtO*mIIs21CG*uhYZo!Wyc!&ZA],GbGgg=u/uhgHa%-Ng');
define('SECURE_AUTH_SALT', '!3S@e LC2Y+|Xl Dc/oK%X(9IzE*l(a^l$+cI`ESJH!LW.TZf9AH4%taL=9pk%OE');
define('LOGGED_IN_SALT',   'BmouiTACG-u7wUji_/+/27;.|7|J&hh/tr4+zU=BV3#}e:4gr7d|:bP2E>.,>pYv');
define('NONCE_SALT',       'h+iuWD?yKMe<T0H*d0BXS&7Uq0Uo^a)1wtVrI&T{t!VATqI+;Di>2qDZ]pmN-@WG');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'hs_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */
// Configuration de la home de notre site ; attention très importan !
define('WP_HOME', rtrim ( 'http://localhost/projet-hotspot/public', '/' ));

// pas besoin de toucher à cette ligne
define('WP_SITEURL', WP_HOME . '/wp');

//pas besoin de toucher à cette ligne
define('WP_CONTENT_URL', WP_HOME . '/content');

// pas besoin de toucher à cette ligne
define('WP_CONTENT_DIR', __DIR__ . '/content');

// STEP WP INSTALL  Autorisation d'installation de thèmes et plugin via l'interface d'admin de wordpress
define('FS_METHOD','direct');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

define( 'UPLOADS', 'wp-content/uploads' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
