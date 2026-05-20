<?php
/**
 * On localhost, replace the Facebook Page Plugin (footer widget) with a simple link.
 * The SDK fails in local iframes (permissions policy, missing DOM nodes) and floods the console.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ck_is_local_request(): bool {
	if ( ! isset( $_SERVER['HTTP_HOST'] ) ) {
		return false;
	}
	$host = strtolower( (string) $_SERVER['HTTP_HOST'] );
	return str_contains( $host, 'localhost' ) || str_contains( $host, '127.0.0.1' );
}

add_filter(
	'widget_display_callback',
	static function ( $instance, $widget ) {
		if ( ! ck_is_local_request() || ! is_array( $instance ) || empty( $instance['text'] ) ) {
			return $instance;
		}
		if ( ! isset( $widget->id_base ) || 'text' !== $widget->id_base ) {
			return $instance;
		}
		if ( ! str_contains( $instance['text'], 'fb-page' ) && ! str_contains( $instance['text'], 'connect.facebook.net' ) ) {
			return $instance;
		}
		$instance['text'] = '<p class="fb-local-fallback"><a href="https://www.facebook.com/Indian-Restaurant-Kamasutra-147277418692561/" target="_blank" rel="noopener noreferrer">Follow us on Facebook</a></p>';

		return $instance;
	},
	10,
	2
);
