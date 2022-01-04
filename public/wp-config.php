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

// JWT AUTH CONFIGURATION
define("JWT_AUTH_SECRET_KEY", "1672966366ce77fd3fff178cafe499be3f00e892dcfc246cfefe4dba0261a9e76d80e1ce");
define("JWT_AUTH_CORS_ENABLE", true);

// =================================
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
define( 'AUTH_KEY',         '$2y$10$1kuddj2ngs.WppBjM1aGz.oCOppELCWKn1iNjcnIM6ody/8FuaiLq' );
define( 'SECURE_AUTH_KEY',  '$2y$10$B7t.Um0rTH3BYKCON6viruNoixvl5Ue/m7WwVrGlLNngW8s/VjXKa' );
define( 'LOGGED_IN_KEY',    '$2y$10$qFu6EzmthPJnE7ys8qFYr.2jsn0yNprS5n/pEJK0VYVCeQo6wn1we' );
define( 'NONCE_KEY',        '$2y$10$W5XruLas5Du6heXBvC6X8eJsyYZM4GS03zrp4QFzHUgOzPgCDQFmy' );
define( 'AUTH_SALT',        '$2y$10$GM4F39xxPxBhXS5e0OGGIOf9ds18XUxDakcHJc2JjjogVcfvVFkB.' );
define( 'SECURE_AUTH_SALT', '$2y$10$XBSCDdsv2jZX.w677G214.itDHl/PCo2qvmmp4o3mPhHMswKqCNtu' );
define( 'LOGGED_IN_SALT',   '$2y$10$lwZ57Rkoab2zFTpU28XSXOr0Q0p.RvHLLSD.LbW6ElE6.S0Pm51Um' );
define( 'NONCE_SALT',       '$2y$10$C8OI73jjCuUap.Ob0yrgKuK3HOVJMMEAZxIDNmxOaSFulVDRWmXfW' );

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





define('WP_HOME', rtrim ( 'http://ec2-52-90-172-148.compute-1.amazonaws.com/projet-hotspot/public/', '/' ));
define('WP_SITEURL', WP_HOME . '/wp');
define('WP_CONTENT_URL', WP_HOME . '/content');
define('WP_CONTENT_DIR', __DIR__ . '/content');
define('FS_METHOD','direct');
/* That\'s all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

define( 'UPLOADS', 'wp-content/uploads' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
