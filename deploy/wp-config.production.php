<?php
/**
 * Production wp-config.php — copied by cloudpanel-install.sh (values from deploy/env).
 */

define( 'DB_NAME', '{{WP_DB_NAME}}' );
define( 'DB_USER', '{{WP_DB_USER}}' );
define( 'DB_PASSWORD', '{{WP_DB_PASS}}' );
define( 'DB_HOST', '{{WP_DB_HOST}}' );

define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

define( 'AUTH_KEY',         '{{AUTH_KEY}}' );
define( 'SECURE_AUTH_KEY',  '{{SECURE_AUTH_KEY}}' );
define( 'LOGGED_IN_KEY',    '{{LOGGED_IN_KEY}}' );
define( 'NONCE_KEY',        '{{NONCE_KEY}}' );
define( 'AUTH_SALT',        '{{AUTH_SALT}}' );
define( 'SECURE_AUTH_SALT', '{{SECURE_AUTH_SALT}}' );
define( 'LOGGED_IN_SALT',   '{{LOGGED_IN_SALT}}' );
define( 'NONCE_SALT',       '{{NONCE_SALT}}' );

$table_prefix = 'wpcm_';

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'FORCE_SSL_ADMIN', true );
define( 'DISALLOW_FILE_EDIT', true );

define( 'WP_HOME', 'https://{{DOMAIN}}' );
define( 'WP_SITEURL', 'https://{{DOMAIN}}' );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
