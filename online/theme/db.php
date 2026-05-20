<?php
/* Database connection settings — copy db-local-sample.php → db-local.php for XAMPP/local */
if ( file_exists( __DIR__ . '/db-local.php' ) ) {
	require __DIR__ . '/db-local.php';
} else {
	die( 'Missing online/theme/db-local.php — copy db-local-sample.php and set database credentials.' );
}

$mysqli = new mysqli( $host, $user, $pass, $db );

if ( $mysqli->connect_error ) {
	die( 'Connection failed: ' . $mysqli->connect_error );
}

error_reporting( 0 );
?>


