#!/bin/bash
# Create wp-config.php (passwords with #/@ break sed — use PHP instead)
set -euo pipefail
cd "$(dirname "$0")/.."
source deploy/env 2>/dev/null || true

DOMAIN="${DOMAIN:-restaurantkamasutra.nl}"
WP_DB_NAME="${WP_DB_NAME:-restaurant}"
WP_DB_USER="${WP_DB_USER:-sharmakama}"
WP_DB_PASS="${WP_DB_PASS:-}"
WP_DB_HOST="${WP_DB_HOST:-127.0.0.1}"

SALTS=$(curl -fsSL https://api.wordpress.org/secret-key/1.1/salt/)

php <<PHP
<?php
\$salts = <<<'SALTS'
${SALTS}
SALTS;
\$cfg = <<<CFG
<?php
define( 'DB_NAME', '${WP_DB_NAME}' );
define( 'DB_USER', '${WP_DB_USER}' );
define( 'DB_PASSWORD', '${WP_DB_PASS}' );
define( 'DB_HOST', '${WP_DB_HOST}' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );
\$salts
\$table_prefix = 'wpcm_';
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'FORCE_SSL_ADMIN', true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'WP_HOME', 'https://${DOMAIN}' );
define( 'WP_SITEURL', 'https://${DOMAIN}' );
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
CFG;
file_put_contents( 'wp-config.php', \$cfg );
echo "wp-config.php written\n";
PHP
chmod 600 wp-config.php
