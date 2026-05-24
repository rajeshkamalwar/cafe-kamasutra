<?php
/**
 * Prevent Restaurant Reservations wp_footer from killing the page before
 * RevSlider outputs revapi init (hero stays visibility:hidden otherwise).
 */
add_action(
	'wp_footer',
	static function () {
		global $rtb_controller;
		if ( ! isset( $rtb_controller ) || ! is_object( $rtb_controller ) ) {
			return;
		}
		remove_action( 'wp_footer', array( $rtb_controller, 'assets_footer' ), 2 );
		add_action(
			'wp_footer',
			static function () use ( $rtb_controller ) {
				if (
					empty( $rtb_controller->display_bookings_form_rendered )
					&& empty( $rtb_controller->form_rendered )
				) {
					return;
				}
				if ( ! isset( $rtb_controller->settings, $rtb_controller->locations ) ) {
					return;
				}
				try {
					$rtb_controller->assets_footer();
				} catch ( Throwable $e ) {
					if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
						error_log( 'RTB assets_footer: ' . $e->getMessage() );
					}
				}
			},
			2
		);
	},
	0
);
