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
define('DB_NAME', 'd0273afa');

/** MySQL database username */
define('DB_USER', 'd0273afa');

/** MySQL database password */
define('DB_PASSWORD', 'an9Z78ortXRrTtZ7');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('WP_HOME', 'http://psy.dbkldp.com/');
define('WP_SITEURL', 'http://psy.dbkldp.com/');


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+^S+<V{bban;K0:Y#E}lN0@3Alz&m&+ub]}{5z`u^P2+^Jb`naN>olO2ZK6IP?@4');
define('SECURE_AUTH_KEY',  'y@20=p(xB8$!aeaPH1m:{>IWh^#:zBKv`[)zM.umCxn%_PT*_CA[_i6II7aEW/>9');
define('LOGGED_IN_KEY',    'hD68O-(q&sudEKk&m/aNutu@.Xdce$yOF2et<khA`_&(-p,w|jHta?7lvxP]{L/C');
define('NONCE_KEY',        '[r:v_#9@`=Ek/Oe.;/#zL8hD3;#0e0PC#h;`jQ!KmF9zs{*1-+-V@rxP/z^r,17-');
define('AUTH_SALT',        'wOkc#k1o3Gk(Er7OzA(=6!kCzK7)ZL3Sz|9{iHlymY#4M8bJWgekhR1e|EkXo|/k');
define('SECURE_AUTH_SALT', 'zFielWa[3bn_xQ,Q;o?$CMgBqSxbQ*OMM;5<qsu&WecQ9m%Q^BS#n=Cao>ECEsoq');
define('LOGGED_IN_SALT',   '%/#w%(Pii$#W(R8H)98DYv5u>U=3F0AJ=BCAGr,3t.iy_!Cf9Y,qR>hnr&!;5AcO');
define('NONCE_SALT',       'b)n,xx<n(&je(0L>gU1;rw,f|,!3Kda0kP9eKSUQXB8^Ocy9:-R.%[r#fs54YsAF');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'WRafc_';
define( 'WP_POST_REVISIONS', 10 );

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
