<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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
define( 'DB_NAME', 'test_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$VXal>I&NF2cDXX*+bJ]=R^JDZ~!z+4aR]C)>nUQW.QUW, G[k+OQzA7Z<SX[Za^' );
define( 'SECURE_AUTH_KEY',  '$,v|&ehX)zb+3Au`FB9KCfe2?5Upq4.%)unb0Yi7w/.@wKoU[+cR=#,g_xn<BXXD' );
define( 'LOGGED_IN_KEY',    'x5z>Z*loZE*]y1N;hBw~/,f1D7pL)8aZ>(m(W<mF!gmP*S%Mdk{m(G1k@zch@~Te' );
define( 'NONCE_KEY',        'RV!H[MY($L[-~#ntBRdV9-YF2BXi5aO>j{gaigi.7N qZ,dS5d( ]J(X>$mDeWN!' );
define( 'AUTH_SALT',        'N]En<QnMePq?@kft$lh6b7Ew.a4c36i}lSP)T)]Ix1dfYI]s)`f}]lr*hN3t.XiW' );
define( 'SECURE_AUTH_SALT', 'Fn=yzk!SW-?sp4,+F6Yk#1#9kC}9e7p#&_ZD$pfBra?( ]C)}iR$rw,L~ECWBauu' );
define( 'LOGGED_IN_SALT',   'PTwLHU{u3v<58!o]tWjnLz5v!$Nwz&?H;D;pL zbb^XV]I7l(0z&VP!!?.K.z;c/' );
define( 'NONCE_SALT',       '+Bfi#f>5&T&QN/n3^U}I]V{ !| @<IvN7gS^~BInvC}Av[-w<tV>.1OguzTJ|e]F' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
