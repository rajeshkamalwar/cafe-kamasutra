<?php
/**
 * CLI: Rewrite production URLs → local site URL (serialized-safe row-by-row).
 * Usage: php run-url-replace-local.php
 */
define( 'WP_USE_THEMES', false );

if ( php_sapi_name() !== 'cli' ) {
	die( 'CLI only.' );
}

require dirname( __FILE__ ) . '/wp-load.php';

global $wpdb;

@ini_set( 'memory_limit', '512M' );

// DB is authoritative: CLI `get_option( 'siteurl' )` is often rewritten to https by filters/plugins.
$local = rtrim( (string) $wpdb->get_var( $wpdb->prepare(
	'SELECT option_value FROM ' . $wpdb->options . ' WHERE option_name = %s LIMIT 1',
	'siteurl'
) ), '/' );
if ( ! $local ) {
	$local = 'http://localhost/cafekamasutra';
}
// Local installs: if host is localhost/127.* but scheme is https, normalize to http for file URLs.
if ( strpos( $local, 'localhost' ) !== false || strpos( $local, '127.0.0.1' ) !== false ) {
	if ( strpos( $local, 'https:' ) === 0 ) {
		$local = 'http:' . substr( $local, strlen( 'https:' ) );
	}
}

if ( strpos( $local, 'localhost' ) === false && strpos( $local, '127.0.0.1' ) === false ) {
	fwrite( STDERR, "Abort: siteurl is not local: {$local}\n" );
	exit( 1 );
}

$replacement_base_url = $local;

fwrite(
	STDERR,
	sprintf(
		"Replacement base URL: %s (filtered get_option siteurl: %s)\n\n",
		$replacement_base_url,
		rtrim( (string) get_option( 'siteurl' ), '/' )
	)
);

$repl = esc_sql( $replacement_base_url );

$post_sql_tpl = "
	UPDATE {$wpdb->posts}
	SET `{COL}` =
		REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
			`{COL}`,
			'https://www.restaurantkamasutra.nl','{$repl}'),
			'http://www.restaurantkamasutra.nl','{$repl}'),
			'https://restaurantkamasutra.nl','{$repl}'),
			'http://restaurantkamasutra.nl','{$repl}'),
			'//www.restaurantkamasutra.nl','{$repl}'),
			'//restaurantkamasutra.nl','{$repl}')
	WHERE `{COL}` LIKE '%restaurantkamasutra.nl%'
";

$sum = 0;
foreach ( array( 'post_content', 'post_excerpt', 'guid' ) as $col ) {
	$sql = str_replace( '{COL}', $col, $post_sql_tpl );
	$r   = $wpdb->query( $sql );
	if ( false !== $r ) {
		$sum += (int) $r;
	}
}
echo "posts updates (combined row counts): {$sum}\n";

$s_from = array(
	'https://www.restaurantkamasutra.nl',
	'http://www.restaurantkamasutra.nl',
	'https://restaurantkamasutra.nl',
	'http://restaurantkamasutra.nl',
	'//www.restaurantkamasutra.nl',
	'//restaurantkamasutra.nl',
);
$s_to = array_fill( 0, count( $s_from ), $replacement_base_url );

function rk_deep_replace_urls( $d, array $sf, array $st ) {
	if ( is_string( $d ) ) {
		return str_replace( $sf, $st, $d );
	}

	if ( is_array( $d ) ) {
		foreach ( $d as $k => $v ) {
			$d[ $k ] = rk_deep_replace_urls( $v, $sf, $st );
		}
		return $d;
	}

	if ( is_object( $d ) ) {
		$cls = @get_class( $d );
		if ( $cls && false !== strpos( strtolower( $cls ), 'incomplete' ) ) {
			return $d;
		}
		try {
			foreach ( array_keys( get_object_vars( $d ) ) as $p ) {
				if ( '__PHP_Incomplete_Class_Name' === $p ) {
					continue;
				}
				$d->$p = rk_deep_replace_urls( $d->$p, $sf, $st );
			}
		} catch ( Throwable $e ) {
			return $d;
		}
		return $d;
	}

	return $d;
}

function rk_smart_replace_blob( string $blob, array $sf, array $st ) {
	if ( function_exists( 'is_serialized' ) && is_serialized( $blob ) ) {
		try {
			$u = maybe_unserialize( $blob );
			if ( false !== $u ) {
				return serialize( rk_deep_replace_urls( $u, $sf, $st ) );
			}
		} catch ( Throwable $e ) {
			fwrite( STDERR, "serialized parse failed → plain str_replace only for this blob\n" );
		}
	}
	return str_replace( $sf, $st, $blob );
}

