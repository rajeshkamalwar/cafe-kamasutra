<?php
/**
 * CLI: write wp-config.php from environment (deploy/env).
 * Usage: source deploy/env && php deploy/write-wp-config.php
 */

/**
 * Load deploy/env (shell "source" does not pass vars to PHP getenv).
 */
$env_file = __DIR__ . '/env';
if ( is_readable( $env_file ) ) {
	foreach ( file( $env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) as $line ) {
		$line = trim( $line );
		if ( $line === '' || str_starts_with( $line, '#' ) ) {
			continue;
		}
		if ( preg_match( '/^([A-Za-z_][A-Za-z0-9_]*)=(.*)$/', $line, $m ) ) {
			$val = trim( $m[2], " \t\"'" );
			putenv( $m[1] . '=' . $val );
			$_ENV[ $m[1] ]    = $val;
			$_SERVER[ $m[1] ] = $val;
		}
	}
}

$domain   = getenv( 'DOMAIN' ) ?: 'restaurantkamasutra.nl';
$db_name  = getenv( 'WP_DB_NAME' ) ?: 'restaurant';
$db_user  = getenv( 'WP_DB_USER' ) ?: 'sharmakama';
$db_pass  = getenv( 'WP_DB_PASS' ) ?: '';
$db_host  = getenv( 'WP_DB_HOST' ) ?: '127.0.0.1';

if ( $db_pass === '' ) {
	fwrite( STDERR, "WP_DB_PASS is empty. Check deploy/env.\n" );
	exit( 1 );
}

$salts_raw = @file_get_contents( 'https://api.wordpress.org/secret-key/1.1/salt/' );
if ( ! $salts_raw ) {
	fwrite( STDERR, "Could not fetch WordPress salts.\n" );
	exit( 1 );
}

$salt_lines = array();
foreach ( preg_split( '/\r\n|\r|\n/', trim( $salts_raw ) ) as $line ) {
	$line = trim( $line );
	if ( $line === '' || str_contains( $line, '<?php' ) ) {
		continue;
	}
	if ( preg_match( "/^define\s*\(/", $line ) ) {
		$salt_lines[] = $line;
	}
}
if ( count( $salt_lines ) < 8 ) {
	fwrite( STDERR, "Invalid salts from WordPress API.\n" );
	exit( 1 );
}

$cfg = "<?php\n";
$cfg .= "define( 'DB_NAME', " . var_export( $db_name, true ) . " );\n";
$cfg .= "define( 'DB_USER', " . var_export( $db_user, true ) . " );\n";
$cfg .= "define( 'DB_PASSWORD', " . var_export( $db_pass, true ) . " );\n";
$cfg .= "define( 'DB_HOST', " . var_export( $db_host, true ) . " );\n";
$cfg .= "define( 'DB_CHARSET', 'utf8mb4' );\n";
$cfg .= "define( 'DB_COLLATE', '' );\n";
$cfg .= implode( "\n", $salt_lines ) . "\n";
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

$lint = shell_exec( 'php -l ' . escapeshellarg( $path ) . ' 2>&1' );
if ( ! is_string( $lint ) || ! str_contains( $lint, 'No syntax errors' ) ) {
	fwrite( STDERR, $lint ?: "wp-config.php failed lint.\n" );
	exit( 1 );
}
echo "wp-config.php written (syntax OK)\n";
