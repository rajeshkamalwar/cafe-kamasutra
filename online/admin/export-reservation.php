<?php 
require_once('db.php');

// File Location
$filename = "Reservations.csv";

// 
$file = fopen($filename,'w');

// CSV Data Content
$data = [];

// Data Header
//$data[] = ['Id', 'Name', 'Phone', 'Email'];

// Fill CSV Data Content From MySQL Database
$i = 1;
$qry = $mysqli->query("SELECT * FROM `reservation_tbl` order by abs(`name`) asc");
while($row = $qry->fetch_assoc()):
    $data[] = [($i++), "{$row['name']}", "{$row['email']}", "{$row['phone']}"];
endwhile;
//  End of filling Data

// Failure of opening the CSV File
if($file === false){
    die("An Error Occurred. Error: Fialed to open ".$filename);
}

foreach($data as $row){
    fputcsv($file, $row);
}

// Close the File
fclose($file);


// Zipping the file

header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($filename) . "\"");
readfile($filename); 

if(isset($mysqli))
$mysqli->close();

?>