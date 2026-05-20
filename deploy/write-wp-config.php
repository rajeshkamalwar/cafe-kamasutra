<?php
/**
 * CLI: write wp-config.php from environment (deploy/env).
 * Usage: source deploy/env && php deploy/write-wp-config.php
 */

$domain   = getenv( 'DOMAIN' ) ?: 'restaurantkamasutra.nl';
$db_name  = getenv( 'WP_DB_NAME' ) ?: 'restaurant';
$db_user  = getenv( 'WP_DB_USER' ) ?: 'sharmakama';
$db_pass  = getenv( 'WP_DB_PASS' ) ?: '';
$db_host  = getenv( 'WP_DB_HOST' ) ?: '127.0.0.1';

$salts = @file_get_contents( 'https://api.wordpress.org/secret-key/1.1/salt/' );
if ( ! $salts ) {
	fwrite( STDERR, "Could not fetch WordPress salts.\n" );
	exit( 1 );
}

$cfg = "<?php\n";
$cfg .= "define( 'DB_NAME', " . var_export( $db_name, true ) . " );\n";
$cfg .= "define( 'DB_USER', " . var_export( $db_user, true ) . " );\n";
$cfg .= "define( 'DB_PASSWORD', " . var_export( $db_pass, true ) . " );\n";
$cfg .= "define( 'DB_HOST', " . var_export( $db_host, true ) . " );\n";
$cfg .= "define( 'DB_CHARSET', 'utf8mb4' );\n";
$cfg .= "define( 'DB_COLLATE', '' );\n";
$cfg .= trim( $salts ) . "\n";
$cfg .= "\$table_prefix = 'wpcm_';\n";
$cfg .= "define( 'WP_DEBUG', false );\n";
$cfg .= "define( 'WP_DEBUG_LOG', true );\n";
$cfg .= "define( 'WP_DEBUG_DISPLAY', false );\n";
$cfg .= "define( 'WP_MEMORY_LIMIT', '256M' );\n";
$cfg .= "define( 'FORCE_SSL_ADMIN', true );\n";
$cfg .= "define( 'DISALLOW_FILE_EDIT', true );\n";
$cfg .= "define( 'WP_HOME', 'https://" . $domain . "' );\n";
$cfg .= "define( 'WP_SITEURL', 'https://" . $domain . "' );\n";
$cfg .= "if ( ! defined( 'ABSPATH' ) ) {\n";
$cfg .= "\tdefine( 'ABSPATH', __DIR__ . '/' );\n";
$cfg .= "}\n";
$cfg .= "require_once ABSPATH . 'wp-settings.php';\n";

$path = dirname( __DIR__ ) . '/wp-config.php';
file_put_contents( $path, $cfg );
chmod( $path, 0600 );
echo "wp-config.php written\n";
