<?php
/**
 * Add profile fields for social network links.
 * 
 * @package Highend
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'show_user_profile', 'highend_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'highend_show_extra_profile_fields' );

if ( ! function_exists( 'highend_show_extra_profile_fields' ) ) :
	/**
	 * Display social network links fields in profile editor.
	 * 
	 * @since 3.5.0
	 */
	function highend_show_extra_profile_fields( $user ) {

		$networks = highend_get_social_networks_array();
		?>
		<h3><?php esc_html_e( 'Social Networking', 'hbthemes' ) ?></h3>
		<table class="form-table">
			<?php foreach ( $networks as $network_id => $network_name ) { ?>
				<tr>
					<th><label for="<?php echo esc_attr( $network_id ); ?>"><?php echo esc_html( $network_name ); ?></label></th>
					<td>
						<input type="text" name="<?php echo esc_attr( $network_id ); ?>" id="<?php echo esc_attr( $network_id ); ?>" value="<?php echo esc_attr( get_the_author_meta( $network_id , $user->ID ) ); ?>" class="regular-text" /><br/>
					</td>
				</tr>	
			<?php }	?>
		</table>
		<?php
	}
endif;

add_action( 'personal_options_update', 'highend_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'highend_save_extra_profile_fields' );

if ( ! function_exists( 'highend_save_extra_profile_fields' ) ) :
	/**
	 * Save user's social network links.
	 * 
	 * @since 3.5.0
	 */
	function highend_save_extra_profile_fields( $user_id ) {

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}
		
		$networks = highend_get_social_networks_array();
			
		foreach ( $networks as $network_id => $network_name ) {
			update_user_meta( $user_id, $network_id, sanitize_text_field( $_POST[ $network_id ] ) );
		}
	}
endif;
