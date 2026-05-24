<?php
/**
 * Find which wp_footer callback fatals on production.
 * Run from site root: php deploy/diagnose-wp-footer.php
 */
define( 'WP_USE_THEMES', true );

$root = dirname( __DIR__ );
chdir( $root );

$_SERVER['HTTP_HOST']      = getenv( 'DOMAIN' ) ?: 'restaurantkamasutra.nl';
$_SERVER['REQUEST_URI']     = '/';
$_SERVER['REQUEST_METHOD']  = 'GET';
$_SERVER['HTTPS']           = 'on';
$_SERVER['SERVER_PORT']     = '443';

require $root . '/wp-load.php';

global $wp_filter;

if ( empty( $wp_filter['wp_footer'] ) ) {
	echo "No wp_footer hooks registered.\n";
	exit( 1 );
}

$hook = $wp_filter['wp_footer'];
$callbacks = array();

if ( is_object( $hook ) && isset( $hook->callbacks ) ) {
	foreach ( $hook->callbacks as $priority => $items ) {
		foreach ( $items as $item ) {
			$callbacks[] = array( $priority, $item['function'] );
		}
	}
} else {
	echo "Unexpected wp_footer hook structure.\n";
	exit( 1 );
}

usort(
	$callbacks,
	static function ( $a, $b ) {
		return $a[0] <=> $b[0];
	}
);

echo 'Testing ' . count( $callbacks ) . " wp_footer callbacks (homepage context)...\n\n";

// Simulate front page.
$query = new WP_Query( array( 'pagename' => 'home' ) );
if ( ! $query->have_posts() ) {
	$front = (int) get_option( 'page_on_front' );
	if ( $front ) {
		$query = new WP_Query( array( 'page_id' => $front ) );
	}
}
if ( $query->have_posts() ) {
	$query->the_post();
}

$last_ok = null;
foreach ( $callbacks as $i => $row ) {
	list( $priority, $fn ) = $row;
	$label = describe_callback( $fn ) . " (priority $priority)";

	try {
		if ( is_array( $fn ) ) {
			call_user_func( $fn );
		} elseif ( is_string( $fn ) ) {
			call_user_func( $fn );
		} else {
			$fn();
		}
		$last_ok = $label;
		echo "[OK]   $label\n";
	} catch ( Throwable $e ) {
		echo "[FAIL] $label\n";
		echo '       ' . get_class( $e ) . ': ' . $e->getMessage() . "\n";
		echo '       ' . $e->getFile() . ':' . $e->getLine() . "\n";
		exit( 1 );
	}
}

echo "\nAll wp_footer callbacks completed without exception.\n";
if ( $last_ok ) {
	echo "Last OK: $last_ok\n";
}

/**
 * @param mixed $fn Callback.
 */
function describe_callback( $fn ) {
	if ( is_string( $fn ) ) {
		return $fn;
	}
	if ( is_array( $fn ) ) {
		if ( is_object( $fn[0] ) ) {
			return get_class( $fn[0] ) . '::' . (string) $fn[1];
		}
		return (string) $fn[0] . '::' . (string) $fn[1];
	}
	if ( $fn instanceof Closure ) {
		return 'Closure';
	}
	return 'callable';
}
