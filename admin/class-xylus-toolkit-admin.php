<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Xylus_Toolkit
 * @subpackage Xylus_Toolkit/admin
 * @author     xylus <dspatel44@gmail.com>
 */
class Xylus_Toolkit_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Xylus_Toolkit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Xylus_Toolkit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/xylus-toolkit-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Xylus_Toolkit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Xylus_Toolkit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/xylus-toolkit-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Dashboard Widget Setup
	 *
	 * @since    1.0.1
	 */
	public function xylus_toolkit_dashboard_widget_setup(){
		add_meta_box( 'xylus_toolkit_dashboard_product_widget', __('Plugins Suggestion from Xylus Themes','xylus-toolkit'), array( $this, 'xylus_toolkit_dashboard_widget_product_render' ), 'dashboard', 'normal', 'high' );
		add_meta_box( 'xylus_toolkit_dashboard_news_widget', __('WordPress Tips from Xylus Themes','xylus-toolkit'), array( $this, 'xylus_toolkit_dashboard_widget_news_render' ), 'dashboard', 'normal', 'high' );
	}

	/**
	 * Dashboard Widget Render
	 *
	 * @since    1.0.1
	 */
	public function xylus_toolkit_dashboard_widget_news_render(){
		?>
		<div class="xt_toolkit_news">
			<div class="xt_toolkit_news_rss-widget">
		    	<?php
					wp_widget_rss_output( 'http://feeds.feedburner.com/XylusThemes', array( 'items' => 10, 'show_author' => 0, 'show_summary'  => 0 ) );
				?>
			</div>
		</div>
		<div style="clear:both"></div>
		<?php
	}

	/**
	 * Dashboard Widget Render
	 *
	 * @since    1.0.1
	 */
	public function xylus_toolkit_dashboard_widget_product_render(){
		?>
		<div class="product_section">
			<div class="products">
				<?php
				$xylus_products = '';
				$xylus_products_cache = 'xt_toolkit_dash_latest_products';
				$xylus_products = get_transient( $xylus_products_cache );

				if ( false !== $xylus_products ) {
					echo $xylus_products;	
				}else{	
					$remote_content = wp_remote_post( 'http://xylusthemes.com/latest-products-html/');
					if(! is_wp_error( $remote_content ) ) {			
						$xylus_products = wp_remote_retrieve_body( $remote_content );
					}
					if ( $xylus_products != '' ){
						echo $xylus_products; 
					}
					// save cache for 12 hours
					set_transient( $xylus_products_cache, $xylus_products, 12 * HOUR_IN_SECONDS );
				}
				?>
			</div>
		</div>
		<div style="clear:both"></div>
		<?php
	}

}