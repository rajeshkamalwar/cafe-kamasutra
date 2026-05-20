<?php
include 'db.php';
include 'config.php';
include 'function.php';
session_start();
// SOURCE: https://github.com/flowjs/flow-php-server

// (A) INIT PHP FLOW
require __DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
$config = new \Flow\Config();
$config->setTempDir(__DIR__ . DIRECTORY_SEPARATOR . "temp");
$request = new \Flow\Request();

// (B) HANDLE UPLOAD
$uploadFolder = __DIR__ . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
$uploadFileName = $request->getFileName(); 
$uploadPath = $uploadFolder . $uploadFileName;
if (\Flow\Basic::save($uploadPath, $config, $request)) {
	
	 $add_dish_query = "INSERT INTO `video`(`video`) VALUES ('" . $uploadFileName . "')";
	 $add_dish_query_result = $mysqli->query($add_dish_query);
  // File saved successfully
} else {
  // Not final chunk or invalid request. Continue to upload.
}