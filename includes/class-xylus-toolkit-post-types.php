<?php

/**
 * Custom Post types and Custom taxonomies
 *
 * @link       http://xylusthemes.com
 * @since      1.0.0
 *
 * @package    Xylus_Toolkit
 * @subpackage Xylus_Toolkit/includes
 */
class Xylus_Toolkit_Post_Types{

	public $portfolio_slug;

	public $portfolio_tag_slug;

	public $portfolio_category_slug;

	public $testinomial_slug;

	public $testinomial_category_slug;

	public $client_slug;

	public $client_category_slug;

	public $team_slug;

	public $team_category_slug;

	public $service_slug;

	public $slider_slug;

	public function __construct(){
		$this->portfolio_slug = defined('XYLUS_PORTFOLIO_SLUG')?XYLUS_PORTFOLIO_SLUG:'portfolio-item';

		$this->portfolio_tag_slug = defined('XYLUS_PORTFOLIO_TAG_SLUG')?XYLUS_PORTFOLIO_TAG_SLUG:'portfolio/tag';

		$this->portfolio_category_slug = defined('XYLUS_PORTFOLIO_CATEGORY_SLUG')?XYLUS_PORTFOLIO_CATEGORY_SLUG:'portfolio_category';

		$this->testinomial_slug = defined('XYLUS_TESTIMONIAL_SLUG')?XYLUS_TESTIMONIAL_SLUG:'testimonials';

		$this->testinomial_category_slug = defined('XYLUS_TESTIMONIAL_CATEGORY_SLUG')?XYLUS_TESTIMONIAL_CATEGORY_SLUG:'testimonial_category';

		$this->client_slug = defined('XYLUS_CLIENT_SLUG')?XYLUS_CLIENT_SLUG:'clients';

		$this->client_category_slug = defined('XYLUS_CLIENT_CATEGORY_SLUG')?XYLUS_CLIENT_CATEGORY_SLUG:'client_category';

		$this->team_slug = defined('XYLUS_TEAM_SLUG')?XYLUS_TEAM_SLUG:'team-member';

		$this->team_category_slug = defined('XYLUS_TEAM_CATEGORY_SLUG')?XYLUS_TEAM_CATEGORY_SLUG:'team_category';

		$this->service_slug = defined('XYLUS_SERVICE_SLUG')?XYLUS_SERVICE_SLUG:'services';

		$this->slider_slug = defined('XYLUS_SLIDER_SLUG')?XYLUS_SLIDER_SLUG:'xylus-slider';
	}

