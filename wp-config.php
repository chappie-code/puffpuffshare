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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'puffpuff');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'UlxP4ak3vmp5sS9AYSwJ');

/** MySQL hostname */
define('DB_HOST', 'puffpuffshare.cafck54lrxjo.us-west-2.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|kx%7MWIOzj0!w@xAHKA2aq98_EK[1z+_j&wLC `l2Fw]DQC/?@+/o!T5Y {n@F1');
define('SECURE_AUTH_KEY',  '*U5]P/iQJ)%D]/VKq,#LC~H<vzKzbH3xhvnzU]/w^(z9YVH0?|l`C7WoP%r[E~A9');
define('LOGGED_IN_KEY',    '8{$O?<{!itCK?q7-R=BY]h-5M^|0TDSNl-fd8aW0L8tT0!@Jp$}4X~-L/.&XsaYI');
define('NONCE_KEY',        'PVtkF:7:o][ X9Xi>)l5&$r,fz;]%ne(U-C!^oV7~e&<pqz.1Ft~|&&6k#+?C}+h');
define('AUTH_SALT',        '-hp>K#hq3;BRYktU ZIy2A4::Y^|jRcqSI.PxNKCs;Fq3oU.bCbqaNi(>~8!?@.}');
define('SECURE_AUTH_SALT', '8PXcd<b!/g<GvC@^]~?J# ;~-^Iu_Ig:;p3`o-{<1b-u7.E2FT/qFUE}aUR~w81H');
define('LOGGED_IN_SALT',   '-)r:nB;59{B7Ws}=W7%QzO7f7W14RDd*#1`;iS@z_Oky:#:8=ULo0+OZdwxhrq&$');
define('NONCE_SALT',       'q^`Fo*3RX r5Ci}k61TapVZK.p7F(C)M,cUsqpvc/m#!umIK:)g[a/}FlksDd:3w');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
