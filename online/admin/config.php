<?php
if ( defined( 'ONLINE_APP_CONFIG_LOADED' ) ) {
	return;
}
define( 'ONLINE_APP_CONFIG_LOADED', true );

if ( file_exists( __DIR__ . '/config-local.php' ) ) {
	require __DIR__ . '/config-local.php';
}

if ( ! defined( 'theme_skin' ) ) {
	define( 'theme_skin', 'skin-blue' ); // admin theme color: skin-blue, skin-green, skin-yellow.
}
if ( ! defined( 'logo_url' ) ) {
	define( 'logo_url', 'theme_assets/dist/img/user2-160x160.jpg' );
}
if ( ! defined( 'base_url' ) ) {
	define( 'base_url', 'https://restaurantkamasutra.nl/online/admin/' );
}
if ( ! defined( 'online_base_url' ) ) {
	define( 'online_base_url', 'https://restaurantkamasutra.nl/online/' );
}
if ( ! defined( 'site_base_url' ) ) {
	define( 'site_base_url', 'https://restaurantkamasutra.nl/' );
}
if ( ! defined( 'currency' ) ) {
	define( 'currency', '€' );
}
if ( ! defined( 'lang1' ) ) {
	define( 'lang1', 'english' );
}
if ( ! defined( 'lang2' ) ) {
	define( 'lang2', 'dutch' );
}
if ( ! defined( 'timeinterval' ) ) {
	define( 'timeinterval', 30 );
}

date_default_timezone_set( 'Europe/Amsterdam' );

$current_active_page = basename( $_SERVER['PHP_SELF'], '.php' );
