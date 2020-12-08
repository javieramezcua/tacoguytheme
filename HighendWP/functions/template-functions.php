<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Highend
 * @since 3.5.0
 */

/**
 * Filters the amount of words used in the comment excerpt.
 *
 * @since 3.5.0
 * @param int $comment_excerpt_length The amount of words you want to display in the comment excerpt.
 */
function highend_comment_excerpt_length( $comment_excerpt_length ) {
	return 10;
}
add_filter( 'comment_excerpt_length', 'highend_comment_excerpt_length' );

/**
 * Remove template parts for page templates.
 *
 * @since 3.5.2
 */
function highend_remove_template_parts() {

	if ( highend_is_page_template( 'blank' ) ) {
		remove_action( 'highend_before_page_wrapper', 'highend_side_navigation' );
		remove_action( 'highend_header', 'highend_header' );
		remove_action( 'highend_after_header', 'highend_page_title' );
		remove_action( 'highend_after_header', 'highend_slider_section' );
		remove_action( 'highend_before_footer', 'highend_back_to_top' );
		remove_action( 'highend_before_footer', 'highend_quick_contact_form' );
	}

	if ( highend_is_page_template( array( 'presentation-fullwidth', 'blank' ) ) ) {
		remove_action( 'highend_before_footer', 'highend_pre_footer' );
		remove_action( 'highend_footer', 'highend_footer_widgets' );
		remove_action( 'highend_after_footer', 'highend_copyright' );
	}
}
add_action( 'template_redirect', 'highend_remove_template_parts' );
