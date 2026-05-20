<?php
/**
 * Localhost URLs must match the page scheme. Chrome does not upgrade mixed
 * content on localhost, so http:// assets on an https:// tab are blocked.
 *
 * Protocol-relative //localhost/... inherits https or http from the page.
 */
if ( ! isset( $_SERVER['HTTP_HOST'] ) ) {
	return;
}

$host = strtolower( (string) $_SERVER['HTTP_HOST'] );
if ( ! str_contains( $host, 'localhost' ) && ! str_contains( $host, '127.0.0.1' ) ) {
	return;
}

/**
 * @param string $url
 */
function cafek_local_to_protocol_relative( $url ) {
	if ( ! is_string( $url ) || $url === '' ) {
		return $url;
	}
	return preg_replace( '#^https?://(localhost|127\.0\.0\.1)#i', '//$1', $url );
}

/**
 * @param string $html
 */
function cafek_local_rewrite_localhost_urls( $html ) {
	if ( ! is_string( $html ) || $html === '' ) {
		return $html;
	}
	return preg_replace( '#https?://(localhost|127\.0\.0\.1)#i', '//$1', $html );
}

$url_filters = array(
	'home_url',
	'site_url',
	'plugins_url',
	'content_url',
	'stylesheet_directory_uri',
	'template_directory_uri',
	'script_loader_src',
	'style_loader_src',
	'wp_get_attachment_url',
	'wp_calculate_image_srcset',
);

foreach ( $url_filters as $filter ) {
	add_filter( $filter, 'cafek_local_to_protocol_relative', 999 );
}

add_filter( 'the_content', 'cafek_local_rewrite_localhost_urls', 999 );
add_filter( 'widget_text', 'cafek_local_rewrite_localhost_urls', 999 );
add_filter( 'widget_text_content', 'cafek_local_rewrite_localhost_urls', 999 );

add_action(
	'template_redirect',
	static function () {
		if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
			return;
		}
		ob_start(
			static function ( $html ) {
				return cafek_local_rewrite_localhost_urls( $html );
			}
		);
	},
	0
);
