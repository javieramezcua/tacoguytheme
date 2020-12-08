<?php
/**
 * Register custom post types.
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

add_action( 'init', 'highend_register_post_types' );

/**
 * Register a custom post types.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 */
function highend_register_post_types () {

	// Team member post type.
	if ( highend_is_module_enabled( 'hb_module_team_members' ) ) {
		register_post_type(
			'team',
			array(
				'labels'              => array(
					'name'               => esc_html__( 'Team Members', 'hbthemes'),
					'all_items'          => esc_html__( 'All Members', 'hbthemes' ),
					'singular_name'      => esc_html__( 'Team Member', 'hbthemes' ),
					'add_new'            => esc_html__( 'Add New', 'hbthemes' ),
					'add_new_item'       => esc_html__( 'Add New Team Member', 'hbthemes' ),
					'edit_item'          => esc_html__( 'Edit Team Member', 'hbthemes' ),
					'new_item'           => esc_html__( 'New Team Member', 'hbthemes' ),
					'view_item'          => esc_html__( 'View Team Member', 'hbthemes' ),
					'search_items'       => esc_html__( 'Search Team Members', 'hbthemes' ),
					'not_found'          => esc_html__( 'No team members have been added yet', 'hbthemes' ),
					'not_found_in_trash' => esc_html__( 'Nothing found in Trash', 'hbthemes' ),
					'parent_item_colon'  => '',
				),
				'public'              => true,
				'show_ui'             => true,
				'_builtin'            => false,
				'_edit_link'          => 'post.php?post=%d',
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'menu_position'       => 100,
				'supports'            => array(
					'editor',
					'title', 
					'excerpt',
					'thumbnail',
					'page-attributes',
				),
				'query_var'           => true,
				'exclude_from_search' => false,
				'show_in_nav_menus'   => true,
				'menu_icon'           => 'dashicons-id',
			)
		);
	}

	// Client post type.
	if ( highend_is_module_enabled( 'hb_module_clients' ) ) {
		register_post_type(
			'clients',
			array(
				'labels'              => array(
					'name'               => esc_html__( 'Clients', 'hbthemes' ),
					'all_items'          => esc_html__( 'All Clients', 'hbthemes' ),
					'singular_name'      => esc_html__( 'Client', 'hbthemes' ),
					'add_new'            => esc_html__( 'Add New Client', 'hbthemes' ),
					'add_new_item'       => esc_html__( 'Add New Client', 'hbthemes' ),
					'edit_item'          => esc_html__( 'Edit Client', 'hbthemes' ),
					'new_item'           => esc_html__( 'New Client', 'hbthemes' ),
					'view_item'          => esc_html__( 'View Client', 'hbthemes' ),
					'search_items'       => esc_html__( 'Search For Clients', 'hbthemes' ),
					'not_found'          => esc_html__( 'No Clients found', 'hbthemes' ),
					'not_found_in_trash' => esc_html__( 'No Clients found in Trash', 'hbthemes' ),
					'parent_item_colon'  => '',
				),
				'public'              => true,
				'publicly_queryable'  => false,
				'show_ui'             => true,
				'_builtin'            => false,
				'_edit_link'          => 'post.php?post=%d',
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'menu_position'       => 100,
				'supports'            => array(
					'title', 
					'page-attributes',
				),
				'query_var'           => true,
				'exclude_from_search' => true,
				'show_in_nav_menus'   => false,
				'menu_icon'           => 'dashicons-businessman',
			)
		);
	}

	// FAQ post type.
	if ( highend_is_module_enabled( 'hb_module_faq' ) ) {
		register_post_type(
			'faq',
			array(
				'labels'             => array (
					'name'               => esc_html__( 'FAQ', 'hbthemes' ),
					'all_items'          => esc_html__( 'All FAQ Items', 'hbthemes' ),
					'singular_name'      => esc_html__( 'FAQ Item', 'hbthemes' ),
					'add_new'            => esc_html__( 'Add New FAQ Item', 'hbthemes' ),
					'add_new_item'       => esc_html__( 'Add New FAQ Item', 'hbthemes' ),
					'edit_item'          => esc_html__( 'Edit FAQ Item', 'hbthemes' ),
					'new_item'           => esc_html__( 'New FAQ Item', 'hbthemes' ),
					'view_item'          => esc_html__( 'View FAQ Item', 'hbthemes' ),
					'search_items'       => esc_html__( 'Search For FAQ Items', 'hbthemes' ),
					'not_found'          => esc_html__( 'No FAQ Items found', 'hbthemes' ),
					'not_found_in_trash' => esc_html__( 'No FAQ Items found in Trash', 'hbthemes' ),
					'parent_item_colon'  => '',
				),
				'public'             => true,
				'show_ui'            => true,
				'_builtin'           => false,
				'_edit_link'         => 'post.php?post=%d',
				'capability_type'    => 'post',
				'hierarchical'       => false,
				'menu_position'      => 100,
				'supports'           => array(
					'title',
					'editor',
					'page-attributes',
					'custom-fields',
					'comments'
				),
				'query_var'           => true,
				'exclude_from_search' => false,
				'show_in_nav_menus'   => true,
				'menu_icon'           => 'dashicons-editor-help',
			)
		);
	}

	// Pricing table post type.
	if ( highend_is_module_enabled( 'hb_module_pricing_tables' ) ) {
		register_post_type(
			'hb_pricing_table',
			array(
				'labels'              => array(
					'name'               => esc_html__( 'Pricing Tables', 'hbthemes' ),
					'all_items'          => esc_html__( 'All Pricing Tables', 'hbthemes' ),
					'singular_name'      => esc_html__( 'Pricing Table' , 'hbthemes' ),
					'add_new'            => esc_html__( 'Add Pricing Table', 'hbthemes' ),
					'add_new_item'       => esc_html__( 'Add New Pricing Table', 'hbthemes' ),
					'edit_item'          => esc_html__( 'Edit Pricing Table', 'hbthemes' ),
					'new_item'           => esc_html__( 'New Pricing Table', 'hbthemes' ),
					'view_item'          => esc_html__( 'View Pricing Table', 'hbthemes' ),
					'search_items'       => esc_html__( 'Search For Pricing Tables', 'hbthemes' ),
					'not_found'          => esc_html__( 'No Pricing Tables found', 'hbthemes' ),
					'not_found_in_trash' => esc_html__( 'No Pricing Tables found in Trash', 'hbthemes' ),
					'parent_item_colon'  => '',
				),
				'public'              => true,
				'publicly_queryable'  => false,
				'show_ui'             => true,
				'_builtin'            => false,
				'_edit_link'          => 'post.php?post=%d',
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'menu_position'       => 100,
				'supports'            => array(
					'title',  
					'page-attributes',
					'custom-fields',
				),
				'query_var'           => false,
				'exclude_from_search' => true,
				'show_in_nav_menus'   => false,
				'menu_icon'           => 'dashicons-tag',
			)
		);
	}

	// Testimonials post type.
	if ( highend_is_module_enabled( 'hb_module_testimonials' ) ) {
		register_post_type(
			'hb_testimonials',
			array(
				'labels'              => array(
					'name'               => esc_html__( 'Testimonials', 'hbthemes' ),
					'all_items'          => esc_html__( 'All Testimonials' , 'hbthemes' ),
					'singular_name'      => esc_html__( 'Testimonial', 'hbthemes' ),
					'add_new'            => esc_html__( 'Add Testimonial', 'hbthemes' ),
					'add_new_item'       => esc_html__( 'Add New Testimonial', 'hbthemes' ),
					'edit_item'          => esc_html__( 'Edit Testimonial', 'hbthemes' ),
					'new_item'           => esc_html__( 'New Testimonial', 'hbthemes' ),
					'view_item'          => esc_html__( 'View Testimonial', 'hbthemes' ),
					'search_items'       => esc_html__( 'Search For Testimonials', 'hbthemes' ),
					'not_found'          => esc_html__( 'No Testimonials found', 'hbthemes' ),
					'not_found_in_trash' => esc_html__( 'No Testimonials found in Trash', 'hbthemes' ),
					'parent_item_colon'  => '',
				),
				'public'              => true,
				'show_ui'             => true,
				'_builtin'            => false,
				'_edit_link'          => 'post.php?post=%d',
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'menu_position'       => 100,
				'supports'            => array(
						'title',  
						'page-attributes',
						'custom-fields',
						'editor',
						'comments',
						),
				'query_var'           => false,
				'exclude_from_search' => true,
				'show_in_nav_menus'   => false,
				'menu_icon'           => 'dashicons-format-quote',
			)
		);
	}
}

add_filter( 'manage_posts_columns', 'highend_add_post_thumbnail_column', 5 );

/**
 * Add a column for Featured image on admin post column.
 *
 * @since 3.5.0
 */
function highend_add_post_thumbnail_column( $columns ) {

	$columns['highend_post_thumb'] = esc_html__( 'Featured Image', 'hbthemes' );
	return $columns;
}

add_action( 'manage_posts_custom_column', 'highend_display_post_thumbnail_column', 5, 2 );

/**
 * Display post thumbnails on admin post column.
 *
 * @since 3.5.0
 */
function highend_display_post_thumbnail_column( $column, $id ) {

	switch ( $column ) {
		case 'highend_post_thumb':
			if ( function_exists( 'the_post_thumbnail' ) ) {
				echo the_post_thumbnail( 'thumbnail' );
			}
			break;
	}
}
