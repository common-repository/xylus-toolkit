<?php

/**
 * Class for add and save meta box options in Slider Items
 *
 * @link       http://xylusthemes.com
 * @since      1.0.0
 *
 * @package    Xylus_Toolkit
 * @subpackage Xylus_Toolkit/admin
 */

class Xylus_Toolkit_Slider_Metabox {

	/*
	 * Init metabox functions
	 */
	public function init(){
		add_action( 'add_meta_boxes', array($this,'xylus_toolkit_add_slider_custom_box' ));
		add_action('save_post', array($this,'xylus_toolkit_save_slider_meta_box'),10,2);
	}


	/*
     *  Add Meta box for slider author meta box.
     */
	public function xylus_toolkit_add_slider_custom_box() {
		add_meta_box(
				'xylus_slider_metabox',
				__( 'Slider Details', 'xylus-toolkit' ),
				array($this,'xylus_toolkit_render_slider_custom_box'),
				array('xylus-slider'),
				'normal',
				'high'
		);
	}

	/*
     * Testimonial meta box render
     */
	function xylus_toolkit_render_slider_custom_box( $post ) {

		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'xylus_toolkit_slider_nonce' );
		?>
		<!-- Text -->
		<p><label for="slider_button_text"><strong>Button Text</strong></label></p>
		<input type="text" name="slider_button_text" id="slider_button_text" class="widefat" placeholder="Enter Slider Button Text" value="<?php echo get_post_meta($post->ID, 'slider_button_text', true); ?>" />

		<!-- Link -->
		<p><label for="slider_button_link"><strong>Position</strong></label></p>
		<input type="url" name="slider_button_link" id="slider_button_link" class="widefat"  placeholder="Enter Slider Button Link" value="<?php echo get_post_meta($post->ID, 'slider_button_link', true); ?>" />
	<?php
	}


	/*
     * Save Testimonial meta box Options
     */
	function xylus_toolkit_save_slider_meta_box($post_id, $post)
	{

		// Verify the nonce before proceeding.
		if ( !isset( $_POST['xylus_toolkit_slider_nonce'] ) || !wp_verify_nonce( $_POST['xylus_toolkit_slider_nonce'], plugin_basename( __FILE__ ) ) ){
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

		// check if slider then save it.
		if($post->post_type != 'xylus-slider'){
			return $post_id;
		}

		// Save Text
		if(isset($_POST['slider_button_text'])) {
			update_post_meta($post_id, 'slider_button_text', sanitize_text_field($_POST['slider_button_text']));
		}

		//Save Link
		if(isset($_POST['slider_button_link'])) {
			update_post_meta($post_id, 'slider_button_link', sanitize_text_field($_POST['slider_button_link']));
		}
	}
}