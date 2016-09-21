<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'keh');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '+2%?E99TH)AR.(<d[--Um2kG+}x%Yw<DR-_;gWRQ^LW`~JSG:|qL.sfHU,k5hxrY');
define('SECURE_AUTH_KEY',  '5&u:3XNS`Yr`^JB9z-J7g#Np+PQux(#jVff.a&7+PA6T;{e3HvWj>[F=[Fcv&8XX');
define('LOGGED_IN_KEY',    'nm+`V4394 ;, @+:x$lNKWU=GBi-yXu+&%)Bmc-|akfq(b%4|@PX4%)kX,Q>t=G0');
define('NONCE_KEY',        '7b{hQ?_h|%bugf.TmFeq(~$psNt8cF+3mwn^hM-uUh:>9i0)]+E-,j,;E]aJkV]+');
define('AUTH_SALT',        '.XGr!Y.$5X=`)H2p36HkKQLcDFRqcwXJknq!6G++AveX<zk)cFt--}$>CO-jQ~m_');
define('SECURE_AUTH_SALT', '*LR.qPX0vJAw.E?RbT/yT#{~]Pnz{,Aos0;#3>0W>N:CyV+T_&3GL-hu>e]p( y.');
define('LOGGED_IN_SALT',   '=c=,A75G-wiyaBzA2L~<Q*2(0VU}az-rjm@uFmYZdY@QWpW{%N-N1XO`;|bJkpFd');
define('NONCE_SALT',       '%)N{FiwEV]UybgL cG9XBxR/5UZC.6TKIuOq7]BiAd*0%wRGl$=zl:v%+jL,VYpf');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
