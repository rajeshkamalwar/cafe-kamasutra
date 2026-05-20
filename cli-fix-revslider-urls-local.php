<?php
/**
 * CLI: Rewrite Revolution Slider slide rows from production URLs to local (handles JSON-escaped slashes).
 * Usage: php cli-fix-revslider-urls-local.php
 */
define( 'WP_USE_THEMES', false );

if ( php_sapi_name() !== 'cli' ) {
	die( 'CLI only.' );
}

require dirname( __FILE__ ) . '/wp-load.php';

global $wpdb;

$local_esc   = 'http:\\/\\/localhost\\/cafekamasutra';
$local_plain = 'http://localhost/cafekamasutra';

$pairs = array(
	array( 'https:\\/\\/www.restaurantkamasutra.nl', $local_esc ),
	array( 'http:\\/\\/www.restaurantkamasutra.nl', $local_esc ),
	array( 'https:\\/\\/restaurantkamasutra.nl', $local_esc ),
	array( 'http:\\/\\/restaurantkamasutra.nl', $local_esc ),
	array( '\\/\\/www.restaurantkamasutra.nl', $local_esc ),
	array( '\\/\\/restaurantkamasutra.nl', $local_esc ),
	array( 'https://www.restaurantkamasutra.nl', $local_plain ),
	array( 'http://www.restaurantkamasutra.nl', $local_plain ),
	array( 'https://restaurantkamasutra.nl', $local_plain ),
	array( 'http://restaurantkamasutra.nl', $local_plain ),
	array( '//www.restaurantkamasutra.nl', $local_plain ),
	array( '//restaurantkamasutra.nl', $local_plain ),
	// Visible text/contact layers often use hostname without scheme.
	array( 'www.restaurantkamasutra.nl', 'localhost/cafekamasutra' ),
	array( 'Www.restaurantkamasutra.nl', 'localhost/cafekamasutra' ),
);

/**
 * @param array<int,array{0:string,1:string}> $pairs
 */
function rk_rs_replace_urls( string $blob, array $pairs ): string {
	foreach ( $pairs as $pair ) {
		$blob = str_replace( $pair[0], $pair[1], $blob );
	}
	return $blob;
}

/**
 * @param array<int,string>                  $cols
 * @param array<int,array{0:string,1:string}> $pairs
 */
function rk_rs_patch_table( wpdb $db, string $table, array $cols, array $pairs ): void {
	$whitelist = array( $db->prefix . 'revslider_slides', $db->prefix . 'revslider_slides_bkp' );
	if ( ! in_array( $table, $whitelist, true ) ) {
		return;
	}
	$col_whitelist = array(
		'params'   => true,
		'layers'   => true,
		'settings' => true,
	);

	$safe_cols = array();
	foreach ( $cols as $col ) {
		if ( isset( $col_whitelist[ $col ] ) ) {
			$safe_cols[] = $col;
		}
	}
	if ( empty( $safe_cols ) ) {
		return;
	}

	$where_chunks = array();
	foreach ( $safe_cols as $col ) {
		$where_chunks[] = $db->prepare( "`{$col}` LIKE %s", '%restaurantkamasutra.nl%' );
	}

	$sql = sprintf(
		'SELECT `id`,`%s` FROM `%s` WHERE %s',
		implode( '`,`', $safe_cols ),
		$table,
		implode( ' OR ', $where_chunks )
	);

	$rows = $db->get_results( $sql, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- fragments built with prepare().
	echo "{$table}: found " . count( (array) $rows ) . " row(s) with legacy domain substring\n";

	foreach ( (array) $rows as $row ) {
		$id      = isset( $row['id'] ) ? (int) $row['id'] : 0;
		$updates = array();
		foreach ( $safe_cols as $col ) {
			if ( ! array_key_exists( $col, $row ) ) {
				continue;
			}
			$old = (string) $row[ $col ];
			$new = rk_rs_replace_urls( $old, $pairs );
			if ( $new !== $old ) {
				$updates[ $col ] = $new;
			}
		}
		if ( empty( $updates ) ) {
			echo "  id={$id} (no replacements — substring may be non-URL mailto etc.)\n";
			continue;
		}
		$result = $db->update( $table, $updates, array( 'id' => $id ), array_fill( 0, count( $updates ), '%s' ), array( '%d' ) );
		if ( false === $result ) {
			fwrite( STDERR, "WARN: {$table} id {$id} update failed.\n" );
			continue;
		}
		echo "  updated id={$id} fields: " . implode( ', ', array_keys( $updates ) ) . "\n";
	}
}

rk_rs_patch_table( $wpdb, $wpdb->prefix . 'revslider_slides', array( 'params', 'layers', 'settings' ), $pairs );
rk_rs_patch_table( $wpdb, $wpdb->prefix . 'revslider_slides_bkp', array( 'params', 'layers', 'settings' ), $pairs );

echo "RevSlider URL rewrite finished.\n";
