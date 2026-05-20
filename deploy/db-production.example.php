<?php
/**
 * Production DB credentials for online/admin/db-local.php and online/theme/db-local.php
 */
$host = getenv( 'ORDER_DB_HOST' ) ?: '127.0.0.1';
$user = getenv( 'ORDER_DB_USER' ) ?: 'restaurant_user';
$pass = getenv( 'ORDER_DB_PASS' ) ?: 'CHANGE_ME';
$db   = getenv( 'ORDER_DB_NAME' ) ?: 'sharma_kama';
