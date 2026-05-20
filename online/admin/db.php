<?php
/* Database connection settings — copy db-local-sample.php → db-local.php for XAMPP/local */
if ( file_exists( __DIR__ . '/db-local.php' ) ) {
	require __DIR__ . '/db-local.php';
} else {
	die( 'Missing online/admin/db-local.php — copy db-local-sample.php and set database credentials.' );
}

$mysqli = new mysqli( $host, $user, $pass, $db );

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT * FROM `adm_set`";
$result_query = $mysqli->query($query);

if (!$result_query) {
    die("Query failed: " . $mysqli->error);
}

$data1 = array();
while ($row = $result_query->fetch_assoc()) {
    $data1[$row['adm_set_name']] = $row['adm_set_vlu'];		
}
?>

