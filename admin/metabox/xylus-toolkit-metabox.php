<?php
/**
 * Add metaboxes to admin as per active post type support
 *
 * @link       http://xylusthemes.com
 * @since      1.0.0
 *
 * @package    Xylus_Toolkit
 * @subpackage Xylus_Toolkit/admin
 */

function xylus_toolkit_metabox_init() {

	if ( current_theme_supports( 'xylus_themes_testimonial_support' ) ) {
		require_once XYLUS_TOOLKIT_ADMIN.'metabox/class-xylus-toolkit-testimonial-metabox.php';
		$testimonial = new Xylus_Toolkit_Testimonial_Metabox();
		$testimonial->init();
	}

	if ( current_theme_supports( 'xylus_themes_client_support' ) ) {
		require_once XYLUS_TOOLKIT_ADMIN.'metabox/class-xylus-toolkit-client-metabox.php';
		$client = new Xylus_Toolkit_Client_Metabox();
		$client->init();
	}

	if ( current_theme_supports( 'xylus_themes_team_support' ) ) {
		require_once XYLUS_TOOLKIT_ADMIN.'metabox/class-xylus-toolkit-team-metabox.php';
		$team = new Xylus_Toolkit_Team_Metabox();
		$team->init();
	}

	if ( current_theme_supports( 'xylus_themes_slider_support' ) ) {
		require_once XYLUS_TOOLKIT_ADMIN.'metabox/class-xylus-toolkit-slider-metabox.php';
		$slider = new Xylus_Toolkit_Slider_Metabox();
		$slider->init();
	}

}
add_action( 'init', 'xylus_toolkit_metabox_init', 0 );