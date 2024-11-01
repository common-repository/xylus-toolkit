<?php

/**
 * Class for add and save meta box options in testimonials
 *
 * @link       http://xylusthemes.com
 * @since      1.0.0
 *
 * @package    Xylus_Toolkit
 * @subpackage Xylus_Toolkit/admin
 */

class Xylus_Toolkit_Testimonial_Metabox {

	/*
	 * Init metabox functions
	 */
	public function init(){
		add_action( 'add_meta_boxes', array($this,'xylus_toolkit_add_testimonial_custom_box' ));
		add_action('save_post', array($this,'xylus_toolkit_save_testimonial_meta_box'),10,2);
	}


	/*
     *  Add Meta box for testimonial author meta box.
     */
	public function xylus_toolkit_add_testimonial_custom_box() {
		add_meta_box(
				'xylus_testimonial_metabox',
				__( 'Testimonial Author', 'xylus-toolkit' ),
				array($this,'xylus_toolkit_render_testimonial_custom_box'),
				array('xylus-testimonial'),
				'normal',
				'high'
		);
	}

	/*
     * Testimonial meta box render
     */
	function xylus_toolkit_render_testimonial_custom_box( $post ) {

		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'xylus_toolkit_testimonial_nonce' );
		?>
		<!-- Name -->
		<p><label for="author_name"><strong>Name</strong></label></p>
		<input type="text" name="author_name" id="author_name" class="widefat" placeholder="Enter Author name" value="<?php echo get_post_meta($post->ID, 'author_name', true); ?>" />

		<!-- Position -->
		<p><label for="author_position"><strong>Position</strong></label></p>
		<input type="text" name="author_position" id="author_position" class="widefat"  placeholder="Enter Author's position" value="<?php echo get_post_meta($post->ID, 'author_position', true); ?>" />

		<!-- Company Name -->
		<p><label for="author_company"><strong>Company Name</strong></label></p>
		<input type="text" name="author_company" id="author_company" class="widefat"  placeholder="Enter Author's Company name"  value="<?php echo get_post_meta($post->ID, 'author_company', true); ?>" />
		<?php
	}


	/*
     * Save Testimonial meta box Options
     */
	function xylus_toolkit_save_testimonial_meta_box($post_id, $post)
	{

		// Verify the nonce before proceeding.
		if ( !isset( $_POST['xylus_toolkit_testimonial_nonce'] ) || !wp_verify_nonce( $_POST['xylus_toolkit_testimonial_nonce'], plugin_basename( __FILE__ ) ) ){
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

		// check if testimonial then save it.
		if($post->post_type != 'xylus-testimonial'){
			return $post_id;
		}

		// Save Name
		if(isset($_POST['author_name'])) {
			update_post_meta($post_id, 'author_name', sanitize_text_field($_POST['author_name']));
		}

		//Save position
		if(isset($_POST['author_position'])) {
			update_post_meta($post_id, 'author_position', sanitize_text_field($_POST['author_position']));
		}

		//  Save Company
		if(isset($_POST['author_company'])) {
			update_post_meta($post_id, 'author_company', sanitize_text_field($_POST['author_company']));
		}
	}
}
