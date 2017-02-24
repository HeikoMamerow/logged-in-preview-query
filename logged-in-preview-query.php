<?php

/**
 *
 * @link              https://heikomamerow.de
 * @since             1.0.0
 * @package           Logged_In_Preview_Query
 *
 * @wordpress-plugin
 * Plugin Name:       Logged in preview query
 * Plugin URI:        https://github.com/HeikoMamerow/logged-in-preview-query
 * Description:       Adds a query string to all links in page preview for logged in users like: https://example.org/postname?preview
 * Version:           1.0.0
 * Author:            Heiko Mamerow
 * Author URI:        https://heikomamerow.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       logged-in-preview-query
 * Domain Path:       /languages
 */

// Loading language files
load_plugin_textdomain(
	'logged-in-preview-query',
	false,
	dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
);

// Here is the magic :-)
add_action( 'init', 'lipq_wraper' );

function lipq_wraper() {
	if ( is_user_logged_in() ) {
		function lipq_wp_pages_permalink( $permalink_structure, $post_id ) {
			if ( empty( $post_id ) ) {
				return $permalink_structure;
			}
			$post = get_post( $post_id );

			return ( $permalink_structure . '?preview' );
		}

		add_filter( 'page_link', 'lipq_wp_pages_permalink', 10, 2 );
	}
}