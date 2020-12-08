<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * You can override functions wrapped with function_exists() call by defining
 * them first in your child theme's functions.php file.
 *
 * @package Highend
 * @since   1.0.0
 */

/**
 * Define constants.
 */
define( 'HBTHEMES_ROOT', get_template_directory() );
define( 'HBTHEMES_URI', get_template_directory_uri() );
define( 'HBTHEMES_INCLUDES', HBTHEMES_ROOT . '/includes' );
define( 'HBTHEMES_ADMIN', HBTHEMES_ROOT . '/admin' );
define( 'HBTHEMES_FUNCTIONS', HBTHEMES_ROOT . '/functions' );
define( 'HBTHEMES_ADMIN_URI', HBTHEMES_URI . '/admin' );
define( 'HB_THEME_VERSION', wp_get_theme( 'HighendWP' )->get( 'Version' ) );

if ( ! function_exists( 'highend_theme_setup' ) ) {

	/**
	 * Basic theme setup function.
	 *
	 * @since 3.4.1
	 */
	function highend_theme_setup() {

		// Load textdomain.
		load_theme_textdomain( 'hbthemes', HBTHEMES_ROOT . '/languages' );

		// Add theme support.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support(
			'post-formats',
			array(
				'gallery',
				'image',
				'quote',
				'video',
				'audio',
				'status',
				'link',
			)
		);

		// Add support for WooCommerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Register Navigations.
		register_nav_menus(
			array(
				'main-menu'     => esc_html__( 'Main Menu', 'hbthemes' ),
				'footer-menu'   => esc_html__( 'Footer Menu', 'hbthemes' ),
				'mobile-menu'   => esc_html__( 'Mobile Menu', 'hbthemes' ),
				'one-page-menu' => esc_html__( 'One Page Menu', 'hbthemes' ),
			)
		);

		// Set content width.
		if ( ! isset( $content_width ) ) {
			if ( '940px' === hb_options( 'hb_content_width' ) ) {
				$content_width = 940;
			} else {
				$content_width = 1140;
			}
		}

		// Add support for Gutenberg editor.
		add_theme_support( 'align-wide' );

		global $themeoptions;

		if ( defined( 'WP_ADMIN' ) && WP_ADMIN ) {
			require_once 'includes/tinymce/shortcode-popup.php';
		}
	}
}
add_action( 'after_setup_theme', 'highend_theme_setup' );

/* Start Highend 3.4.1 Update */
require get_theme_file_path( 'hbframework/hbframework.php' );

/**
 * Register Widget Areas.
 *
 * @since 3.5.0
 */
