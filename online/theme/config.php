<?php
if ( file_exists( __DIR__ . '/config-local.php' ) ) {
	require __DIR__ . '/config-local.php';
}

define("theme_skin", "skin-blue");//admin theme color. avilable theme skins are skin-blue, skin-green, skin-yellow.
define("logo_url","theme_assets/dist/img/user2-160x160.jpg");
if ( ! defined( 'base_url' ) ) {
	define("base_url",'https://restaurantkamasutra.nl/online/theme/');
}
//define("currency",'&#8377;');
define("currency",'€');
define("lang1",'english');
define("lang2",'dutch');

define("timeinterval",30);

//date_default_timezone_set ("Asia/Calcutta");
date_default_timezone_set ("Europe/Amsterdam");

$current_active_page = basename($_SERVER['PHP_SELF'], ".php");
//error_reporting(0);
?>
