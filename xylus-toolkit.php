<?php
/**
 * Plugin Name:       Xylus Toolkit
 * Plugin URI:        http://xylusthemes.com/plugins/xylus-toolkit
 * Description:       The Xylus Toolkit extends functionality to Xylus Themes, providing custom post types and more.
 * Version:           1.1.0
 * Author:            Xylus Themes
 * Author URI:        http://xylusthemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       xylus-toolkit
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Includes directory
define( 'XYLUS_TOOLKIT_INCLUDES', plugin_dir_path( __FILE__ ) . 'includes/' );

// Admin  directory
define( 'XYLUS_TOOLKIT_ADMIN', plugin_dir_path( __FILE__ ) . 'admin/' );

/**
 * The code that runs during plugin activation.
 */
function activate_xylus_toolkit() {
	require_once XYLUS_TOOLKIT_INCLUDES. 'class-xylus-toolkit-activator.php';
	Xylus_Toolkit_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_xylus_toolkit() {
	require_once XYLUS_TOOLKIT_INCLUDES. 'class-xylus-toolkit-deactivator.php';
	Xylus_Toolkit_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_xylus_toolkit' );
register_deactivation_hook( __FILE__, 'deactivate_xylus_toolkit' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require XYLUS_TOOLKIT_INCLUDES. 'class-xylus-toolkit.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_xylus_toolkit() {

	$plugin = new Xylus_Toolkit();
	$plugin->run();

}
run_xylus_toolkit();
