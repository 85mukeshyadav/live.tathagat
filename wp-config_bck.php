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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
define( 'DB_NAME', 'cjhfzely_gangubai' );

/** Database username */
define( 'DB_USER', 'cjhfzely_blog_admin' );

/** Database password */
define( 'DB_PASSWORD', 'Tathagat@098' );

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
define( 'AUTH_KEY',         '_(l~LLpT6$`i:9qz.EUm1R}BY:aOM?R;x_trAu^of%]j_i1)w}lH5zm6jjQ{6!;&' );
define( 'SECURE_AUTH_KEY',  '4LNz[iYmF0%Wc8J:V|I)i2.)!iK%7rJsO/b+ [W7ZwTtcy1`o<m|vfm!]%=d,Ng]' );
define( 'LOGGED_IN_KEY',    'Y)jnC7ZY?ojx`g0SC7vca8eEQ#8<Z;@DWtAu8$CyA<_0No}vapov4^JwBB6?T: (' );
define( 'NONCE_KEY',        '$-:5+r>tZG*;t;M8oC|K _K|&eyn=G(N#@::l-@({E|?-)a!fV636}K${7j6tZ+U' );
define( 'AUTH_SALT',        '5k:l6|sQ!?XPLO]nxrQ@`/Sr^YbvL81dKr-aX ATSS6OK:4A#AAo~ 1=X0HCpHly' );
define( 'SECURE_AUTH_SALT', '~*AhZIn1aG3!@oCS(k;VMY ]`2g:6M*_p.}bL-_MP=LN,B?0S99[kx=M%xk{pHy+' );
define( 'LOGGED_IN_SALT',   'V-=x^aWvv;s?gn2kL~}QW&eCk7WQ&+[/lcdvkB7m9D+;Q^~:<6O$:iF]cb44qQem' );
define( 'NONCE_SALT',       '~>+P5^R*2L[s/vT_o.eBCn&%.m*XO4{38YF/y-W#H,$Ya$@[Me3M8DSnpU&84$++' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
