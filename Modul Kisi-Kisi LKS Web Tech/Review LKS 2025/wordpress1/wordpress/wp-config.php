<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'coba' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'XOno/3MT^/$xB!DEE1hEvr9AK3f)]XCY;.@ }dj!UeSJpLUA9@O|C&>u8CWPUW]=' );
define( 'SECURE_AUTH_KEY',  'J=H_jW*Zt4^<C $;ZZ^}GUAy|uU[`h`N^D>CvDBa{N?}5AK;`) ^-(d&5IsgES?N' );
define( 'LOGGED_IN_KEY',    '?tHvLu}7[!v%O6d-ZIn/w;@S|0P|_^b0]L#lnp{X ,_ttr!<jVdK)I,6&?IL88[~' );
define( 'NONCE_KEY',        '90N9(eO&9;G4Yv8Uc;|a$lLW~uzlUqM3DABJ2eD PURs][AQo~+6u)P{Ru<=^+q#' );
define( 'AUTH_SALT',        'S0<i.t9;}loU=~r<Kjc1}(tpu?}7&5O~8fh`XZoBrV#  ;D&>cJM2-HI/nBi:>-;' );
define( 'SECURE_AUTH_SALT', 'JC[26m-eUO)W=l859,CjLd]rO#CU9pWWAA#?5iZ3$sn@C0W%<:p J3G7-I6 4LF5' );
define( 'LOGGED_IN_SALT',   'azxUYW#L9O:]GF8a(kXwarH{?y~My$95d[YDxjb=k(68Q{&}s7U;Y`cwE99UYj? ' );
define( 'NONCE_SALT',       '<I59})e@X*(nrP/rA41c*WzAjeZ2?iB1Nw 3n=hPY2(g:w5[^<j;)^Q{urNf-~D#' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
