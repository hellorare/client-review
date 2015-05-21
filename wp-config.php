<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'client-review');

/** MySQL database username */
define('DB_USER', 'client-review');

/** MySQL database password */
define('DB_PASSWORD', 'client-review');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'Un-j;-+Cv=MR{S{ :;gogdWz03kwik-?2*cw#HXR2#y#Fm0dj@^3K|?NQT2]B2aa');
define('SECURE_AUTH_KEY',  '9`zdCM8^Zm||FZn3$m9z6(HS%_NVoOfa?+Bi%E$?}%2_Z]<942$+[.B{v8?N sE:');
define('LOGGED_IN_KEY',    '-?8(ZG%SF$WA2^@OiP%*? Vome.<&+B>x6@E2~W8wZ`H-8d[<6|`c/k8cM|>#PjJ');
define('NONCE_KEY',        'FFw7/;n#ehC/<=L-}X $oJKyg96xSSj_ZlwBlOY-88E$8(|2r9ZTZz0-%%~/XfIT');
define('AUTH_SALT',        'M+v6k3oY-_+W~}=qp7mz?a8#-V%>7WZW4yNQ#(!l#B>F$*sRM:DnPi!;Q7T7jY/H');
define('SECURE_AUTH_SALT', '|V[rAfuIKEe.!vmq-?41lY4l3pS4GG4|fK594d1pCh&|ij=0g|w5-Kuh0=hFC$#H');
define('LOGGED_IN_SALT',   'R}6H)M=&zJayi>~6whaAB/@<^5+,)N-;+`4+=:v(SeuGM`9fj5,WM2+^}jPXj~:y');
define('NONCE_SALT',       '!ve~15EKcU<#6XmE-2ss^ex^i*MN> m,=H(Qh7$Gt)l-JH2b+96~g;TwtFxS-D9n');


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
define('WP_DEBUG', true);
define('WP_MEMORY_LIMIT', '64M');
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

define( 'WP_CONTENT_DIR', ABSPATH . '../wp-content');
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/client-review/wp-content' );


/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
