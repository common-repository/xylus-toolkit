<?php

/**
 * Class for add and save meta box options in Team
 *
 * @link       http://xylusthemes.com
 * @since      1.0.0
 *
 * @package    Xylus_Toolkit
 * @subpackage Xylus_Toolkit/admin
 */

class Xylus_Toolkit_Team_Metabox {

	/*
	 * Init metabox functions
	 */
	public function init(){
		add_action( 'add_meta_boxes', array($this,'xylus_toolkit_add_team_custom_box' ));
		add_action('save_post', array($this,'xylus_toolkit_save_team_meta_box'),10,2);
	}


	/*
     *  Add Meta box for team link meta box.
     */
	public function xylus_toolkit_add_team_custom_box() {
		add_meta_box(
				'xylus_team_metabox',
				__( 'Team Member Details', 'xylus-toolkit' ),
				array($this,'xylus_toolkit_render_team_custom_box'),
				array('xylus-team'),
				'normal',
				'high'
		);
	}

	/*
     * Testimonial meta box render
     */
	function xylus_toolkit_render_team_custom_box( $post ) {

		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'xylus_toolkit_team_nonce' );
		?>
		<!-- link -->
		<p><label for="team_position"><strong>Team Member's Position</strong></label></p>
		<input type="text" name="team_position" id="team_position" class="widefat" placeholder="Enter Team Member's Position" value="<?php echo get_post_meta($post->ID, 'team_position', true); ?>" />
		<?php
	}


	/*
     * Save Testimonial meta box Options
     */
	function xylus_toolkit_save_team_meta_box($post_id, $post)
	{

		// Verify the nonce before proceeding.
		if ( !isset( $_POST['xylus_toolkit_team_nonce'] ) || !wp_verify_nonce( $_POST['xylus_toolkit_team_nonce'], plugin_basename( __FILE__ ) ) ){
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

		// check if team then save it.
		if($post->post_type != 'xylus-team'){
			return $post_id;
		}

		// Save link
		if(isset($_POST['team_position'])) {
			update_post_meta($post_id, 'team_position', sanitize_text_field($_POST['team_position']));
		}
	}
}
