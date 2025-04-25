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
define( 'DB_NAME', 'lks' );

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
define( 'AUTH_KEY',         'I9H75xp+hFn^fk?T%s=UwOxVg;.jER~4aHn.</#1Yo3!uLK3 P:2(N,7e_# T5n_' );
define( 'SECURE_AUTH_KEY',  '=ZBo21*Ti(w@&0u6: !^^(OAQerQnJDpBi2f^{&NJPv.hEx7M|0Tb11dSKX}WCJb' );
define( 'LOGGED_IN_KEY',    'wFEyBe$=I)OXF+{3@SFpq0d|moy:.Q1xGf=C.1+s.1r)g(~=D|I??QaPC}&%Kc)D' );
define( 'NONCE_KEY',        '3 rrme:Ez#9@GsD7L{vQ9X#h?4ySKBX~3GsBOJtd*fZmnM%yVII6H*Gqop].W-!g' );
define( 'AUTH_SALT',        '4VkUZ+w6|2Gj}9X4>Tte[h/9j/eD>y1?eCOm;R`6e_ZafjO$2]geh@Yte2,/Yhl~' );
define( 'SECURE_AUTH_SALT', '+IE4j.##6Kz:~<F|*=` }vRs/)|*g]nfD4 )J=GS )O.(OVdQ?7}ySM$H@s_COg+' );
define( 'LOGGED_IN_SALT',   ':Y45mjG::-UL`8r?yhAzRW_$=1s^lmMZvWHGua.*%m~|xwbJr!HvE!;k;D}YSFlJ' );
define( 'NONCE_SALT',       'VMDqGi*0WB~5E|b?L(|S[ea@~ ,u0upB3rB)PedCUQrdCg)-?;2S![KqXz-7#,r.' );

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
