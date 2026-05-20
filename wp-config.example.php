<?php
/**
 * Copy to wp-config.php and fill in production values.
 * For localhost, also copy wp-config-local-sample.php → wp-config-local.php
 */

if ( file_exists( __DIR__ . '/wp-config-local.php' ) ) {
	require __DIR__ . '/wp-config-local.php';
}

if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}
if ( ! defined( 'FORCE_SSL_ADMIN' ) ) {
	define( 'FORCE_SSL_ADMIN', true );
}

define( 'WP_AUTO_UPDATE_CORE', 'minor' );

if ( ! defined( 'DB_NAME' ) ) {
	define( 'DB_NAME', 'your_db_name' );
}
if ( ! defined( 'DB_USER' ) ) {
	define( 'DB_USER', 'your_db_user' );
}
if ( ! defined( 'DB_PASSWORD' ) ) {
	define( 'DB_PASSWORD', 'your_db_password' );
}
if ( ! defined( 'DB_HOST' ) ) {
	define( 'DB_HOST', 'localhost' );
}

define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

define( 'WP_MEMORY_LIMIT', '256M' );

/** Generate at https://api.wordpress.org/secret-key/1.1/salt/ */
define( 'AUTH_KEY',         'put-your-unique-phrase-here' );
define( 'SECURE_AUTH_KEY',  'put-your-unique-phrase-here' );
define( 'LOGGED_IN_KEY',    'put-your-unique-phrase-here' );
define( 'NONCE_KEY',        'put-your-unique-phrase-here' );
define( 'AUTH_SALT',        'put-your-unique-phrase-here' );
define( 'SECURE_AUTH_SALT', 'put-your-unique-phrase-here' );
define( 'LOGGED_IN_SALT',   'put-your-unique-phrase-here' );
define( 'NONCE_SALT',       'put-your-unique-phrase-here' );

$table_prefix = 'wpcm_';

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

if (
	file_exists( __DIR__ . '/wp-config-local.php' )
	&& ! defined( 'WP_HOME' )
	&& isset( $_SERVER['HTTP_HOST'] )
	&& is_string( $_SERVER['HTTP_HOST'] )
	&& preg_match( '/^(localhost|127\.0\.0\.1)(:\d+)?$/i', $_SERVER['HTTP_HOST'] )
) {
	if ( empty( $_SERVER['SCRIPT_NAME'] ) && ! empty( $_SERVER['PHP_SELF'] ) ) {
		$_SERVER['SCRIPT_NAME'] = $_SERVER['PHP_SELF'];
	}
	if ( empty( $_SERVER['SCRIPT_NAME'] ) ) {
		$_SERVER['SCRIPT_NAME'] = '/';
	}
	$proto = (
		( defined( 'CAFEK_LOCAL_ALWAYS_HTTPS' ) && CAFEK_LOCAL_ALWAYS_HTTPS )
		|| ( ! empty( $_SERVER['HTTPS'] ) && 'off' !== strtolower( (string) $_SERVER['HTTPS'] ) )
		|| ( isset( $_SERVER['SERVER_PORT'] ) && in_array( (string) $_SERVER['SERVER_PORT'], array( '443', '8443' ), true ) )
	) ? 'https' : 'http';
	$dir   = str_replace( '\\', '/', dirname( $_SERVER['SCRIPT_NAME'] ) );
	while ( preg_match( '#/wp-admin$|/wp-includes$|/wp-content$#', $dir ) ) {
		$dir = dirname( $dir );
	}
	if ( $dir === '/' || $dir === '.' ) {
		$dir = '';
	}
	define( 'WP_HOME', $proto . '://' . $_SERVER['HTTP_HOST'] . $dir );
	define( 'WP_SITEURL', WP_HOME );
}

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
