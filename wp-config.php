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
define( 'DB_NAME', 'bluetabbydesign_84' );

/** MySQL database username */
define( 'DB_USER', 'bluetabbydesign_84' );

/** MySQL database password */
define( 'DB_PASSWORD', ']ST664Exp.' );

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
define( 'AUTH_KEY',         'f4bndhvkgsmidwfgojohluqs8macav03ihidbmcx9nuoam9mah5rhaamhgdhiefe' );
define( 'SECURE_AUTH_KEY',  'ov2vvrhjdiqqe9zuxw0m9mcl2xv3jiqkgkdukx25mubcutgtxxt1nsgikj7dr1tl' );
define( 'LOGGED_IN_KEY',    'supw6jmyfqfjhhbkpargpfb7cjnhp15ohuvpdrtswmzeaipwwznk9jrlnfbjofbx' );
define( 'NONCE_KEY',        'fky1dswedvwaxpylhwwstqy5nsnnddy0hirzehw1vzn6pgv2b8mz9u2sb4kv0vrb' );
define( 'AUTH_SALT',        'ah0ufoj8cpdyl3hmvmhshmlp8lumm19zs8dxeyulcoe6r8zc4rvm3yz03lspcc6x' );
define( 'SECURE_AUTH_SALT', 'r0krpz4pwchhoq5nnpypafpixcnk6gwnvjvmphofdqymaahzcbrw1i981bq9d6zx' );
define( 'LOGGED_IN_SALT',   '38zysvni1vb4ozbxl3kbxcjcg5pjcuhnoyd3xqvejkoncqubgp8ny6ubr3ikfltd' );
define( 'NONCE_SALT',       'e8p4jtbdmmnr1kza8xdz5xgx4rtjj9599uq2738mv4mi0nii01p0kphay3dgwyiu' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp45_';

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