/**
 * Iterate rows and update serialized/plain meta safely.
 */
function rk_patch_meta_table( $table, string $pk, array $sf, array $st ) {
	global $wpdb;

	$oids = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT `{$pk}` AS rid FROM `{$table}` WHERE meta_value LIKE %s",
			'%restaurantkamasutra.nl%'
		),
		ARRAY_A
	);

	$upd = 0;
	$skipped = 0;

	foreach ( (array) $oids as $row ) {
		$rid = (int) $row['rid'];
		$b   = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM `{$table}` WHERE `{$pk}` = %d", $rid ) );
		if ( null === $b ) {
			continue;
		}
		try {
			$n = rk_smart_replace_blob( $b, $sf, $st );
		} catch ( Throwable $e ) {
			++$skipped;
			continue;
		}
		if ( $n !== $b ) {
			if ( false !== $wpdb->update(
				$table,
				array( 'meta_value' => $n ),
				array( $pk => $rid ),
				array( '%s' ),
				array( '%d' )
			) ) {
				++$upd;
			}
		}
	}
	echo "{$table} updated: {$upd} skipped-errors: {$skipped}\n";
}

rk_patch_meta_table( $wpdb->postmeta, 'meta_id', $s_from, $s_to );
rk_patch_meta_table( $wpdb->termmeta, 'meta_id', $s_from, $s_to );
rk_patch_meta_table( $wpdb->usermeta, 'umeta_id', $s_from, $s_to );

$opts = $wpdb->get_results(
	$wpdb->prepare(
		"SELECT option_id, option_value FROM {$wpdb->options} WHERE option_value LIKE %s",
		'%restaurantkamasutra.nl%'
	),
	ARRAY_A
);

$o_up = 0;
foreach ( (array) $opts as $r ) {
	try {
		$n = rk_smart_replace_blob( $r['option_value'], $s_from, $s_to );
		if ( $n !== $r['option_value'] ) {
			if ( false !== $wpdb->update(
				$wpdb->options,
				array( 'option_value' => $n ),
				array( 'option_id' => $r['option_id'] ),
				array( '%s' ),
				array( '%d' )
			) ) {
				++$o_up;
			}
		}
	} catch ( Throwable $e ) {
		fwrite( STDERR, "skip option_id {$r['option_id']}\n" );
	}
}
echo "options updated: {$o_up}\n";

$remain = (int) $wpdb->get_var(
	$wpdb->prepare(
		"SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_content LIKE %s",
		'%restaurantkamasutra.nl%'
	)
);
echo "\nPosts still mentioning domain (any substring incl. emails): {$remain}\n";

echo "Posts still with literal OLD-SITE URL prefixes (should tend to 0 after runs):\n";
foreach ( array(
	'https://www.restaurantkamasutra.nl',
	'http://www.restaurantkamasutra.nl',
	'https://restaurantkamasutra.nl',
	'http://restaurantkamasutra.nl',
	'//www.restaurantkamasutra.nl',
	'//restaurantkamasutra.nl',
) as $pfx ) {
	$like = '%' . $wpdb->esc_like( $pfx ) . '%';
	$c    = (int) $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_content LIKE %s",
			$like
		)
	);
	echo "  {$pfx} … {$c} posts\n";
}

$upa = (int) $wpdb->get_var(
	$wpdb->prepare(
		"SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_content LIKE %s",
		'%' . $wpdb->esc_like( 'restaurantkamasutra.nl/wp-content' ) . '%'
	)
);
$pma = (int) $wpdb->get_var(
	$wpdb->prepare(
		"SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE meta_value LIKE %s",
		'%' . $wpdb->esc_like( 'restaurantkamasutra.nl/wp-content' ) . '%'
	)
);
echo "Posts / postmeta with old-domain wp-content URLs (broken media if > 0): {$upa} / {$pma}\n";

$mremain = (int) $wpdb->get_var(
	$wpdb->prepare(
		"SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE meta_value LIKE %s",
		'%restaurantkamasutra.nl%'
	)
);

echo "postmeta rows still mentioning domain (often SMTP logs, not assets): {$mremain}\n";
echo 'Finished. Replacement base URL: ' . $replacement_base_url . PHP_EOL;
