<?php
/**
 * Create or reset WordPress administrator (works on Windows/XAMPP and Linux VPS).
 * Run from site root: php deploy/seed-wp-admin.php
 */
$root = dirname( __DIR__ );
chdir( $root );

$env_file = __DIR__ . '/env';
if ( is_readable( $env_file ) ) {
	foreach ( file( $env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) as $line ) {
		$line = trim( $line );
		if ( $line === '' || $line[0] === '#' || ! str_contains( $line, '=' ) ) {
			continue;
		}
		list( $k, $v ) = explode( '=', $line, 2 );
		$k = trim( $k );
		$v = trim( $v, " \t\"'" );
		if ( getenv( $k ) === false ) {
			putenv( "$k=$v" );
		}
	}
}

$user     = getenv( 'WP_ADMIN_USER' ) ?: 'admin';
$email    = getenv( 'WP_ADMIN_EMAIL' ) ?: 'info@restaurantkamasutra.nl';
$password = getenv( 'WP_ADMIN_PASS' ) ?: 'admin123';
$display  = getenv( 'WP_ADMIN_DISPLAY_NAME' ) ?: 'Restaurant Admin';
$domain   = getenv( 'DOMAIN' ) ?: 'restaurantkamasutra.nl';

if ( $password === '' || $password === 'CHANGE_ME' ) {
	fwrite( STDERR, "Set WP_ADMIN_PASS in deploy/env\n" );
	exit( 1 );
}

require $root . '/wp-load.php';

$existing = get_user_by( 'login', $user );

if ( $existing ) {
	$user_id = $existing->ID;
	$update  = array(
		'ID'           => $user_id,
		'display_name' => $display,
		'user_pass'    => $password,
	);
	if ( email_exists( $email ) === false || (int) email_exists( $email ) === $user_id ) {
		$update['user_email'] = $email;
	}
	$result = wp_update_user( $update );
	if ( is_wp_error( $result ) ) {
		fwrite( STDERR, 'Error: ' . $result->get_error_message() . "\n" );
		exit( 1 );
	}
} else {
	$create_email = $email;
	if ( email_exists( $create_email ) ) {
		$create_email = 'wp-admin@' . preg_replace( '/[^a-z0-9.-]/i', '', $domain );
	}
	$user_id = wp_insert_user(
		array(
			'user_login'   => $user,
			'user_email'   => $create_email,
			'user_pass'    => $password,
			'display_name' => $display,
			'role'         => 'administrator',
		)
	);
	if ( is_wp_error( $user_id ) ) {
		fwrite( STDERR, 'Error: ' . $user_id->get_error_message() . "\n" );
		exit( 1 );
	}
}

$user_obj = new WP_User( $user_id );
$user_obj->set_role( 'administrator' );

echo "WordPress admin ready.\n";
echo "  URL:      https://{$domain}/wp-login.php\n";
echo "  Username: {$user}\n";
echo "  Password: {$password}\n";
