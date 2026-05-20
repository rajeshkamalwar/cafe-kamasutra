<?php
/**
 * Force-replace localhost URLs in RevSlider + theme data (WP-CLI often misses these).
 * Run on VPS: php deploy/fix-revslider-urls.php
 */
declare( strict_types=1 );

$root = dirname( __DIR__ );
$env  = $root . '/deploy/env';
if ( is_readable( $env ) ) {
	foreach ( file( $env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) as $line ) {
		$line = trim( $line );
		if ( $line === '' || str_starts_with( $line, '#' ) ) {
			continue;
		}
		if ( preg_match( '/^([A-Za-z_][A-Za-z0-9_]*)=(.*)$/', $line, $m ) ) {
			$val = trim( $m[2], " \t\"'" );
			putenv( $m[1] . '=' . $val );
		}
	}
}

$host = getenv( 'WP_DB_HOST' ) ?: '127.0.0.1';
$user = getenv( 'WP_DB_USER' ) ?: 'sharmakama';
$pass = getenv( 'WP_DB_PASS' ) ?: '';
$name = getenv( 'WP_DB_NAME' ) ?: 'restaurant';

$mysqli = new mysqli( $host, $user, $pass, $name );
if ( $mysqli->connect_error ) {
	fwrite( STDERR, 'DB connect failed: ' . $mysqli->connect_error . PHP_EOL );
	exit( 1 );
}
$mysqli->set_charset( 'utf8mb4' );

$from = array(
	'http:\\/\\/localhost\\/cafekamasutra',
	'https:\\/\\/localhost\\/cafekamasutra',
	'\\/\\/localhost\\/cafekamasutra',
	'http://localhost/cafekamasutra',
	'https://localhost/cafekamasutra',
	'//localhost/cafekamasutra',
	'localhost/cafekamasutra',
);
$to = 'https://restaurantkamasutra.nl';

$tables = array(
	'wpcm_revslider_slides'        => array( 'params', 'layers', 'settings' ),
	'wpcm_revslider_sliders'       => array( 'params', 'settings' ),
	'wpcm_revslider_static_slides' => array( 'params', 'layers', 'settings' ),
	'wpcm_revslider_slides_bkp'    => array( 'params', 'layers', 'settings' ),
	'wpcm_revslider_static_slides_bkp' => array( 'params', 'layers', 'settings' ),
	'wpcm_postmeta'                => array( 'meta_value' ),
	'wpcm_posts'                   => array( 'post_content', 'post_excerpt', 'guid' ),
	'wpcm_options'                 => array( 'option_value' ),
);

$total = 0;
foreach ( $tables as $table => $columns ) {
	$r = $mysqli->query( "SHOW TABLES LIKE '{$table}'" );
	if ( ! $r || $r->num_rows === 0 ) {
		continue;
	}
	foreach ( $columns as $col ) {
		foreach ( $from as $needle ) {
			$needle_esc = $mysqli->real_escape_string( $needle );
			$to_esc     = $mysqli->real_escape_string( $to );
			$sql        = "UPDATE `{$table}` SET `{$col}` = REPLACE(`{$col}`, '{$needle_esc}', '{$to_esc}') WHERE `{$col}` LIKE '%localhost%'";
			$mysqli->query( $sql );
			$n = $mysqli->affected_rows;
			if ( $n > 0 ) {
				echo "{$table}.{$col}: {$n} rows ({$needle})\n";
				$total += $n;
			}
		}
	}
}

// RevSlider + page caches in options
$mysqli->query( "DELETE FROM wpcm_options WHERE option_name LIKE 'rs-%' OR option_name LIKE '%revslider%cache%'" );
echo "Cleared revslider option cache rows: " . $mysqli->affected_rows . "\n";

$dirs = array(
	$root . '/wp-content/cache',
	$root . '/wp-content/uploads/revslider',
);
foreach ( $dirs as $dir ) {
	if ( ! is_dir( $dir ) ) {
		continue;
	}
	$it = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $dir, FilesystemIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::CHILD_FIRST
	);
	$removed = 0;
	foreach ( $it as $file ) {
		if ( $file->isDir() ) {
			@rmdir( $file->getPathname() );
		} else {
			if ( str_ends_with( $file->getFilename(), '.css' ) || str_ends_with( $file->getFilename(), '.html' ) || str_ends_with( $file->getFilename(), '.php' ) ) {
				@unlink( $file->getPathname() );
				++$removed;
			}
		}
	}
	echo "Purged cache files under " . basename( $dir ) . ": ~{$removed}\n";
}

echo "\nTotal row updates: {$total}\n";
echo "Done. Hard-refresh https://restaurantkamasutra.nl/\n";
