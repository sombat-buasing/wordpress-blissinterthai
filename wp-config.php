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
define( 'DB_NAME', 'cp496355_wp2' );

/** MySQL database username */
define( 'DB_USER', 'cp496355_wp2' );

/** MySQL database password */
define( 'DB_PASSWORD', 'C.hTAHSB4rsbs6hiNKt76' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'Y74oDMtpPrpbHZ76bSKKdVgz5b7awJBfvmw2S0l8P8NV3kt0fXC4gdPQ0JbH8zlS');
define('SECURE_AUTH_KEY',  '0KlXguMvFnlWjeHg3eVIBRjHihqlOrTyJUVALn461actCAgw9wla7abNBMEgjDQS');
define('LOGGED_IN_KEY',    '8GvImJrFLWTR23l4kdt0knrejNwFeAhEhikxyN9nYyLyP67k6Z6wF1xBg4LLWt1O');
define('NONCE_KEY',        'JXpFWl2tAn9mvaMGyuol3T6QfK6d4eUMzRVJz7TTiTALCr6hv3yukNYDU1xcXh13');
define('AUTH_SALT',        'CZMiyXwYTNKeyz1wKhyyPd88eTUQypYp8mqyhDInfY3Kz8K5R9HMtTqb4DwLiews');
define('SECURE_AUTH_SALT', 'TTfAInOSH7yHWBBbjZ3pOQ8dztzld0pHxVSE5ukrTTsvBLEb07K4C0OUMkwbviU3');
define('LOGGED_IN_SALT',   'IoWIzKOXNA66BpFb63MeFmkdl58YUe9aGLe85IyfklOVuDZyxQj7L6OLITVQi2pP');
define('NONCE_SALT',       'L1ToIH7jdXjRl7p0B3zsKrlIuLka9Kd0H0PpFhUXaUYCFoKfTTOE5X2so5qXgyYZ');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