	/**
	 * Register Portfolio Post type
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_portfolio_post_type(){

		/*
		 * Portfolio labels
		 */
		$xylus_portfolio_labels = array(
				'name'                  => _x( 'Portfolio Items', 'Post Type General Name', 'xylus-toolkit' ),
				'singular_name'         => _x( 'Portfolio Items', 'Post Type Singular Name', 'xylus-toolkit' ),
				'menu_name'             => __( 'Portfolio Items', 'xylus-toolkit' ),
				'name_admin_bar'        => __( 'Portfolio Items', 'xylus-toolkit' ),
				'archives'              => __( 'Portfolio Archives', 'xylus-toolkit' ),
				'parent_item_colon'     => __( 'Parent Portfolio:', 'xylus-toolkit' ),
				'all_items'             => __( 'All Portfolio Items', 'xylus-toolkit' ),
				'add_new_item'          => __( 'Add New Portfolio', 'xylus-toolkit' ),
				'add_new'               => __( 'Add New', 'xylus-toolkit' ),
				'new_item'              => __( 'New Portfolio', 'xylus-toolkit' ),
				'edit_item'             => __( 'Edit Portfolio', 'xylus-toolkit' ),
				'update_item'           => __( 'Update Portfolio', 'xylus-toolkit' ),
				'view_item'             => __( 'View Portfolio', 'xylus-toolkit' ),
				'search_items'          => __( 'Search Portfolio', 'xylus-toolkit' ),
				'not_found'             => __( 'Not found', 'xylus-toolkit' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'xylus-toolkit' ),
				'featured_image'        => __( 'Featured Image', 'xylus-toolkit' ),
				'set_featured_image'    => __( 'Set featured image', 'xylus-toolkit' ),
				'remove_featured_image' => __( 'Remove featured image', 'xylus-toolkit' ),
				'use_featured_image'    => __( 'Use as featured image', 'xylus-toolkit' ),
				'insert_into_item'      => __( 'Insert into Portfolio', 'xylus-toolkit' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'xylus-toolkit' ),
				'items_list'            => __( 'Portfolio Items list', 'xylus-toolkit' ),
				'items_list_navigation' => __( 'Portfolio Items list navigation', 'xylus-toolkit' ),
				'filter_items_list'     => __( 'Filter Portfolio items list', 'xylus-toolkit' ),
		);
		$rewrite = array(
				'slug'                  => $this->portfolio_slug,
				'with_front'            => true,
				'pages'                 => true,
				'feeds'                 => true,
		);
		$xylus_portfolio_args = array(
				'label'                 => __( 'Portfolio Items', 'xylus-toolkit' ),
				'description'           => __( 'Post type for Portfolio Items', 'xylus-toolkit' ),
				'labels'                => $xylus_portfolio_labels,
				'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
				'taxonomies'            => array( 'portfolio_category', 'portfolio_tag' ),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-images-alt2',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'rewrite'               => $rewrite,
		);
		register_post_type( 'xylus-portfolio', $xylus_portfolio_args );
	}


	/**
	 * Register Portfolio tag taxonomy
	 *
	 * @since    1.0.0
	 */
	 public function xylus_toolkit_register_portfolio_taxonomy(){

		 /* Register the Portfolio Category taxonomy. */
		 register_taxonomy( 'portfolio_category', array( 'xylus-portfolio' ), array(
				 'labels'                     => __( 'Categories','xylus-toolkit' ),
				 'hierarchical'               => true,
				 'query_var'    			  => true,
				 'rewrite'      			  => array(
													  'slug' => $this->portfolio_category_slug
				 ),
		 ) );

		 /* Register the Portfolio Tag taxonomy. */
		 register_taxonomy(
				 'portfolio_tag',
				 array( 'xylus-portfolio' ),
				 array(
						 'public'            => true,
						 'show_ui'           => true,
						 'show_in_nav_menus' => true,
						 'show_tagcloud'     => true,
						 'show_admin_column' => true,
						 'hierarchical'      => false,
						 'query_var'         => 'portfolio_tag',

					 /* The rewrite handles the URL structure. */
						 'rewrite' => array(
								 'slug'         => $this->portfolio_tag_slug,
								 'with_front'   => false,
								 'hierarchical' => false,
								 'ep_mask'      => EP_NONE
						 ),
					 /* Labels used when displaying taxonomy and terms. */
						 'labels' => array(
								 'name'                       => __( 'Project Tags',                   'xylus-toolkit' ),
								 'singular_name'              => __( 'Project Tag',                    'xylus-toolkit' ),
								 'menu_name'                  => __( 'Tags',                           'xylus-toolkit' ),
								 'name_admin_bar'             => __( 'Tag',                            'xylus-toolkit' ),
								 'search_items'               => __( 'Search Tags',                    'xylus-toolkit' ),
								 'popular_items'              => __( 'Popular Tags',                   'xylus-toolkit' ),
								 'all_items'                  => __( 'All Tags',                       'xylus-toolkit' ),
								 'edit_item'                  => __( 'Edit Tag',                       'xylus-toolkit' ),
								 'view_item'                  => __( 'View Tag',                       'xylus-toolkit' ),
								 'update_item'                => __( 'Update Tag',                     'xylus-toolkit' ),
								 'add_new_item'               => __( 'Add New Tag',                    'xylus-toolkit' ),
								 'new_item_name'              => __( 'New Tag Name',                   'xylus-toolkit' ),
								 'separate_items_with_commas' => __( 'Separate tags with commas',      'xylus-toolkit' ),
								 'add_or_remove_items'        => __( 'Add or remove tags',             'xylus-toolkit' ),
								 'choose_from_most_used'      => __( 'Choose from the most used tags', 'xylus-toolkit' ),
								 'not_found'                  => __( 'No tags found',                  'xylus-toolkit' ),
								 'parent_item'                => null,
								 'parent_item_colon'          => null,
						 )
				 )
		 );

	 }


	/**
	 * Register Testimonial Post type
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_testimonial_post_type(){

		/*
		 * Portfolio labels
		 */
		$xylus_testinomial_labels = array(
				'name'                  => _x( 'Testimonials', 'Post Type General Name', 'xylus-toolkit' ),
				'singular_name'         => _x( 'Testimonials', 'Post Type Singular Name', 'xylus-toolkit' ),
				'menu_name'             => __( 'Testimonials', 'xylus-toolkit' ),
				'name_admin_bar'        => __( 'Testimonials', 'xylus-toolkit' ),
				'archives'              => __( 'Testimonial Archives', 'xylus-toolkit' ),
				'parent_item_colon'     => __( 'Parent Testimonial:', 'xylus-toolkit' ),
				'all_items'             => __( 'All Testimonials', 'xylus-toolkit' ),
				'add_new_item'          => __( 'Add New Testimonial', 'xylus-toolkit' ),
				'add_new'               => __( 'Add New', 'xylus-toolkit' ),
				'new_item'              => __( 'New Testimonial', 'xylus-toolkit' ),
				'edit_item'             => __( 'Edit Testimonial', 'xylus-toolkit' ),
				'update_item'           => __( 'Update Testimonial', 'xylus-toolkit' ),
				'view_item'             => __( 'View Testimonial', 'xylus-toolkit' ),
				'search_items'          => __( 'Search Testimonial', 'xylus-toolkit' ),
				'not_found'             => __( 'Not found', 'xylus-toolkit' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'xylus-toolkit' ),
				'featured_image'        => __( 'Featured Image', 'xylus-toolkit' ),
				'set_featured_image'    => __( 'Set featured image', 'xylus-toolkit' ),
				'remove_featured_image' => __( 'Remove featured image', 'xylus-toolkit' ),
				'use_featured_image'    => __( 'Use as featured image', 'xylus-toolkit' ),
				'insert_into_item'      => __( 'Insert into Testimonial', 'xylus-toolkit' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'xylus-toolkit' ),
				'items_list'            => __( 'Testimonials list', 'xylus-toolkit' ),
				'items_list_navigation' => __( 'Testimonials list navigation', 'xylus-toolkit' ),
				'filter_items_list'     => __( 'Filter Testimonials list', 'xylus-toolkit' ),
		);
		$rewrite = array(
				'slug'                  => $this->testinomial_slug,
				'with_front'            => true,
				'pages'                 => true,
				'feeds'                 => true,
		);
		$xylus_testinomial_args = array(
				'label'                 => __( 'Testimonials', 'xylus-toolkit' ),
				'description'           => __( 'Post type for Testimonials', 'xylus-toolkit' ),
				'labels'                => $xylus_testinomial_labels,
				'supports'              => array( 'title', 'editor', 'thumbnail'),
				'taxonomies'            => array( 'testimonial_category'),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-testimonial',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'rewrite'               => $rewrite,
		);
		register_post_type( 'xylus-testimonial', $xylus_testinomial_args );
	}


	/**
	 * Register testimonial Taxonomy
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_testimonial_taxonomy(){
		$labels = array(
				'name'                       => __( 'Testimonial Categories', 'xylus-toolkit' ),
				'singular_name'              => __( 'Testimonial Category',   'xylus-toolkit' ),
				'menu_name'                  => __( 'Categories',             'xylus-toolkit' ),
				'name_admin_bar'             => __( 'Category',               'xylus-toolkit' ),
				'search_items'               => __( 'Search Categories',      'xylus-toolkit' ),
				'popular_items'              => __( 'Popular Categories',     'xylus-toolkit' ),
				'all_items'                  => __( 'All Categories',         'xylus-toolkit' ),
				'edit_item'                  => __( 'Edit Category',          'xylus-toolkit' ),
				'view_item'                  => __( 'View Category',          'xylus-toolkit' ),
				'update_item'                => __( 'Update Category',        'xylus-toolkit' ),
				'add_new_item'               => __( 'Add New Category',       'xylus-toolkit' ),
				'new_item_name'              => __( 'New Category Name',      'xylus-toolkit' ),
				'parent_item'                => __( 'Parent Category',        'xylus-toolkit' ),
				'parent_item_colon'          => __( 'Parent Category:',       'xylus-toolkit' ),
		);

		$rewrite = array(
				'slug'         => $this->testinomial_category_slug,
				'hierarchical' => true,
				'ep_mask'      => EP_NONE
		);
		/* Register the Portfolio Category taxonomy. */
		register_taxonomy( 'testimonial_category', array( 'xylus-testimonial' ), array(
				'labels'            => $labels,
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'query_var'         => 'testimonial_category',
				'rewrite'      		=> $rewrite
		) );

	}

	/**
	 * Register Client Post type
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_client_post_type(){

		/*
		 * Clients labels
		 */
		$xylus_client_labels = array(
				'name'                  => _x( 'Clients', 'Post Type General Name', 'xylus-toolkit' ),
				'singular_name'         => _x( 'Clients', 'Post Type Singular Name', 'xylus-toolkit' ),
				'menu_name'             => __( 'Clients', 'xylus-toolkit' ),
				'name_admin_bar'        => __( 'Clients', 'xylus-toolkit' ),
				'archives'              => __( 'Client Archives', 'xylus-toolkit' ),
				'parent_item_colon'     => __( 'Parent Client:', 'xylus-toolkit' ),
				'all_items'             => __( 'All Clients', 'xylus-toolkit' ),
				'add_new_item'          => __( 'Add New Client', 'xylus-toolkit' ),
				'add_new'               => __( 'Add New', 'xylus-toolkit' ),
				'new_item'              => __( 'New Client', 'xylus-toolkit' ),
				'edit_item'             => __( 'Edit Client', 'xylus-toolkit' ),
				'update_item'           => __( 'Update Client', 'xylus-toolkit' ),
				'view_item'             => __( 'View Client', 'xylus-toolkit' ),
				'search_items'          => __( 'Search Client', 'xylus-toolkit' ),
				'not_found'             => __( 'Not found', 'xylus-toolkit' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'xylus-toolkit' ),
				'featured_image'        => __( 'Featured Image', 'xylus-toolkit' ),
				'set_featured_image'    => __( 'Set featured image', 'xylus-toolkit' ),
				'remove_featured_image' => __( 'Remove featured image', 'xylus-toolkit' ),
				'use_featured_image'    => __( 'Use as featured image', 'xylus-toolkit' ),
				'insert_into_item'      => __( 'Insert into Client', 'xylus-toolkit' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Client', 'xylus-toolkit' ),
				'items_list'            => __( 'Clients list', 'xylus-toolkit' ),
				'items_list_navigation' => __( 'Clients list navigation', 'xylus-toolkit' ),
				'filter_items_list'     => __( 'Filter Clients list', 'xylus-toolkit' ),
		);
		$rewrite = array(
				'slug'                  => $this->client_slug,
				'with_front'            => true,
				'pages'                 => true,
				'feeds'                 => true,
		);
		$xylus_client_args = array(
				'label'                 => __( 'Clients', 'xylus-toolkit' ),
				'description'           => __( 'Post type for Clients', 'xylus-toolkit' ),
				'labels'                => $xylus_client_labels,
				'supports'              => array( 'title', 'thumbnail'),
				'taxonomies'            => array( 'client_category'),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-businessman',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'rewrite'               => $rewrite,
		);
		register_post_type( 'xylus-client', $xylus_client_args );
	}


	/**
	 * Register Client Taxonomy
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_client_taxonomy(){
		$labels = array(
				'name'                       => __( 'Client Categories', 'xylus-toolkit' ),
				'singular_name'              => __( 'Client Category',   'xylus-toolkit' ),
				'menu_name'                  => __( 'Categories',             'xylus-toolkit' ),
				'name_admin_bar'             => __( 'Category',               'xylus-toolkit' ),
				'search_items'               => __( 'Search Categories',      'xylus-toolkit' ),
				'popular_items'              => __( 'Popular Categories',     'xylus-toolkit' ),
				'all_items'                  => __( 'All Categories',         'xylus-toolkit' ),
				'edit_item'                  => __( 'Edit Category',          'xylus-toolkit' ),
				'view_item'                  => __( 'View Category',          'xylus-toolkit' ),
				'update_item'                => __( 'Update Category',        'xylus-toolkit' ),
				'add_new_item'               => __( 'Add New Category',       'xylus-toolkit' ),
				'new_item_name'              => __( 'New Category Name',      'xylus-toolkit' ),
				'parent_item'                => __( 'Parent Category',        'xylus-toolkit' ),
				'parent_item_colon'          => __( 'Parent Category:',       'xylus-toolkit' ),
		);

		$rewrite = array(
				'slug'         => $this->client_category_slug,
				'hierarchical' => true,
				'ep_mask'      => EP_NONE
		);
		/* Register the Portfolio Category taxonomy. */
		register_taxonomy( 'client_category', array( 'xylus-client' ), array(
				'labels'            => $labels,
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'query_var'         => 'client_category',
				'rewrite'      		=> $rewrite
		) );

	}

	/**
	 * Register Team Post type
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_team_post_type(){

		/*
		 * Team labels
		 */
		$xylus_team_labels = array(
				'name'                  => _x( 'Team Members', 'Post Type General Name', 'xylus-toolkit' ),
				'singular_name'         => _x( 'Team Members', 'Post Type Singular Name', 'xylus-toolkit' ),
				'menu_name'             => __( 'Team Members', 'xylus-toolkit' ),
				'name_admin_bar'        => __( 'Team Members', 'xylus-toolkit' ),
				'archives'              => __( 'Team Member Archives', 'xylus-toolkit' ),
				'parent_item_colon'     => __( 'Parent Team Member:', 'xylus-toolkit' ),
				'all_items'             => __( 'All Team Members', 'xylus-toolkit' ),
				'add_new_item'          => __( 'Add New Team Member', 'xylus-toolkit' ),
				'add_new'               => __( 'Add New', 'xylus-toolkit' ),
				'new_item'              => __( 'New Team Member', 'xylus-toolkit' ),
				'edit_item'             => __( 'Edit Team Member', 'xylus-toolkit' ),
				'update_item'           => __( 'Update Team Member', 'xylus-toolkit' ),
				'view_item'             => __( 'View Team Member', 'xylus-toolkit' ),
				'search_items'          => __( 'Search Team Member', 'xylus-toolkit' ),
				'not_found'             => __( 'Not found', 'xylus-toolkit' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'xylus-toolkit' ),
				'featured_image'        => __( 'Featured Image', 'xylus-toolkit' ),
				'set_featured_image'    => __( 'Set featured image', 'xylus-toolkit' ),
				'remove_featured_image' => __( 'Remove featured image', 'xylus-toolkit' ),
				'use_featured_image'    => __( 'Use as featured image', 'xylus-toolkit' ),
				'insert_into_item'      => __( 'Insert into Team Member', 'xylus-toolkit' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Team Member', 'xylus-toolkit' ),
				'items_list'            => __( 'Team Members list', 'xylus-toolkit' ),
				'items_list_navigation' => __( 'Team Members list navigation', 'xylus-toolkit' ),
				'filter_items_list'     => __( 'Filter Team Members list', 'xylus-toolkit' ),
		);
		$rewrite = array(
				'slug'                  => $this->team_slug,
				'with_front'            => true,
				'pages'                 => true,
				'feeds'                 => true,
		);
		$xylus_team_args = array(
				'label'                 => __( 'Team Members', 'xylus-toolkit' ),
				'description'           => __( 'Post type for Team Members', 'xylus-toolkit' ),
				'labels'                => $xylus_team_labels,
				'supports'              => array( 'title', 'editor', 'thumbnail'),
				'taxonomies'            => array( 'team_category'),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-groups',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'rewrite'               => $rewrite,
		);
		register_post_type( 'xylus-team', $xylus_team_args );
	}


	/**
	 * Register Team Taxonomy
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_team_taxonomy(){
		$labels = array(
				'name'                       => __( 'Team Member Categories', 'xylus-toolkit' ),
				'singular_name'              => __( 'Team Member Category',   'xylus-toolkit' ),
				'menu_name'                  => __( 'Categories',             'xylus-toolkit' ),
				'name_admin_bar'             => __( 'Category',               'xylus-toolkit' ),
				'search_items'               => __( 'Search Categories',      'xylus-toolkit' ),
				'popular_items'              => __( 'Popular Categories',     'xylus-toolkit' ),
				'all_items'                  => __( 'All Categories',         'xylus-toolkit' ),
				'edit_item'                  => __( 'Edit Category',          'xylus-toolkit' ),
				'view_item'                  => __( 'View Category',          'xylus-toolkit' ),
				'update_item'                => __( 'Update Category',        'xylus-toolkit' ),
				'add_new_item'               => __( 'Add New Category',       'xylus-toolkit' ),
				'new_item_name'              => __( 'New Category Name',      'xylus-toolkit' ),
				'parent_item'                => __( 'Parent Category',        'xylus-toolkit' ),
				'parent_item_colon'          => __( 'Parent Category:',       'xylus-toolkit' ),
		);

		$rewrite = array(
				'slug'         => $this->team_category_slug,
				'hierarchical' => true,
				'ep_mask'      => EP_NONE
		);
		/* Register the Team Member Category taxonomy. */
		register_taxonomy( 'team_category', array( 'xylus-team' ), array(
				'labels'            => $labels,
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'query_var'         => 'team_category',
				'rewrite'      		=> $rewrite
		) );

	}

	/**
	 * Register Service Post type
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_service_post_type(){

		/*
		 * Service labels
		 */
		$xylus_service_labels = array(
				'name'                  => _x( 'Services', 'Post Type General Name', 'xylus-toolkit' ),
				'singular_name'         => _x( 'Services', 'Post Type Singular Name', 'xylus-toolkit' ),
				'menu_name'             => __( 'Services', 'xylus-toolkit' ),
				'name_admin_bar'        => __( 'Services', 'xylus-toolkit' ),
				'archives'              => __( 'Service Archives', 'xylus-toolkit' ),
				'parent_item_colon'     => __( 'Parent Service:', 'xylus-toolkit' ),
				'all_items'             => __( 'All Services', 'xylus-toolkit' ),
				'add_new_item'          => __( 'Add New Service', 'xylus-toolkit' ),
				'add_new'               => __( 'Add New', 'xylus-toolkit' ),
				'new_item'              => __( 'New Service', 'xylus-toolkit' ),
				'edit_item'             => __( 'Edit Service', 'xylus-toolkit' ),
				'update_item'           => __( 'Update Service', 'xylus-toolkit' ),
				'view_item'             => __( 'View Service', 'xylus-toolkit' ),
				'search_items'          => __( 'Search Service', 'xylus-toolkit' ),
				'not_found'             => __( 'Not found', 'xylus-toolkit' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'xylus-toolkit' ),
				'featured_image'        => __( 'Featured Image', 'xylus-toolkit' ),
				'set_featured_image'    => __( 'Set featured image', 'xylus-toolkit' ),
				'remove_featured_image' => __( 'Remove featured image', 'xylus-toolkit' ),
				'use_featured_image'    => __( 'Use as featured image', 'xylus-toolkit' ),
				'insert_into_item'      => __( 'Insert into Service', 'xylus-toolkit' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Service', 'xylus-toolkit' ),
				'items_list'            => __( 'Services list', 'xylus-toolkit' ),
				'items_list_navigation' => __( 'Services list navigation', 'xylus-toolkit' ),
				'filter_items_list'     => __( 'Filter Services list', 'xylus-toolkit' ),
		);
		$rewrite = array(
				'slug'                  => $this->service_slug,
				'with_front'            => true,
				'pages'                 => true,
				'feeds'                 => true,
		);
		$xylus_service_args = array(
				'label'                 => __( 'Services', 'xylus-toolkit' ),
				'description'           => __( 'Post type for Services', 'xylus-toolkit' ),
				'labels'                => $xylus_service_labels,
				'supports'              => array( 'title', 'editor', 'thumbnail'),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-hammer',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'rewrite'               => $rewrite,
		);
		register_post_type( 'xylus-service', $xylus_service_args );
	}


	/**
	 * Register Slider Post type
	 *
	 * @since    1.0.0
	 */
	public function xylus_toolkit_register_slider_post_type(){

		/*
		 * Slider Items labels
		 */
		$xylus_slider_labels = array(
				'name'                  => _x( 'Slider Items', 'Post Type General Name', 'xylus-toolkit' ),
				'singular_name'         => _x( 'Slider Items', 'Post Type Singular Name', 'xylus-toolkit' ),
				'menu_name'             => __( 'Slider Items', 'xylus-toolkit' ),
				'name_admin_bar'        => __( 'Slider Items', 'xylus-toolkit' ),
				'archives'              => __( 'Slider Item Archives', 'xylus-toolkit' ),
				'parent_item_colon'     => __( 'Parent Slider Item:', 'xylus-toolkit' ),
				'all_items'             => __( 'All Slider Items', 'xylus-toolkit' ),
				'add_new_item'          => __( 'Add New Slider Item', 'xylus-toolkit' ),
				'add_new'               => __( 'Add New', 'xylus-toolkit' ),
				'new_item'              => __( 'New Slider Item', 'xylus-toolkit' ),
				'edit_item'             => __( 'Edit Slider Item', 'xylus-toolkit' ),
				'update_item'           => __( 'Update Slider Item', 'xylus-toolkit' ),
				'view_item'             => __( 'View Slider Item', 'xylus-toolkit' ),
				'search_items'          => __( 'Search Slider Item', 'xylus-toolkit' ),
				'not_found'             => __( 'Not found', 'xylus-toolkit' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'xylus-toolkit' ),
				'featured_image'        => __( 'Featured Image', 'xylus-toolkit' ),
				'set_featured_image'    => __( 'Set featured image', 'xylus-toolkit' ),
				'remove_featured_image' => __( 'Remove featured image', 'xylus-toolkit' ),
				'use_featured_image'    => __( 'Use as featured image', 'xylus-toolkit' ),
				'insert_into_item'      => __( 'Insert into Slider Item', 'xylus-toolkit' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Slider Item', 'xylus-toolkit' ),
				'items_list'            => __( 'Slider Items list', 'xylus-toolkit' ),
				'items_list_navigation' => __( 'Slider Items list navigation', 'xylus-toolkit' ),
				'filter_items_list'     => __( 'Filter Slider Items list', 'xylus-toolkit' ),
		);
		$rewrite = array(
				'slug'                  => $this->slider_slug,
				'with_front'            => true,
				'pages'                 => true,
				'feeds'                 => true,
		);
		$xylus_slider_args = array(
				'label'                 => __( 'Slider Items', 'xylus-toolkit' ),
				'description'           => __( 'Post type for Slider Items', 'xylus-toolkit' ),
				'labels'                => $xylus_slider_labels,
				'supports'              => array( 'title', 'editor', 'thumbnail'),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-image-flip-horizontal',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'rewrite'               => $rewrite,
		);
		register_post_type( 'xylus-slider', $xylus_slider_args );
	}


}



