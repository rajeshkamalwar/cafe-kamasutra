<?php
/**
 * Production URLs for online ordering app.
 * Install script copies to online/admin/config-local.php and online/theme/config-local.php
 */
$domain = getenv( 'DOMAIN' ) ?: 'restaurantkamasutra.nl';
$base   = 'https://' . $domain;

if ( ! defined( 'base_url' ) ) {
	define( 'base_url', $base . '/online/admin/' );
}
if ( ! defined( 'online_base_url' ) ) {
	define( 'online_base_url', $base . '/online/' );
}
if ( ! defined( 'site_base_url' ) ) {
	define( 'site_base_url', $base . '/' );
}
