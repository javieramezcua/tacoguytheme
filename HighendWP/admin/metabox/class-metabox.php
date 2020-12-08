<?php
/**
 * Metabox Class.
 *
 * @package Highend
 * @since   3.5.0
*/

if ( ! class_exists( 'Highend_Metaboxes' ) ) :

	/**
	 * Highend Metabox Class.
	 *
	 * @since 3.5.0
	 */
	class Highend_Metaboxes {

		/**
		 * Primary class constructor.
		 *
		 * @since 3.5.1
		 */
		public function __construct() {

			// Enqueue scripts.
			add_action( 'admin_print_scripts-post-new.php', array( $this, 'load_assets' ) );
			add_action( 'admin_print_scripts-post.php', array( $this, 'load_assets' ) );
		}

		/**
		 * Load required assets on the admin page(s).
		 *
		 * @since 3.5.1
		 */
		public function load_assets( $hook ) {

			if ( function_exists( 'vc_is_frontend_editor' ) && vc_is_frontend_editor() ) {
				return;
			}

			wp_enqueue_script( 
				'highend-metabox-js',
				HBTHEMES_ADMIN_URI . '/assets/js/metabox.js',
				array( 'jquery' ),
				HB_THEME_VERSION,
				true
			);
		}
	}
endif;

new Highend_Metaboxes;
