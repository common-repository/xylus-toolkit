<?php

/**
 * Class for add and save meta box options in Clients
 *
 * @link       http://xylusthemes.com
 * @since      1.0.0
 *
 * @package    Xylus_Toolkit
 * @subpackage Xylus_Toolkit/admin
 */

class Xylus_Toolkit_Client_Metabox {

	/*
	 * Init metabox functions
	 */
	public function init(){
		add_action( 'add_meta_boxes', array($this,'xylus_toolkit_add_client_custom_box' ));
		add_action('save_post', array($this,'xylus_toolkit_save_client_meta_box'),10,2);
	}


	/*
     *  Add Meta box for client link meta box.
     */
	public function xylus_toolkit_add_client_custom_box() {
		add_meta_box(
				'xylus_client_metabox',
				__( 'Client Details', 'xylus-toolkit' ),
				array($this,'xylus_toolkit_render_client_custom_box'),
				array('xylus-client'),
				'normal',
				'high'
		);
	}

	/*
     * Testimonial meta box render
     */
	function xylus_toolkit_render_client_custom_box( $post ) {

		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'xylus_toolkit_client_nonce' );
		?>
		<!-- link -->
		<p><label for="author_name"><strong>Client Website Link</strong></label></p>
		<input type="url" name="client_link" id="client_link" class="widefat" placeholder="Enter Client Website Link" value="<?php echo get_post_meta($post->ID, 'client_link', true); ?>" />
		<?php
	}


	/*
     * Save Testimonial meta box Options
     */
	function xylus_toolkit_save_client_meta_box($post_id, $post)
	{

		// Verify the nonce before proceeding.
		if ( !isset( $_POST['xylus_toolkit_client_nonce'] ) || !wp_verify_nonce( $_POST['xylus_toolkit_client_nonce'], plugin_basename( __FILE__ ) ) ){
			return $post_id;
		}

		// check user capability to edit post
		if(!current_user_can("edit_post", $post_id)){
			return $post_id;
		}

		// can't save if auto save
		if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE){
			return $post_id;
		}

		// check if client then save it.
		if($post->post_type != 'xylus-client'){
			return $post_id;
		}

		// Save link
		if(isset($_POST['client_link'])) {
			update_post_meta($post_id, 'client_link', esc_url($_POST['client_link']));
		}
	}
}
