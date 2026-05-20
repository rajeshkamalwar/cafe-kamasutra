<?php
/**
 * Local development (XAMPP).
 *
 * Copy this file to wp-config-local.php in the same folder as wp-config.php.
 * Create MySQL databases first (see local-databases-setup.sql in project root).
 *
 * Typical XAMPP: user root, empty password. Change folder name in URLs if your
 * project lives elsewhere under htdocs.
 */

define( 'DB_NAME', 'restaurant' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', '127.0.0.1' );

// http://localhost — avoid redirect loops when not using HTTPS locally
define( 'FORCE_SSL_ADMIN', false );

// Optional: enable editing from WP admin on localhost
define( 'DISALLOW_FILE_EDIT', false );

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );
