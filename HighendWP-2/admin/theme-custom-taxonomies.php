<?php
/**
 * Register custom taxonomies.
 * 
 * @package Highend
 * @since   1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'highend_create_taxonomies' );

/**
 * Register custom taxonomies.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function highend_create_taxonomies() {
 
 	// FAQ Categories.
 	if ( highend_is_module_enabled( 'hb_module_faq' ) ) {

		$faq_category_labels = array(
			'name'                  => esc_html__( 'FAQ Categories', 'hbthemes' ),
			'singular_name'         => esc_html__( 'FAQ Category', 'hbthemes' ),
			'search_items'          => esc_html__( 'Search FAQ Categories', 'hbthemes' ),
			'all_items'             => esc_html__( 'All FAQ Categories', 'hbthemes' ),
			'parent_item'           => esc_html__( 'Parent FAQ Category', 'hbthemes' ),
			'parent_item_colon'     => esc_html__( 'Parent FAQ Category:', 'hbthemes' ),
			'edit_item'             => esc_html__( 'Edit FAQ Category', 'hbthemes' ),
			'update_item'           => esc_html__( 'Update FAQ Category', 'hbthemes' ),
			'add_new_item'          => esc_html__( 'Add New FAQ Category', 'hbthemes' ),
			'new_item_name'         => esc_html__( 'New FAQ Category Name', 'hbthemes' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from the most used FAQ categories', 'hbthemes' ),
		);

		register_taxonomy(
			'faq_categories',
			'faq',
			array(
				'hierarchical' => true,
				'labels'       => $faq_category_labels,
				'query_var'    => true,
				'rewrite'      => array(
					'slug' => apply_filters( 'highend_faq_category_rewrite', 'faq_category' ),
				),
			)
		);
	}

	// Testimonial Categories.
	if ( highend_is_module_enabled( 'hb_module_testimonials' ) ) {

		$testimonial_category_labels = array(
			'name'                  => esc_html__( 'Testimonial Categories', 'hbthemes' ),
			'singular_name'         => esc_html__( 'Testimonial Category', 'hbthemes' ),
			'search_items'          => esc_html__( 'Search Testimonial Categories', 'hbthemes' ),
			'all_items'             => esc_html__( 'All Testimonial Categories', 'hbthemes' ),
			'parent_item'           => esc_html__( 'Parent Testimonial Category', 'hbthemes' ),
			'parent_item_colon'     => esc_html__( 'Parent Testimonial Category:', 'hbthemes' ),
			'edit_item'             => esc_html__( 'Edit Testimonial Category', 'hbthemes' ),
			'update_item'           => esc_html__( 'Update Testimonial Category', 'hbthemes' ),
			'add_new_item'          => esc_html__( 'Add New Testimonial Category', 'hbthemes' ),
			'new_item_name'         => esc_html__( 'New Testimonial Category Name', 'hbthemes' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from the most used Testimonial categories', 'hbthemes' )
		);

		register_taxonomy(
			'testimonial_categories',
			'hb_testimonials',
			array(
				'hierarchical' => true,
				'labels'       => $testimonial_category_labels,
				'query_var'    => true,
				'rewrite'      => array(
					'slug' => apply_filters( 'highend_testimonial_category_rewrite', 'testimonial_category' ),
				),
			)
		);
	}

	// Client Categories
	if ( highend_is_module_enabled( 'hb_module_clients' ) ) {

		$client_category_labels = array(
			'name'                  => esc_html__( 'Client Categories', 'hbthemes' ),
			'singular_name'         => esc_html__( 'Client Category', 'hbthemes' ),
			'search_items'          => esc_html__( 'Search Client Categories', 'hbthemes' ),
			'all_items'             => esc_html__( 'All Client Categories', 'hbthemes' ),
			'parent_item'           => esc_html__( 'Parent Client Category', 'hbthemes' ),
			'parent_item_colon'     => esc_html__( 'Parent Client Category:', 'hbthemes' ),
			'edit_item'             => esc_html__( 'Edit Client Category', 'hbthemes' ),
			'update_item'           => esc_html__( 'Update Client Category', 'hbthemes' ),
			'add_new_item'          => esc_html__( 'Add New Client Category', 'hbthemes' ),
			'new_item_name'         => esc_html__( 'New Client Category Name', 'hbthemes' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from the most used Client categories', 'hbthemes' )
		);

		register_taxonomy(
			'client_categories',
			'clients',
			array(
				'hierarchical' => true,
				'labels'       => $client_category_labels,
				'query_var'    => true,
				'rewrite'      => array(
					'slug' => apply_filters( 'highend_client_category_rewrite', 'client_category' ),
				),
			)
		);
	}

	// Team Member Categories.
	if ( highend_is_module_enabled( 'hb_module_team_members' ) ) {

		$team_member_category_labels = array(
			'name'                  => esc_html__( 'Team Categories', 'hbthemes' ),
			'singular_name'         => esc_html__( 'Team Member Category', 'hbthemes' ),
			'search_items'          => esc_html__( 'Search Team Member Categories', 'hbthemes' ),
			'all_items'             => esc_html__( 'All Team Member Categories', 'hbthemes' ),
			'parent_item'           => esc_html__( 'Parent Team Member Category', 'hbthemes' ),
			'parent_item_colon'     => esc_html__( 'Parent Team Member Category:', 'hbthemes' ),
			'edit_item'             => esc_html__( 'Edit Team Member Category', 'hbthemes' ),
			'update_item'           => esc_html__( 'Update Team Member Category', 'hbthemes' ),
			'add_new_item'          => esc_html__( 'Add New Team Member Category', 'hbthemes' ),
			'new_item_name'         => esc_html__( 'New Team Member Category Name', 'hbthemes' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from the most used Team Member categories', 'hbthemes' )
		);

		register_taxonomy(
			'team_categories',
			'team',
			array(
				'hierarchical' => true,
				'labels'       => $team_member_category_labels,
				'query_var'    => true,
				'rewrite'      => array(
					'slug' => apply_filters( 'highend_team_member_category_rewrite', 'team_member_category' ),
				),
			)
		);
	}
}
