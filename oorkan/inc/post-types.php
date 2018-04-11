<?php
 	abspath_check("ABSPATH");
 ?>

<?php
	function custom_post_type() {
		/**
		 * Registers a new post type
		 * @uses $wp_post_types Inserts new post type object into the list
		 *
		 * @param string  Post type key, must not exceed 20 characters
		 * @param array|string  See optional args description above.
		 * @return object|WP_Error the registered post type object, or an error object
		 */
		//*******
		//
		// Quizzes fields
		//
		//*******
		$labels_quiz = array(
			'name'               => __( 'Quizzes', 'bridge-child' ),
			'singular_name'      => __( 'Quiz', 'bridge-child' ),
			'add_new'            => _x( 'Add New Quiz', 'bridge-child' ),
			'add_new_item'       => __( 'Add New Quiz', 'bridge-child' ),
			'edit_item'          => __( 'Edit Quiz', 'bridge-child' ),
			'new_item'           => __( 'New Quiz', 'bridge-child' ),
			'view_item'          => __( 'View Quiz', 'bridge-child' ),
			'search_items'       => __( 'Search Quizzes', 'bridge-child' ),
			'not_found'          => __( 'No Quizzes found', 'bridge-child' ),
			'not_found_in_trash' => __( 'No Quizzes found in Trash', 'bridge-child' ),
			'parent_item_colon'  => __( 'Parent Singular Name:', 'bridge-child' ),
			'menu_name'          => __( 'Quizzes', 'bridge-child' ),
		);

		$args_quiz = array(
			'labels'              => $labels_quiz,
			'hierarchical'        => false,
			'description'         => 'A custom post type for creating quizzes',
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => null,
			'menu_icon'           => null,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'has_archive'         => false,
			// 'query_var'           => true,
			// 'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'trackbacks',
				/*'comments',*/
				'revisions',
				'page-attributes',
				/*'post-formats',*/
			),
		);


		register_post_type( "quiz", $args_quiz );

	}
	add_action( "init", "custom_post_type" );

	$args = array(
    // 'sanitize_callback' => 'sanitize_my_meta_key',
    // 'auth_callback' => 'authorize_my_meta_key',
    'type' => 'integer',
    // 'description' => 'My registered meta key',
    'single' => true,
    'show_in_rest' => false,
	);
  register_meta( 'quiz', 'step', $args);
 ?>