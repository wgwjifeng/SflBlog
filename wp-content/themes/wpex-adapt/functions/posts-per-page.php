<?php
/**
 * This file filters the default WP pagination where needed
 *
 * @package WordPress
 * @subpackage Adapt
 * @since Adapt 2.0
*/

$wpex_option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'wpex_modify_posts_per_page', 0);

if ( ! function_exists( 'wpex_modify_posts_per_page' ) ) {
	function wpex_modify_posts_per_page() {
		add_filter( 'option_posts_per_page', 'wpex_option_posts_per_page' );
	}
}

if ( ! function_exists ( 'wpex_option_posts_per_page' ) ) {
	function wpex_option_posts_per_page( $value ) {
		global $wpex_option_posts_per_page;
		if( is_tax('portfolio_category') || is_tax('portfolio_tag') || is_post_type_archive('portfolio') ) {
			return wpex_get_data('portfolio_pagination','12');
		}
		if( is_search() ) {
			return wpex_get_data('search_pagination','10');
		}
		else {
			return $wpex_option_posts_per_page;
		}
	}
}