<?php
/**
 * Replace Facebook Page Plugin widget with a simple link (avoids SDK console errors).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter(
	'widget_display_callback',
	static function ( $instance, $widget ) {
		if ( ! is_array( $instance ) || empty( $instance['text'] ) ) {
			return $instance;
		}
		if ( ! isset( $widget->id_base ) || 'text' !== $widget->id_base ) {
			return $instance;
		}
		if ( ! str_contains( $instance['text'], 'fb-page' ) && ! str_contains( $instance['text'], 'connect.facebook.net' ) ) {
			return $instance;
		}
		$instance['text'] = '<p class="fb-fallback"><a href="https://www.facebook.com/Indian-Restaurant-Kamasutra-147277418692561/" target="_blank" rel="noopener noreferrer">Follow us on Facebook</a></p>';

		return $instance;
	},
	10,
	2
);

add_action(
	'wp_enqueue_scripts',
	static function () {
		wp_dequeue_script( 'facebook-jssdk' );
		wp_deregister_script( 'facebook-jssdk' );
	},
	100
);
