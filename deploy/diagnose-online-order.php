<?php
/**
 * Diagnose /online/ ordering app on server.
 * Run: cd ~/htdocs/restaurantkamasutra.nl && php deploy/diagnose-online-order.php
 */
error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

$root = dirname( __DIR__ );
chdir( $root . '/online' );

echo "=== DB config ===\n";
$local = $root . '/online/admin/db-local.php';
if ( ! is_readable( $local ) ) {
	echo "MISSING: online/admin/db-local.php\n";
	exit( 1 );
}
require $local;
echo "host=$host db=$db user=$user\n";

$mysqli = new mysqli( $host, $user, $pass, $db );
if ( $mysqli->connect_error ) {
	echo "CONNECT FAIL: " . $mysqli->connect_error . "\n";
	exit( 1 );
}
echo "Connected OK\n\n";

$tables = array(
	'adm_set',
	'head_settings',
	'worktimecheck',
	'daystatus',
	'restraholidays',
	'deliveryinfo',
	'worktime',
	'variable',
	'variable-orde',
);
echo "=== Tables ===\n";
foreach ( $tables as $t ) {
	$r = $mysqli->query( "SHOW TABLES LIKE '$t'" );
	echo ( $r && $r->num_rows > 0 ) ? "[OK]   $t\n" : "[MISS] $t\n";
}

echo "\n=== Sample row counts ===\n";
foreach ( array( 'adm_set', 'head_settings', 'worktime' ) as $t ) {
	$r = $mysqli->query( "SELECT COUNT(*) AS c FROM `$t`" );
	if ( $r ) {
		$row = $r->fetch_assoc();
		echo "$t: " . $row['c'] . "\n";
	} else {
		echo "$t: query error " . $mysqli->error . "\n";
	}
}

echo "\n=== PHP include test (public_header) ===\n";
$_SERVER['SCRIPT_NAME']    = '/online/online-order.php';
$_SERVER['HTTP_HOST']      = 'restaurantkamasutra.nl';
$_SERVER['HTTPS']          = 'on';
$_SERVER['REQUEST_URI']    = '/online/online-order.php';
$_SESSION                  = array( 'current_lang' => 'en' );

ob_start();
try {
	include $root . '/online/public_header.php';
	$out = ob_get_clean();
	echo 'public_header bytes: ' . strlen( $out ) . "\n";
} catch ( Throwable $e ) {
	ob_end_clean();
	echo 'FAIL: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine() . "\n";
	exit( 1 );
}

echo "\nDone.\n";
