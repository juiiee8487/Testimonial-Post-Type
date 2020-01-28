<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/juiiee8487
 * @since      1.0.0
 *
 * @package    Testimonial_Post_Type
 * @subpackage Testimonial_Post_Type/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Testimonial_Post_Type
 * @subpackage Testimonial_Post_Type/admin
 * @author     Juhi Patel <juhir22495@gmail.com>
 */
class Testimonial_Post_Type_Admin {

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
		 * defined in Testimonial_Post_Type_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Testimonial_Post_Type_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/testimonial-post-type-admin.css', array(), $this->version, 'all' );

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
		 * defined in Testimonial_Post_Type_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Testimonial_Post_Type_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/testimonial-post-type-admin.js', array( 'jquery' ), $this->version, false );

	}


	public function tpt_create() {

		$labels = array(
			'name'                  => _x( 'Testimonials', 'TestiMonial General Name', 'testimonial-post-type' ),
			'singular_name'         => _x( 'Testimonial', 'TestiMonial Singular Name', 'testimonial-post-type' ),
			'menu_name'             => __( 'TestiMonials', 'testimonial-post-type' ),
			'name_admin_bar'        => __( 'TestiMonial', 'testimonial-post-type' ),
			'archives'              => __( 'Testimonial Archives', 'testimonial-post-type' ),
			'attributes'            => __( 'Testimonial Attributes', 'testimonial-post-type' ),
			'parent_item_colon'     => __( 'Parent Testimonial:', 'testimonial-post-type' ),
			'all_items'             => __( 'All Testimonials', 'testimonial-post-type' ),
			'add_new_item'          => __( 'Add New Testimonial', 'testimonial-post-type' ),
			'add_new'               => __( 'Add New Testimonial', 'testimonial-post-type' ),
			'new_item'              => __( 'New Testimonial', 'testimonial-post-type' ),
			'edit_item'             => __( 'Edit Testimonial', 'testimonial-post-type' ),
			'update_item'           => __( 'Update Testimonial', 'testimonial-post-type' ),
			'view_item'             => __( 'View Testimonial', 'testimonial-post-type' ),
			'view_items'            => __( 'View Testimonials', 'testimonial-post-type' ),
			'search_items'          => __( 'Search Testimonials', 'testimonial-post-type' ),
			'not_found'             => __( 'Not found', 'testimonial-post-type' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'testimonial-post-type' ),
			'featured_image'        => __( 'Featured Image', 'testimonial-post-type' ),
			'set_featured_image'    => __( 'Set featured image', 'testimonial-post-type' ),
			'remove_featured_image' => __( 'Remove featured image', 'testimonial-post-type' ),
			'use_featured_image'    => __( 'Use as featured image', 'testimonial-post-type' ),
			'insert_into_item'      => __( 'Insert into Testimonial', 'testimonial-post-type' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'testimonial-post-type' ),
			'items_list'            => __( 'Testimonials list', 'testimonial-post-type' ),
			'items_list_navigation' => __( 'Testimonials list navigation', 'testimonial-post-type' ),
			'filter_items_list'     => __( 'Filter Testimonials list', 'testimonial-post-type' ),
		);
		$args = array(
			'label'                 => __( 'Testimonial', 'testimonial-post-type' ),
			'description'           => __( 'TestiMonial Description', 'testimonial-post-type' ),
			'labels'                => $labels,
			'supports'              => array('title','editor','excerpt','thumbnail','comments','author','custom-fields','revisions', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'           	=> 'dashicons-format-quote',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'testimonial', $args );

	}


	public function tpt_taxonomy() {

		$labels = array(
			'name'                       => _x( ' Testimonial Taxonomies', 'Taxonomy General Name', 'testimonial-post-type' ),
			'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'testimonial-post-type' ),
			'menu_name'                  => __( 'Testimonial Taxonomy', 'testimonial-post-type' ),
			'all_items'                  => __( 'All Taxonomies', 'testimonial-post-type' ),
			'parent_item'                => __( 'Parent Taxonomy', 'testimonial-post-type' ),
			'parent_item_colon'          => __( 'Parent Taxonomy:', 'testimonial-post-type' ),
			'new_item_name'              => __( 'New Taxonomy Name', 'testimonial-post-type' ),
			'add_new_item'               => __( 'Add New Taxonomy', 'testimonial-post-type' ),
			'edit_item'                  => __( 'Edit Taxonomy', 'testimonial-post-type' ),
			'update_item'                => __( 'Update Taxonomy', 'testimonial-post-type' ),
			'view_item'                  => __( 'View Taxonomy', 'testimonial-post-type' ),
			'separate_items_with_commas' => __( 'Separate Taxonomies with commas', 'testimonial-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove Taxonomies', 'testimonial-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'testimonial-post-type' ),
			'popular_items'              => __( 'Popular Taxonomies', 'testimonial-post-type' ),
			'search_items'               => __( 'Search Taxonomies', 'testimonial-post-type' ),
			'not_found'                  => __( 'Not Found', 'testimonial-post-type' ),
			'no_terms'                   => __( 'No Taxonomies', 'testimonial-post-type' ),
			'items_list'                 => __( 'Taxonomies list', 'testimonial-post-type' ),
			'items_list_navigation'      => __( 'Taxonomies list navigation', 'testimonial-post-type' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'taxonomy', array( 'testimonial' ), $args );

	}
		
	public function tpt_tag_taxonomies() 
	{
	  // Add new taxonomy, NOT hierarchical (like tags)
	  $labels = array(
	    'name' => _x( 'Testimonial Tags', 'taxonomy general name', 'testimonial-post-type' ),
	    'singular_name' => _x( 'Tag', 'taxonomy singular name', 'testimonial-post-type', 'testimonial-post-type' ),
	    'search_items' =>  __( 'Search Tags', 'testimonial-post-type' ),
	    'popular_items' => __( 'Popular Tags' , 'testimonial-post-type'),
	    'all_items' => __( 'All Tags', 'testimonial-post-type' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Tag' , 'testimonial-post-type'), 
	    'update_item' => __( 'Update Tag', 'testimonial-post-type' ),
	    'add_new_item' => __( 'Add New Tag', 'testimonial-post-type' ),
	    'new_item_name' => __( 'New Tag Name', 'testimonial-post-type' ),
	    'separate_items_with_commas' => __( 'Separate tags with commas', 'testimonial-post-type' ),
	    'add_or_remove_items' => __( 'Add or remove tags', 'testimonial-post-type' ),
	    'choose_from_most_used' => __( 'Choose from the most used tags', 'testimonial-post-type' ),
	    'menu_name' => __( 'Testimonial Tags', 'testimonial-post-type' ),
	  ); 

	  register_taxonomy('tag','testimonial',array(
	    'hierarchical' => false,
	    'labels' => $labels,
	    'show_ui' => true,
	    'update_count_callback' => '_update_post_term_count',
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'tag' ),
	  ));
	}	

	public function add_thumbnail_column( $columns ) {
		$column_thumbnail = array( 'thumbnail' => __( 'Thumbnail', 'testimonial-post-type' ) );
		return array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
		$column_tags = array( 'Testimonial Tags' => __( 'Testimonial Tags', 'testimonial-post-type' ) );
		return array_slice( $columns, 0, 2, true ) + $column_tag + array_slice( $columns, 1, null, true );
	}

}