function highend_widgets_init() {

	// Default Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Default Sidebar', 'hbthemes' ),
			'id'            => 'hb-default-sidebar',
			'description'   => esc_html__( 'This is a default sidebar for widgets. You can create unlimited sidebars in Highend > Sidebar Manager. You need to select this sidebar in page meta settings to display it.', 'hbthemes' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	// Side Panel Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Side Panel Section', 'hbthemes' ),
			'id'            => 'hb-side-section-sidebar',
			'description'   => esc_html__( 'Add your widgets for the side panel section here. Make sure you have enabled the offset side panel section option in Highend Options > Layout Settings > Header Settings.', 'hbthemes' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	// Sidebar Attributes.
	$sidebar_attr = array(
		'name'          => '',
		'description'   => __( 'This is an area for widgets. Drag and drop your widgets here.', 'hbthemes' ),
		'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	);

	$sidebar_id    = 0;
	$sidebar_names = array(
		'Footer 1',
		'Footer 2',
		'Footer 3',
		'Footer 4',
	);

	foreach ( $sidebar_names as $sidebar_name ) {
		$sidebar_attr['name'] = $sidebar_name;
		$sidebar_attr['id']   = 'custom-sidebar' . ( $sidebar_id++ );
		register_sidebar( $sidebar_attr );
	}
}
add_action( 'widgets_init', 'highend_widgets_init' );

/**
 * Enqueue and register scripts and styles.
 *
 * @since 3.5.0
 */
function highend_enqueues() {

	// Main stylesheet.
	wp_enqueue_style(
		'highend-style',
		get_parent_theme_file_uri() . '/style.css',
		false,
		HB_THEME_VERSION,
		'all'
	);

	// Responsive stylesheet.
	if ( hb_options( 'hb_responsive' ) ) {
		wp_enqueue_style(
			'highend_responsive',
			HBTHEMES_URI . '/assets/css/responsive.css',
			false,
			HB_THEME_VERSION,
			'all'
		);
	}

	// Icons.
	wp_enqueue_style(
		'highend_icomoon',
		HBTHEMES_URI . '/assets/css/icons.css',
		false,
		HB_THEME_VERSION,
		'all'
	);

	// Main script.
	wp_enqueue_script(
		'highend_scripts',
		HBTHEMES_URI . '/assets/js/scripts.js',
		array( 'jquery' ),
		HB_THEME_VERSION,
		true
	);

	// Countdown JS.
	wp_register_script(
		'highend-countdown-js',
		HBTHEMES_URI . '/assets/js/jquery.countdown.js',
		array( 'jquery' ),
		HB_THEME_VERSION,
		true
	);

	// PrettyPhoto JS.
	wp_register_script(
		'highend-prettyphoto-js',
		HBTHEMES_URI . '/assets/js/jquery.prettyPhoto.js',
		array( 'jquery' ),
		HB_THEME_VERSION,
		true
	);

	if ( highend_is_module_enabled( 'hb_module_prettyphoto' ) ) {
		wp_enqueue_script( 'highend-prettyphoto-js' );
	}

	// jQuery Pace JS.
	if ( 'ytube-like' === hb_options( 'hb_queryloader' ) ) {
		wp_enqueue_script(
			'highend-jquery-pace-js',
			HBTHEMES_URI . '/assets/js/jquery.pace.js',
			array( 'jquery' ),
			HB_THEME_VERSION,
			true
		);
	}

	if ( ! highend_is_maintenance() ) {

		// Google jsapi.
		wp_register_script(
			'highend-google-jsapi',
			'//www.google.com/jsapi',
			null,
			HB_THEME_VERSION,
			true
		);

		wp_register_script(
			'highend-google-map',
			HBTHEMES_URI . '/assets/js/map.js',
			array( 'jquery', 'highend-google-jsapi' ),
			HB_THEME_VERSION,
			true
		);

		wp_enqueue_script( 'highend_flexslider', HBTHEMES_URI . '/assets/js/jquery.flexslider.js', array( 'jquery' ), HB_THEME_VERSION, true );
		wp_enqueue_script( 'highend_validate', HBTHEMES_URI . '/assets/js/jquery.validate.js', array( 'jquery' ), HB_THEME_VERSION, true );
		wp_enqueue_script( 'highend_carousel', HBTHEMES_URI . '/assets/js/responsivecarousel.min.js', array( 'jquery' ), HB_THEME_VERSION, true );
		wp_enqueue_script( 'highend_owl_carousel', HBTHEMES_URI . '/assets/js/jquery.owl.carousel.min.js', array( 'jquery' ), HB_THEME_VERSION, true );

		// Easy Char.
		wp_register_script(
			'highend-easychart-js',
			HBTHEMES_URI . '/assets/js/jquery.easychart.js',
			array( 'jquery' ),
			HB_THEME_VERSION,
			true
		);

		if ( vp_metabox( 'misc_settings.hb_onepage' ) ) {
			wp_enqueue_script( 'highend_nav', HBTHEMES_URI . '/assets/js/jquery.nav.js', array( 'jquery' ), HB_THEME_VERSION, true );
		}

		if ( hb_options( 'hb_ajax_search' ) ) {
			wp_enqueue_script( 'jquery-ui-autocomplete' );
		}

		if ( 'hb-bokeh-effect' === vp_metabox( 'featured_section.hb_featured_section_effect' ) ) {
			wp_enqueue_script( 'highend_fs_effects', HBTHEMES_URI . '/assets/js/canvas-effects.js', array( 'jquery' ), HB_THEME_VERSION, true );
		} elseif ( 'hb-clines-effect' === vp_metabox( 'featured_section.hb_featured_section_effect' ) ) {
			wp_enqueue_script( 'highend_cl_effects', HBTHEMES_URI . '/assets/js/canvas-lines.js', array( 'jquery' ), HB_THEME_VERSION, true );
		}

		wp_localize_script( 'highend-google-map', 'hb_gmap', highend_map_json() );
	}

	if ( highend_is_page_template( 'presentation-fullwidth' ) ) {
		wp_enqueue_script( 'highend_fullpage', HBTHEMES_URI . '/assets/js/jquery.fullpage.js', array( 'jquery' ), HB_THEME_VERSION, true );
	}

	wp_enqueue_script( 'highend_jquery_custom', HBTHEMES_URI . '/assets/js/jquery.custom.js', array( 'jquery' ), HB_THEME_VERSION, true );

	$highend_vars = array(
		'ajaxurl'              => admin_url( 'admin-ajax.php' ),
		'nonce'                => wp_create_nonce( 'highend_nonce' ),
		'paged'                => get_query_var( 'paged' ) ? get_query_var( 'paged' ) + 1 : 2,
		'search_header'        => intval( hb_options( 'hb_search_in_menu' ) ),
		'cart_url'             => '',
		'cart_count'           => '',
		'responsive'           => hb_options( 'hb_responsive' ),
		'header_height'        => hb_options( 'hb_regular_header_height' ),
		'sticky_header_height' => hb_options( 'hb_sticky_header_height' ),
		'texts'                => array(
			'load-more'     => esc_html__( 'Load More Posts', 'hbthemes' ),
			'no-more-posts' => esc_html__( 'No More Posts', 'hbthemes' ),
			'day'           => esc_html__( 'day', 'hbthemes' ),
			'days'          => esc_html__( 'days', 'hbthemes' ),
			'hour'          => esc_html__( 'hour', 'hbthemes' ),
			'hours'         => esc_html__( 'hours', 'hbthemes' ),
			'minute'        => esc_html__( 'minute', 'hbthemes' ),
			'minutes'       => esc_html__( 'minutes', 'hbthemes' ),
			'second'        => esc_html__( 'second', 'hbthemes' ),
			'seconds'       => esc_html__( 'seconds', 'hbthemes' ),
		),
	);
	$highend_vars = apply_filters( 'highend_custom_js_localized', $highend_vars );

	wp_localize_script( 'highend_jquery_custom', 'highend_vars', $highend_vars );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Add additional theme styles.
	do_action( 'highend_enqueue_scripts' );
}
add_action( 'wp_enqueue_scripts', 'highend_enqueues' );

/**
 * Enqueue and register admin scripts and styles.
 *
 * @since 3.5.0
 */
function highend_admin_enqueues() {

	$screen = get_current_screen();

	// Admin styles.
	wp_enqueue_style(
		'highend_admin_style',
		HBTHEMES_URI . '/admin/assets/css/highend-admin.css',
		false,
		HB_THEME_VERSION,
		'all'
	);

	if ( 'widgets' === $screen->base ) {
		wp_enqueue_script(
			'hb-admin-widgets-js',
			HBTHEMES_URI . '/admin/assets/js/admin-widgets.js',
			array( 'jquery', 'media-upload' ),
			HB_THEME_VERSION,
			true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'highend_admin_enqueues' );

/* Automatic Theme updates */
if ( class_exists( 'ThemeUpdateChecker' ) ) {
	$highend_updates = new ThemeUpdateChecker(
		'HighendWP',
		'http://hb-themes.com/update/?action=get_metadata&slug=HighendWP'
	);
}

// Redirect to About page when activated.
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	header( 'Location: ' . admin_url() . 'admin.php?page=hb_about' );
}

/*
 RETRIEVE FROM THEME OPTIONS
================================================== */
function hb_options( $name, $default = '' ) {
	if ( function_exists( 'vp_option' ) ) {
		return apply_filters( 'highend_options_value', vp_option( 'hb_highend_option.' . $name, $default ), $name );
	}
	return;
}

remove_filter( 'nav_menu_description', 'strip_tags' );

/*
 INCLUDES
================================================== */

require HBTHEMES_ADMIN . '/author-meta.php';
require HBTHEMES_ADMIN . '/class-install.php';

if ( is_admin() ) {
	include HBTHEMES_ADMIN . '/metabox/class-metabox.php';
}

require HBTHEMES_FUNCTIONS . '/helpers.php';
require HBTHEMES_FUNCTIONS . '/common.php';
require HBTHEMES_FUNCTIONS . '/deprecated.php';
require HBTHEMES_FUNCTIONS . '/template-parts.php';
require HBTHEMES_FUNCTIONS . '/template-functions.php';
require HBTHEMES_FUNCTIONS . '/dynamic-styles.php';

require 'admin/theme-custom-post-types.php';
require 'admin/theme-custom-taxonomies.php';

require 'options-framework/bootstrap.php';
require 'admin/theme-options-dependency.php';
require 'admin/metaboxes/metabox-dependency.php';
if ( ! defined( 'RWMB_VER' ) ) {
	include 'admin/metaboxes/meta-box-master/meta-box.php';
}
require 'admin/metaboxes/gallery-multiupload.php';
require 'functions/breadcrumbs.php';
require 'functions/theme-likes.php';
require 'functions/theme-thumbnails-resize.php';
// include ( 'functions/pagination-ajax.php');
require 'includes/shortcodes.php';

/*
 THEME OPTIONS
================================================== */
// add_action('after_setup_theme', 'hb_init_options');
if ( ! function_exists( 'hb_init_options' ) ) {
	function hb_init_options() {
		if ( class_exists( 'VP_Option' ) ) {
			global $themeoptions;
			$tmpl_opt     = HBTHEMES_ADMIN . '/theme-options.php';
			$themeoptions = new VP_Option(
				array(
					'is_dev_mode'           => false,
					'option_key'            => 'hb_highend_option',
					'page_slug'             => 'highend_options',
					'template'              => $tmpl_opt,
					'menu_page'             => 'hb_about',
					'use_auto_group_naming' => true,
					'use_exim_menu'         => false,
					'minimum_role'          => 'edit_theme_options',
					'layout'                => 'fixed',
					'page_title'            => __( 'Highend Options', 'hbthemes' ),
					'menu_label'            => '<span style="color:#00b9eb;border-bottom:solid 2px #00b9eb;">' . __( 'Highend Options', 'hbthemes' ) . '</span>',
				)
			);
		}
	}
}
hb_init_options();

/*
 METABOXES
================================================== */
function hb_init_metaboxes() {

	if ( highend_is_module_enabled( 'hb_module_pricing_tables' ) ) {
		$mb_path_pricing_settings = HBTHEMES_ADMIN . '/metaboxes/meta-pricing-table-settings.php';
		$mb_post_settings         = new VP_Metabox(
			array(
				'id'          => 'pricing_settings',
				'types'       => array(
					'hb_pricing_table',
				),
				'title'       => __( 'Pricing Settings', 'hbthemes' ),
				'priority'    => 'low',
				'is_dev_mode' => false,
				'template'    => $mb_path_pricing_settings,
			)
		);
	}

	if ( highend_is_module_enabled( 'hb_module_testimonials' ) ) {
		$mb_path_testimonials_settings = HBTHEMES_ADMIN . '/metaboxes/meta-testimonials.php';
		$mb_post_settings              = new VP_Metabox(
			array(
				'id'          => 'testimonial_type_settings',
				'types'       => array(
					'hb_testimonials',
				),
				'title'       => __( 'Testimonial Settings', 'hbthemes' ),
				'priority'    => 'low',
				'is_dev_mode' => false,
				'template'    => $mb_path_testimonials_settings,
			)
		);
	}

	if ( highend_is_module_enabled( 'hb_module_team_members' ) ) {
		$mb_path_team_layout_settings = HBTHEMES_ADMIN . '/metaboxes/meta-team-layout-settings.php';
		$mb_post_settings             = new VP_Metabox(
			array(
				'id'          => 'team_layout_settings',
				'types'       => array(
					'team',
				),
				'title'       => __( 'Team Layout Settings', 'hbthemes' ),
				'priority'    => 'low',
				'is_dev_mode' => false,
				'context'     => 'side',
				'template'    => $mb_path_team_layout_settings,
			)
		);

		$mb_path_team_member_settings = HBTHEMES_ADMIN . '/metaboxes/meta-team-member-settings.php';
		$mb_post_settings             = new VP_Metabox(
			array(
				'id'          => 'team_member_settings',
				'types'       => array(
					'team',
				),
				'title'       => __( 'Team Member Settings', 'hbthemes' ),
				'priority'    => 'low',
				'is_dev_mode' => false,
				'template'    => $mb_path_team_member_settings,
			)
		);
	}

	if ( highend_is_module_enabled( 'hb_module_clients' ) ) {
		$mb_path_clients_settings = HBTHEMES_ADMIN . '/metaboxes/meta-clients-settings.php';
		$mb_post_settings         = new VP_Metabox(
			array(
				'id'          => 'clients_settings',
				'types'       => array(
					'clients',
				),
				'title'       => __( 'Clients Settings', 'hbthemes' ),
				'priority'    => 'low',
				'is_dev_mode' => false,
				'template'    => $mb_path_clients_settings,
			)
		);
	}

	$mb_path_presentation_settings = HBTHEMES_ADMIN . '/metaboxes/meta-presentation-settings.php';
	$mb_presentation_settings      = new VP_Metabox(
		array(
			'id'          => 'presentation_settings',
			'types'       => array(
				'page',
			),
			'title'       => __( 'Presentation Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_presentation_settings,
		)
	);

	$mb_path_featured_section_settings = HBTHEMES_ADMIN . '/metaboxes/meta-featured-page-section.php';
	$mb_post_settings                  = new VP_Metabox(
		array(
			'id'          => 'featured_section',
			'types'       => array(
				'page',
				'team',
			),
			'title'       => __( 'Featured Section Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_featured_section_settings,
		)
	);

	$mb_path_contact_page_template_settings = HBTHEMES_ADMIN . '/metaboxes/meta-contact-page-settings.php';
	$mb_post_settings                       = new VP_Metabox(
		array(
			'id'          => 'contact_page_settings',
			'types'       => array(
				'page',
			),
			'title'       => __( 'Contact Template Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_contact_page_template_settings,
		)
	);

	$mb_path_post_format_settings        = HBTHEMES_ADMIN . '/metaboxes/meta-post-format-settings.php';
	$mb_post_settings                    = new VP_Metabox(
		array(
			'id'          => 'post_format_settings',
			'types'       => array(
				'post',
			),
			'title'       => __( 'Post Format Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_post_format_settings,
		)
	);
	$mb_path_blog_page_template_settings = HBTHEMES_ADMIN . '/metaboxes/meta-blog-page-settings.php';
	$mb_post_settings                    = new VP_Metabox(
		array(
			'id'          => 'blog_page_settings',
			'types'       => array(
				'page',
			),
			'title'       => __( 'Classic Blog Template Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_blog_page_template_settings,
		)
	);

	$mb_path_blog_page_minimal_template_settings = HBTHEMES_ADMIN . '/metaboxes/meta-blog-page-minimal-settings.php';
	$mb_post_settings                            = new VP_Metabox(
		array(
			'id'          => 'blog_page_minimal_settings',
			'types'       => array(
				'page',
			),
			'title'       => __( 'Minimal Blog Template Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_blog_page_minimal_template_settings,
		)
	);

	$mb_path_grid_blog_page_template_settings = HBTHEMES_ADMIN . '/metaboxes/meta-blog-grid-page-settings.php';
	$mb_post_settings                         = new VP_Metabox(
		array(
			'id'          => 'blog_grid_page_settings',
			'types'       => array(
				'page',
			),
			'title'       => __( 'Grid Blog Template Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_grid_blog_page_template_settings,
		)
	);

	$mb_path_fw_blog_page_template_settings = HBTHEMES_ADMIN . '/metaboxes/meta-blog-fw-page-settings.php';
	$mb_post_settings                       = new VP_Metabox(
		array(
			'id'          => 'blog_fw_page_settings',
			'types'       => array(
				'page',
			),
			'title'       => __( 'Fullwidth Blog Template Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_fw_blog_page_template_settings,
		)
	);

	$mb_path_general_settings = HBTHEMES_ADMIN . '/metaboxes/meta-general-settings.php';
	$mb_post_settings         = new VP_Metabox(
		array(
			'id'          => 'general_settings',
			'types'       => array(
				'post',
				'page',
				'team',
				'portfolio',
				'faq',
			),
			'title'       => __( 'General Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_general_settings,
		)
	);

	$mb_path_layout_settings = HBTHEMES_ADMIN . '/metaboxes/meta-layout-settings.php';
	$mb_post_settings        = new VP_Metabox(
		array(
			'id'          => 'layout_settings',
			'types'       => array(
				'post',
				'page',
			),
			'title'       => __( 'Layout Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'context'     => 'side',
			'template'    => $mb_path_layout_settings,
		)
	);

	$mb_path_background_settings = HBTHEMES_ADMIN . '/metaboxes/meta-background-settings.php';
	$mb_post_settings            = new VP_Metabox(
		array(
			'id'          => 'background_settings',
			'types'       => array(
				'post',
				'page',
				'team',
				'portfolio',
				'faq',
			),
			'title'       => __( 'Background Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_background_settings,
		)
	);

	$mb_path_misc_settings = HBTHEMES_ADMIN . '/metaboxes/meta-misc-settings.php';
	$mb_post_settings      = new VP_Metabox(
		array(
			'id'          => 'misc_settings',
			'types'       => array(
				'post',
				'page',
				'team',
				'portfolio',
				'faq',
			),
			'title'       => __( 'Misc Settings', 'hbthemes' ),
			'priority'    => 'low',
			'is_dev_mode' => false,
			'template'    => $mb_path_misc_settings,
		)
	);
}
add_action( 'init', 'hb_init_metaboxes' );


/*
 SEARCH FILTER
================================================== */
add_action( 'pre_get_posts', 'hb_search_filter' );
if ( ! function_exists( 'hb_search_filter' ) ) {
	function hb_search_filter( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {
			if ( $query->is_search ) {
				$query->set( 's', rtrim( get_search_query() ) );
			}
		}
	}
}

/*
 CUSTOM WordPress LOGIN LOGO
================================================== */
add_action( 'login_head', 'hb_custom_login_logo' );
function hb_custom_login_logo() {
	if ( hb_options( 'hb_wordpress_logo' ) ) {
		echo '<style type="text/css">
			h1 a { background-image:url(' . hb_options( 'hb_wordpress_logo' ) . ') !important; background-size:contain !important; width:274px !important; height: 63px !important; }
		</style>';
	}
}

add_filter( 'login_headerurl', 'hb_custom_login_logo_url' );
function hb_custom_login_logo_url( $url ) {
	return get_site_url();
}


/*
  THEME WIDGETS
================================================== */
require HBTHEMES_INCLUDES . '/widgets/widget-most-commented-posts.php';
require HBTHEMES_INCLUDES . '/widgets/widget-latest-posts.php';
require HBTHEMES_INCLUDES . '/widgets/widget-latest-posts-simple.php';
require HBTHEMES_INCLUDES . '/widgets/widget-most-liked-posts.php';
require HBTHEMES_INCLUDES . '/widgets/widget-recent-comments.php';
require HBTHEMES_INCLUDES . '/widgets/widget-testimonials.php';
require HBTHEMES_INCLUDES . '/widgets/widget-pinterest.php';
require HBTHEMES_INCLUDES . '/widgets/widget-flickr.php';
require HBTHEMES_INCLUDES . '/widgets/widget-dribbble.php';
require HBTHEMES_INCLUDES . '/widgets/widget-google.php';
require HBTHEMES_INCLUDES . '/widgets/widget-facebook.php';
require HBTHEMES_INCLUDES . '/widgets/widget-contact-info.php';
require HBTHEMES_INCLUDES . '/widgets/widget-social-icons.php';
require HBTHEMES_INCLUDES . '/widgets/widget-gmap.php';
require HBTHEMES_INCLUDES . '/widgets/widget-twitter.php';
require HBTHEMES_INCLUDES . '/widgets/widget-portfolio.php';
require HBTHEMES_INCLUDES . '/widgets/widget-portfolio-random.php';
require HBTHEMES_INCLUDES . '/widgets/widget-most-liked-portfolio.php';
require HBTHEMES_INCLUDES . '/widgets/widget-ads-300x250.php';


/*
 UNREGISTER THEME WIDGETS
================================================== */
function hb_unregister_widgets() {
	$widgets_to_unreg = array();

	if ( ! highend_is_module_enabled( 'hb_module_portfolio' ) ) {
		$widgets_to_unreg[] = 'HB_Liked_Portfolio_Widget';
		$widgets_to_unreg[] = 'HB_Portfolio_Widget_Rand';
		$widgets_to_unreg[] = 'HB_Portfolio_Widget';
	}

	if ( ! highend_is_module_enabled( 'hb_module_testimonials' ) ) {
		$widgets_to_unreg[] = 'HB_Testimonials_Widget';
	}

	foreach ( $widgets_to_unreg as $widget ) {
		unregister_widget( $widget );
	}
}
add_action( 'widgets_init', 'hb_unregister_widgets' );

/*
 MAINTENANCE MODE
================================================== */
function highend_maintenace_mode() {
	$hidden_param = '';

	if ( ! highend_is_module_enabled( 'hb_module_coming_soon_mode' ) ) {
		return;
	}

	if ( isset( $_GET['hb_maintenance'] ) ) {
		$hidden_param = $_GET['hb_maintenance'];
	}

	if ( highend_is_maintenance() || ( $hidden_param == 'yes' ) ) {
		get_template_part( 'page-templates/maintenance' );
		exit;
	}
}
add_action( 'get_header', 'highend_maintenace_mode' );

/*
 AJAX LIBRARY
================================================== */
function hb_add_ajax_library() {
	$html  = '<script type="text/javascript">';
	$html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
	$html .= '</script>';
	echo $html;
}
add_action( 'wp_head', 'hb_add_ajax_library' );

/*
 FILTER THE DEFAULT COMMENT FIELDS
================================================== */
add_filter( 'comment_form_fields', 'hx_custom_fields' );
function hx_custom_fields( $fields ) {

	$commenter     = wp_get_current_commenter();
	$req           = get_option( 'require_name_email' );
	$aria_req      = ( $req ? " aria-required='true' required='required'" : '' );
	$comment_field = $fields['comment'];
	$cookies       = '';

	if ( get_option( 'show_comments_cookies_opt_in' ) ) {

		if ( isset( $fields['cookies'] ) ) {
			$cookies = $fields['cookies'];
		} else {
			$cookies = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"><label for="wp-comment-cookies-consent">' . __( 'Save my name and email in this browser for the next time I comment.', 'hbthemes' ) . '</label></p>';
		}
	}

	unset( $fields['comment'] );
	unset( $fields['cookies'] );

	if ( isset( $fields['author'] ) ) {
		$fields['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="' . __( 'Your real name *', 'hbthemes' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="107"' . $aria_req . ' /></p>';
	}

	if ( isset( $fields['email'] ) ) {
		$fields['email'] = '<p class="comment-form-email"><input id="email" name="email" type="email" placeholder="' . __( 'Your email address *', 'hbthemes' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="40"  tabindex="108"' . $aria_req . ' /></p>';
	}

	if ( isset( $fields['url'] ) ) {
		$fields['url'] = '<p class="comment-form-url"><input id="url" placeholder="' . __( 'Your website URL', 'hbthemes' ) . '" name="url" type="text" value="" tabindex="109" size="30" maxlength="200"></p>';
	}

	$fields['comment'] = $comment_field;

	if ( ! empty( $cookies ) ) {
		$fields['cookies'] = $cookies;
	}

	return $fields;
}

/*
 AJAX SEARCH
================================================== */
add_action( 'init', 'hb_ajax_search_init' );
function hb_ajax_search_init() {
	add_action( 'wp_ajax_hb_ajax_search', 'hb_ajax_search' );
	add_action( 'wp_ajax_nopriv_hb_ajax_search', 'hb_ajax_search' );
}
function hb_ajax_search() {
	$search_term  = $_REQUEST['term'];
	$search_term  = apply_filters( 'get_search_query', $search_term );
	$search_array = array(
		's'                => $search_term,
		'showposts'        => 5,
		'post_type'        => 'any',
		'post_status'      => 'publish',
		'post_password'    => '',
		'suppress_filters' => true,
	);
	$query        = http_build_query( $search_array );
	$posts        = get_posts( $query );
	$suggestions  = array();
	global $post;
	foreach ( $posts as $post ) :
		setup_postdata( $post );
		$suggestion  = array();
		$format      = get_post_format( get_the_ID() );
		$icon_to_use = 'hb-moon-file-3';
		if ( $format == 'video' ) {
			$icon_to_use = 'hb-moon-play-2';
		} elseif ( $format == 'status' || $format == 'standard' ) {
			$icon_to_use = 'hb-moon-pencil';
		} elseif ( $format == 'gallery' || $format == 'image' ) {
			$icon_to_use = 'hb-moon-image-3';
		} elseif ( $format == 'audio' ) {
			$icon_to_use = 'hb-moon-music-2';
		} elseif ( $format == 'quote' ) {
			$icon_to_use = 'hb-moon-quotes-right';
		} elseif ( $format == 'link' ) {
			$icon_to_use = 'hb-moon-link-5';
		}
		$suggestion['label'] = esc_html( $post->post_title );
		$suggestion['link']  = get_permalink();
		$suggestion['date']  = get_the_time( 'F j Y' );
		$suggestion['image'] = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail(
			$post->ID,
			'thumbnail',
			array(
				'title' => '',
			)
		) : '<i class="' . $icon_to_use . '"></i>';
		$suggestions[]       = $suggestion;
	endforeach;
	// JSON encode and echo
	$response = $_GET['callback'] . '(' . json_encode( $suggestions ) . ')';
	echo $response;
	exit;
}

/*
 AJAX MAIL
================================================== */
add_action( 'wp_ajax_mail_action', 'sending_mail' );
add_action( 'wp_ajax_nopriv_mail_action', 'sending_mail' );
function sending_mail() {
	$site     = get_site_url();
	$subject  = __( 'New Message!', 'hbthemes' );
	$email    = $_POST['contact_email'];
	$email_s  = filter_var( $email, FILTER_SANITIZE_EMAIL );
	$comments = stripslashes( $_POST['contact_comments'] );
	$name     = stripslashes( $_POST['contact_name'] );
	$to       = hb_options( 'hb_contact_settings_email' );
	$message  = "Name: $name \n\nEmail: $email \n\nMessage: $comments \n\nThis email was sent from $site";
	$headers  = 'From: ' . $name . ' <' . $email_s . '>' . "\r\n" . 'Reply-To: ' . $email_s;
	wp_mail( $to, $subject, $message, $headers );
	exit();
}


/*
 QUICK SHORTCODES
================================================== */
add_shortcode( 'wp-link', 'wp_link_shortcode' );
function wp_link_shortcode() {
	return '<a href="http://wordpress.org" target="_blank">WordPress</a>';
}

add_shortcode( 'the-year', 'the_year_shortcode' );
function the_year_shortcode() {
	return date( 'Y' );
}


/*
 REMOVE SHORTCODES
================================================== */
function hb_remove_shortcodes() {

	// PRICING TABLES
	if ( ! highend_is_module_enabled( 'hb_module_pricing_tables' ) ) {
		remove_shortcode( 'menu_pricing_item' );
		remove_shortcode( 'pricing_table' );

		if ( function_exists( 'vc_remove_element' ) ) {
			vc_remove_element( 'menu_pricing_item' );
			vc_remove_element( 'pricing_table' );
		}
	}

	// FAQ
	if ( ! highend_is_module_enabled( 'hb_module_faq' ) ) {
		remove_shortcode( 'faq' );

		if ( function_exists( 'vc_remove_element' ) ) {
			vc_remove_element( 'faq' );
		}
	}

	// TESTIMONIALS
	if ( ! highend_is_module_enabled( 'hb_module_testimonials' ) ) {
		remove_shortcode( 'testimonial_box' );
		remove_shortcode( 'testimonial_slider' );

		if ( function_exists( 'vc_remove_element' ) ) {
			vc_remove_element( 'testimonial_box' );
			vc_remove_element( 'testimonial_slider' );
		}
	}

	// TEAM MEMBERS
	if ( ! highend_is_module_enabled( 'hb_module_team_members' ) ) {
		remove_shortcode( 'team_carousel' );
		remove_shortcode( 'team_member_box' );

		if ( function_exists( 'vc_remove_element' ) ) {
			vc_remove_element( 'team_carousel' );
			vc_remove_element( 'team_member_box' );
		}
	}

	// CLIENTS
	if ( ! highend_is_module_enabled( 'hb_module_clients' ) ) {
		remove_shortcode( 'client_carousel' );

		if ( function_exists( 'vc_remove_element' ) ) {
			vc_remove_element( 'client_carousel' );
		}
	}
}
add_action( 'init', 'hb_remove_shortcodes' );

function hb_buildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {

	$has_image = false;
	$style     = '';
	if ( (int) $bg_image > 0 && false !== ( $image_url = wp_get_attachment_url( $bg_image, 'large' ) ) ) {
		$has_image = true;
		$style    .= 'background-image: url(' . $image_url . ');';
	}
	if ( ! empty( $bg_color ) ) {
		$style .= hb_get_css_color( 'background-color', $bg_color );
	}
	if ( ! empty( $bg_image_repeat ) && $has_image ) {
		if ( 'cover' === $bg_image_repeat ) {
			$style .= 'background-repeat:no-repeat;background-size: cover;';
		} elseif ( 'contain' === $bg_image_repeat ) {
			$style .= 'background-repeat:no-repeat;background-size: contain;';
		} elseif ( 'no-repeat' === $bg_image_repeat ) {
			$style .= 'background-repeat: no-repeat;';
		}
	}
	if ( ! empty( $font_color ) ) {
		$style .= hb_get_css_color( 'color', $font_color );
	}
	if ( '' !== $padding ) {
		$style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
	}
	if ( '' !== $margin_bottom ) {
		$style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
	}

	return empty( $style ) ? '' : ' style="' . esc_attr( $style ) . '"';
}

function hb_get_css_color( $prefix, $color ) {
	$rgb_color = preg_match( '/rgba/', $color ) ? preg_replace(
		array(
			'/\s+/',
			'/^rgba\((\d+)\,(\d+)\,(\d+)\,([\d\.]+)\)$/',
		),
		array( '', 'rgb($1,$2,$3)' ),
		$color
	) : $color;
	$string    = $prefix . ':' . $rgb_color . ';';
	if ( $rgb_color !== $color ) {
		$string .= $prefix . ':' . $color . ';';
	}

	return $string;
}

/*
 THEME SUPPORT
================================================== */
// add_filter('widget_text', 'do_shortcode');
// add_filter('widget_text', 'shortcode_unautop');

// /* SHORTCODES IN TEXT WIDGET
// ================================================== */
// function theme_widget_text_shortcode($content) {
// $content          = do_shortcode($content);
// $new_content      = '';
// $pattern_full     = '{(\[raw\].*?\[/raw\])}is';
// $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
// $pieces           = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
// foreach ($pieces as $piece) {
// if (preg_match($pattern_contents, $piece, $matches)) {
// $new_content .= $matches[1];
// } else {
// $new_content .= do_shortcode($piece);
// }
// }
// return $new_content;
// }
// add_filter('widget_text', 'theme_widget_text_shortcode');
// add_filter('widget_text', 'do_shortcode');

/*
 SHORTCODE PARAGRAPH FIX
================================================== */
function shortcode_empty_paragraph_fix( $content ) {
	$array   = array(
		'<p>['    => '[',
		']</p>'   => ']',
		'<br/>['  => '[',
		']<br/>'  => ']',
		']<br />' => ']',
		'<br />[' => '[',
	);
	$content = strtr( $content, $array );
	return $content;
}
add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );


require HBTHEMES_INCLUDES . '/portfolio/class-highend-portfolio.php';
require HBTHEMES_INCLUDES . '/gallery/class-highend-gallery.php';