function xylus_toolkit_post_types_init() {
	$xt_posttype = new Xylus_Toolkit_Post_Types;

	if ( current_theme_supports( 'xylus_themes_portfolio_support' ) ) {
		$xt_posttype->xylus_toolkit_register_portfolio_post_type();
		$xt_posttype->xylus_toolkit_register_portfolio_taxonomy();
	}

	if ( current_theme_supports( 'xylus_themes_testimonial_support' ) ) {
		$xt_posttype->xylus_toolkit_register_testimonial_post_type();
		$xt_posttype->xylus_toolkit_register_testimonial_taxonomy();
	}

	if ( current_theme_supports( 'xylus_themes_client_support' ) ) {
		$xt_posttype->xylus_toolkit_register_client_post_type();
		$xt_posttype->xylus_toolkit_register_client_taxonomy();
	}

	if ( current_theme_supports( 'xylus_themes_team_support' ) ) {
		$xt_posttype->xylus_toolkit_register_team_post_type();
		$xt_posttype->xylus_toolkit_register_team_taxonomy();
	}

	if ( current_theme_supports( 'xylus_themes_service_support' ) ) {
		$xt_posttype->xylus_toolkit_register_service_post_type();
	}

	if ( current_theme_supports( 'xylus_themes_slider_support' ) ) {
		$xt_posttype->xylus_toolkit_register_slider_post_type();
	}
}
add_action( 'init', 'xylus_toolkit_post_types_init', 0 );