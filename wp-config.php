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
/** The name of the database for WordPress */
define( 'DB_NAME', 'cms_jobwork' );

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
define( 'AUTH_KEY',         '|yg$u2RC3n zFBX/gH31Vxy5UIDU3Z(?Q,()#NfeS_C;r0zk=5L-J-VVx.@bXfHI' );
define( 'SECURE_AUTH_KEY',  '0?m#6Zr$F(zF#]hQ x[eL#9g|xo.aEe;|)RQCdwIHl%-[S1iZK~2sIKvj;{Jq[tj' );
define( 'LOGGED_IN_KEY',    'xjyE/{]7ju?}+vVyisg^ e r~C!X~U<2v&8,sp(AjHE/:s3_.up.f3tL>z@/W43L' );
define( 'NONCE_KEY',        '*!83=cV_Zy15AqKC/] ty UD} T-mEe.4woF?:&4k$ZVjW?|<^^Ov;+XUxzlTv%M' );
define( 'AUTH_SALT',        '7*l=&Sw|;,@dVFP#Y3o/xoq8{+D:zsfM0J.7hOZ7^^7LrA!FyToiWnui*<5phL&*' );
define( 'SECURE_AUTH_SALT', 'vArCO}`x[DHu<Rhnm;vf[yfAD5.UmB4IwX4:N^~$2lS:k(|-@6A_Mw5Hg]PV_}:!' );
define( 'LOGGED_IN_SALT',   ';qlxL+6ncy([dRdy*~ZPJ?/9?Q{WkA`tywB|~RG/3EEl1& 7j0|x1OETqeMZR.G|' );
define( 'NONCE_SALT',       '$ <#fFTgHhd*D>j-gKox|c_FCl5.?]EMrisuxl$~-OQ}Ma`!9at<nRq7~tCa@YVl' );

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
