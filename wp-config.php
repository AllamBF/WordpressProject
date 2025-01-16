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
define( 'DB_NAME', 'db_allam' );

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
define( 'AUTH_KEY',         'k/Jm{a9!Juk1d^$I&+,wo sO.EDIM.3)F66NE:Th.63~PwDwkpgq?jvWw4Z7+sQ+' );
define( 'SECURE_AUTH_KEY',  'aI{_A >(D3}7nW>*)y-%?1p0XeNUaKW`ZRq-G2`xvCHb%E0JO+6tsC9toe2IR3D|' );
define( 'LOGGED_IN_KEY',    'U)Fsm8CpCe<e)!,BlKr+1AYEp[,Ab<A%!]if]?ZSDzvNwuxpK[`Ba%1Q+LDl+j3l' );
define( 'NONCE_KEY',        '84}6]2BLzZ,9lj63h4V&a@t<8Ox7~C6fCg|pN]DB= hqRdWEgB=pWM8ll>0xmzy.' );
define( 'AUTH_SALT',        '%.R;YfEK_?bDctC(C+@w.>N/>XHy?W ix3Mj(z=.-[*~3/[gY%p[+N-Fj=z@k!vW' );
define( 'SECURE_AUTH_SALT', '~fKWK4y}{_d?k,WvN0hM{.p`voeH6IqW*&r ^Xg6LO8,_we;W(u?%J]AWrb;v{93' );
define( 'LOGGED_IN_SALT',   '=5w26sM{[Kw^$e^+!4#LP{PVZ6Wyz9GGKos%.6b7%-*hZRy,k-nT@MQY%?nck?$E' );
define( 'NONCE_SALT',       'A-xt;S&)a5K{ H{% O4:&K_$Q9Z(Y=!bK6m3eJ=OSnU}`EQrm7cGiXgtAhxT|o%4' );

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
