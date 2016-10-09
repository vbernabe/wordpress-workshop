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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         ';Vy|eE50^U~p)/6eE&0H]j}%h}[5r-A{3ax<+_FQX;:Fv|pFgN<&?}PXzhhtsby{');
define('SECURE_AUTH_KEY',  ' 2]x ;*p@A(O_~ JUFAyBDcOrIZH-DcMl54_DU:%{T9;,DA4k>?]a~i*B,|W;S o');
define('LOGGED_IN_KEY',    'A!T``%)q%RHK/,Hgh[=*(A9&v3wfXU;uCU8Fe)0cxnRC(aCxp#KsXJ8:)T/Gub|U');
define('NONCE_KEY',        'q|}h+5XM6lF0R8Tp|ltCy;^]V& i]ZuGq6;j#~t*1_1WhcTRNjC,g>(4!c|2>D/S');
define('AUTH_SALT',        'r`}Hy;d%6?vniNBlFh_{09of`}WMJl6Pg-*k4RG,AGLY%O2KV&VQA.M#cTfqrV#w');
define('SECURE_AUTH_SALT', '9Zh[( O:fo(uApPoD|[O8))p-[,`(ioJ.M.H57`4|QO?Bu%pnw{Z$`Bep s3^G6.');
define('LOGGED_IN_SALT',   'pJ?OG3CdSn$Bs6cP`rNTpz5X0Mp{gT$GK!cVY$Ud>o~(m bD6ko&#PcVEpAj0<Ae');
define('NONCE_SALT',       '<n<J_h<-A6k&v;x*oZ_wo~-$,,B{Lt!5#i_TLe5nm%7B;#$Kt1_BkP3C(w&,u{g1');

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
