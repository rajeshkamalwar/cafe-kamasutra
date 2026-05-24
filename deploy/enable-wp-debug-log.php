<?php
/**
 * Turn on WP_DEBUG_LOG in wp-config.php (one-time on server).
 * Run: php deploy/enable-wp-debug-log.php
 */
$config = dirname( __DIR__ ) . '/wp-config.php';
if ( ! is_readable( $config ) ) {
	fwrite( STDERR, "wp-config.php not found\n" );
	exit( 1 );
}
$text = file_get_contents( $config );
if ( str_contains( $text, "define( 'WP_DEBUG_LOG', true )" ) ) {
	echo "WP_DEBUG_LOG already enabled.\n";
	exit( 0 );
}
$needle = "define( 'WP_DEBUG', false )";
if ( ! str_contains( $text, $needle ) ) {
	$needle = "define('WP_DEBUG', false)";
}
if ( ! str_contains( $text, $needle ) ) {
	fwrite( STDERR, "Could not find WP_DEBUG line to patch.\n" );
	exit( 1 );
}
$text = str_replace(
	$needle,
	"define( 'WP_DEBUG', true )\ndefine( 'WP_DEBUG_LOG', true )\ndefine( 'WP_DEBUG_DISPLAY', false )",
	$text,
	$count
);
if ( $count < 1 ) {
	fwrite( STDERR, "Patch failed.\n" );
	exit( 1 );
}
file_put_contents( $config, $text );
echo "Enabled WP_DEBUG_LOG. Reload the homepage, then run: tail -30 wp-content/debug.log\n";
