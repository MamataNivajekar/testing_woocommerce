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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'testing_woocommerce' );

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
define( 'AUTH_KEY',         '9hNeL.Pa&<^o`3%JS|!PPavWl9/H{E=l8ODU-~.z+Ehd,v@)N8|]>m3V @b>2_c@' );
define( 'SECURE_AUTH_KEY',  '@t[,d0ef>&R^uYpaFi&FLPr8s*xq0RdD@#BbzJ<Rp-4mz=7J4`( 1NrTCm^Ya[4H' );
define( 'LOGGED_IN_KEY',    ',jg=;h@K8[JMN$-x1lm5bT%gu)4TbVy6:q_U!18G}~*x(;:7Cx2q/x5KXaUL]^cg' );
define( 'NONCE_KEY',        'B_Oz:-K+ob}Gq,LEnPV*hGYVfm([$}Wsm1ylH,p]TL!J[RAx0*mwSRvhjNlBI9Jh' );
define( 'AUTH_SALT',        '^=Sb#r3}5,_]*Pb+me]! I9%{XA9-gp_=*S)B`W[(qzW%ppXKfdaj:;c?gC_c6)n' );
define( 'SECURE_AUTH_SALT', '6s5.Hk6.{&$XN~P2bXZ/^h]`::O;bu+JEJ{.eca2-Udq5v9@Scyg0Zp6$K4(iteT' );
define( 'LOGGED_IN_SALT',   '[?^.YWdC^/AA%|D@wnL%+&Yg|JdqUTQu.u$EX#VNbJcufjAo5p@,>jZmJ/-<wuir' );
define( 'NONCE_SALT',       '{f_&q4vjn5)&~l,6(LjX`L^:9Ago_GKqm]?rRPg`S0B#&7%iRF.}J~z]4_TMWIdT' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
