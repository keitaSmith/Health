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
if(file_exists(dirname(__FILE__) . '/local.php')){
	//local database config
	define( 'DB_NAME', 'local' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', 'root' );
	define( 'DB_HOST', 'localhost' );
}
else{
	//live database config
	define( 'DB_NAME', 'id13268689_wp_30d6a064d85696ff40f673dfb97a5f2d' );
	define( 'DB_USER', 'id13268689_wp_30d6a064d85696ff40f673dfb97a5f2d' );
	define( 'DB_PASSWORD', 'uE^u$N{+vm=1/((n' );
	define( 'DB_HOST', 'localhost' );
}



/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'YVUgLb2My6kZZNIzibVzxnsSzrZYEe/vfA2Mrihq5ZlrDraO+3iHlnbpe0/jGR94tiwXZkNkXcxb25LtypF6+Q==');
define('SECURE_AUTH_KEY',  'hiqLb1AEQLJUz62I7xdz+O/8bXyTIlWnCbI8QEJ1EQOxxs0BpPiMCze5xAFkQmIIeuDd3nBETYjURQtTGHOWaQ==');
define('LOGGED_IN_KEY',    'yqj4OXV8H5q5tZ8FWEXAcVXDmymjIgi+2DibKOh+ajjBQiwUFFmMJxyDuD4mcUlYYqxjd+5IzwhoYYb9dBHulQ==');
define('NONCE_KEY',        'zkeHdHH2q8BHBfrVmimWqQWSRKPbVII1QcZU9niTAgmDnmSPhVIzoSaebnkQsAxVy30Mpx0hh/e1JeZ3IUVtyQ==');
define('AUTH_SALT',        '9R18w45Hrt0AVB19hW9/707mXBAb58NShxMJ0Zmqfj8r7/waLcISFzG5hlo88ubZL0I9G3ETWBQdCA4IDSOdxA==');
define('SECURE_AUTH_SALT', '/WH4F5DyAvaKMaxw06plXPePL14Q3vfR1o8+903dH6YINaqs8sirKbq13RJwDd/SzX/gwPyjd7fgKkxri+fKdQ==');
define('LOGGED_IN_SALT',   '1jZeFKCufvKM2rcsNn0TS5j2mrFKYddW8X6derq//mfckBiwsuLaGKlxLnv6kzytbdtKA1pX/6vzrKBUQKNUcg==');
define('NONCE_SALT',       '1rpgnmzjPUXaD1XogJ+0X9gXU2oDnvzl9zaTFOBMC4LZXDavg0/fSpin1x0cEEIjePzd8hopDXrIl6C65D3qeA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
