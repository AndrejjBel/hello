<?php
add_action( 'init', 'hello_register_post_type_candidates' );
function hello_register_post_type_candidates(){
    $textdomain = 'hello';
    $dashicons = 'dashicons-id';
    $cpt_slug = 'candidates';
    $cpt_name = __( 'Candidates', $textdomain );
    $cpt_singular_name = __( 'Candidate', $textdomain );
    $ctax_slug = 'candidates-position';
    $ctax_name = __( 'Candidate positions', $textdomain );
    $ctax_singular_name = __( 'Position of the candidate', $textdomain );

    register_taxonomy( $ctax_slug, [ $cpt_slug ], [
		'label'                 => '',
		'labels'                => [
            'name'              => __( $ctax_name, $textdomain ),
            'singular_name'     => __( $ctax_singular_name, $textdomain ),
            'search_items'      => __( 'Search ' . $ctax_singular_name, $textdomain ),
            'all_items'         => __( 'All ' . $ctax_name, $textdomain ),
            'view_item '        => __( 'View ' . $ctax_singular_name, $textdomain ),
            'parent_item'       => __( 'Parent ' . $ctax_singular_name, $textdomain ),
            'parent_item_colon' => __( 'Parent ' . $ctax_singular_name . ':', $textdomain ),
            'edit_item'         => __( 'Edit ' . $ctax_singular_name, $textdomain ),
            'update_item'       => __( 'Update ' . $ctax_singular_name, $textdomain ),
            'add_new_item'      => __( 'Add ' . $ctax_singular_name, $textdomain ),
            'new_item_name'     => __( 'New ' . $ctax_singular_name, $textdomain ),
            'menu_name'         => __( $ctax_name, $textdomain ),
            'back_to_items'     => __( '← Back to ' . $ctax_name, $textdomain ),
		],
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'rest_base'             => null,
	] );

	register_post_type( $cpt_slug, [
		'label'  => null,
		'labels' => [
            'name'               => __( $cpt_name, $textdomain ),
            'singular_name'      => __( $cpt_singular_name, $textdomain ),
            'add_new'            => __( 'Add New ' . $cpt_singular_name, $textdomain ),
            'add_new_item'       => __( 'Add New ' . $cpt_singular_name, $textdomain ),
            'edit_item'          => __( 'Edit ' . $cpt_singular_name, $textdomain ),
            'new_item'           => __( 'New ' . $cpt_singular_name, $textdomain ),
            'view_item'          => __( 'View ' . $cpt_name, $textdomain ),
            'search_items'       => __( 'Search ' . $cpt_name, $textdomain ),
            'not_found'          => __( 'No ' . $cpt_singular_name . ' Found', $textdomain ),
            'not_found_in_trash' => __( 'No ' . $cpt_singular_name . ' found in Trash', $textdomain ),
            'menu_name'             => __( $cpt_name, $textdomain ),
            'parent_item_colon'  => '',
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
		'show_in_rest'        => true,
		'rest_base'           => null,
		'menu_position'       => null,
		'menu_icon'           => $dashicons,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [$ctax_slug],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

add_action( 'init', 'hello_register_post_type_vacancies' );
function hello_register_post_type_vacancies(){
    $textdomain = 'hello';
    $dashicons = 'dashicons-groups';
    $cpt_slug = HELLO_POSIT;
    $cpt_name = __( 'Positions', $textdomain );
    $cpt_singular_name = __( 'Position', $textdomain );
    $ctax_slug = HELLO_POSIT_LEV;
    $ctax_name = __( 'Position levels', $textdomain );
    $ctax_singular_name = __( 'Level of the position', $textdomain );

    register_taxonomy( $ctax_slug, [ $cpt_slug ], [
		'label'                 => '',
		'labels'                => [
            'name'              => __( $ctax_name, $textdomain ),
            'singular_name'     => __( $ctax_singular_name, $textdomain ),
            'search_items'      => __( 'Search ' . $ctax_singular_name, $textdomain ),
            'all_items'         => __( 'All ' . $ctax_name, $textdomain ),
            'view_item '        => __( 'View ' . $ctax_singular_name, $textdomain ),
            'parent_item'       => __( 'Parent ' . $ctax_singular_name, $textdomain ),
            'parent_item_colon' => __( 'Parent ' . $ctax_singular_name . ':', $textdomain ),
            'edit_item'         => __( 'Edit ' . $ctax_singular_name, $textdomain ),
            'update_item'       => __( 'Update ' . $ctax_singular_name, $textdomain ),
            'add_new_item'      => __( 'Add ' . $ctax_singular_name, $textdomain ),
            'new_item_name'     => __( 'New ' . $ctax_singular_name, $textdomain ),
            'menu_name'         => __( $ctax_name, $textdomain ),
            'back_to_items'     => __( '← Back to ' . $ctax_name, $textdomain ),
		],
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'rest_base'             => null,
	] );

	register_post_type( $cpt_slug, [
		'label'  => null,
		'labels' => [
            'name'               => __( $cpt_name, $textdomain ),
            'singular_name'      => __( $cpt_singular_name, $textdomain ),
            'add_new'            => __( 'Add New ' . $cpt_singular_name, $textdomain ),
            'add_new_item'       => __( 'Add New ' . $cpt_singular_name, $textdomain ),
            'edit_item'          => __( 'Edit ' . $cpt_singular_name, $textdomain ),
            'new_item'           => __( 'New ' . $cpt_singular_name, $textdomain ),
            'view_item'          => __( 'View ' . $cpt_name, $textdomain ),
            'search_items'       => __( 'Search ' . $cpt_name, $textdomain ),
            'not_found'          => __( 'No ' . $cpt_singular_name . ' Found', $textdomain ),
            'not_found_in_trash' => __( 'No ' . $cpt_singular_name . ' found in Trash', $textdomain ),
            'menu_name'             => __( $cpt_name, $textdomain ),
            'parent_item_colon'  => '',
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
		'show_in_rest'        => true,
		'rest_base'           => null,
		'menu_position'       => null,
		'menu_icon'           => $dashicons,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [$ctax_slug],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

add_action( 'init', 'hello_register_post_type_responses' );
function hello_register_post_type_responses(){
    $textdomain = 'hello';
    $dashicons = 'dashicons-image-rotate';
    $cpt_slug = HELLO_RESPONS;
    $cpt_name = __( 'Responses', $textdomain );
    $cpt_singular_name = __( 'Response', $textdomain );

	register_post_type( $cpt_slug, [
		'label'  => null,
		'labels' => [
            'name'               => __( $cpt_name, $textdomain ),
            'singular_name'      => __( $cpt_singular_name, $textdomain ),
            'add_new'            => __( 'Add New ' . $cpt_singular_name, $textdomain ),
            'add_new_item'       => __( 'Add New ' . $cpt_singular_name, $textdomain ),
            'edit_item'          => __( 'Edit ' . $cpt_singular_name, $textdomain ),
            'new_item'           => __( 'New ' . $cpt_singular_name, $textdomain ),
            'view_item'          => __( 'View ' . $cpt_name, $textdomain ),
            'search_items'       => __( 'Search ' . $cpt_name, $textdomain ),
            'not_found'          => __( 'No ' . $cpt_singular_name . ' Found', $textdomain ),
            'not_found_in_trash' => __( 'No ' . $cpt_singular_name . ' found in Trash', $textdomain ),
            'menu_name'             => __( $cpt_name, $textdomain ),
            'parent_item_colon'  => '',
		],
		'description'            => '',
		'public'                 => true,
        'publicly_queryable'     => false,
		'show_in_menu'           => true,
		'show_in_rest'        => true,
		'rest_base'           => null,
		'menu_position'       => null,
		'menu_icon'           => $dashicons,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'custom-fields', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [''],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => false,
	] );
}
