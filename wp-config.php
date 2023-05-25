<?php

if ( ! defined( 'FS_METHOD' ) ) define( 'FS_METHOD', 'direct' );
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
/** The name of the database for WordPress */
define( 'DB_NAME', 'gangubai' );

/** Database username */
define( 'DB_USER', 'mukeshy' );

/** Database password */
define( 'DB_PASSWORD', 'Yadav@098' );

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
define( 'AUTH_KEY',         ' ;P,8B(5o=MUJ2BR1&{Lb2>ysVsQ|;J)0(g,BxRZm-V4RW{(J#yH^x&;%efLBm31' );
define( 'SECURE_AUTH_KEY',  'heql/Y!R_rajpXw0|qWE_}*k|uV%jbd=MK[T#]tI!#P.gXg=lp:b6ESKL;vCH>w[' );
define( 'LOGGED_IN_KEY',    'z~+g}[7C`WD2iYciC!Pc!:tSs#I{q:Yo@st,4LvdM|,ZI7CjC^qT;_~d@wl_S?,A' );
define( 'NONCE_KEY',        '!5NGE{>d*Q ?#I+_l`>(d^!K@~B7a(E;$6%H(i;/#a)6,4/#%Ch&AOvT|R*nVi]Q' );
define( 'AUTH_SALT',        'P$XLraAYx4:Y&9zShRb;ZHcMKD*[ qOW%|ism KP<Ah!{Y:XGg#7*&ndh,Or&^fn' );
define( 'SECURE_AUTH_SALT', 'xQs]2I*wm$ b~q_8}92t`zl`8{$rn[CL 6^Rq?wE68_[OcL/69|V(5b5ad42#/j0' );
define( 'LOGGED_IN_SALT',   'p)AS,/|x<VfaS~_y{47D~1IPx[Bo*gnhCqRhg9m%CpY>t{kyZjh#3/BYvQY$$Y]}' );
define( 'NONCE_SALT',       ':M3<oDY7R7MgL8><y4zG$,Qu>x/NV1%L})}wrZpoRM7$L|IC3!WxJX#57U7Rg$yD' );

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
