<?php
function forrrest_post_types() {
	$labels = array(
		'name'               => esc_html__( 'Flowers', 'forrrest' ),
		'singular_name'      => esc_html__( 'Flowers', 'forrrest' ),
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Flower',
		'edit_item'          => 'Edit Flower',
		'new_item'           => 'New Flower',
		'all_items'          => 'All Flowers',
		'view_item'          => 'View Flower',
		'search_items'       => 'Search Flowers',
		'not_found'          => 'No Flowers found',
		'not_found_in_trash' => 'No Flowers found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'Flowers',
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => get_template_directory_uri() . "/images/flower.png",
		'show_in_rest'       => true,
		'supports'           => array( 'title' ),
		'taxonomies'         => array(),
	);
	register_post_type( 'Flower', $args );

	$labels = array(
		'name'               => esc_html__( 'Trees', 'forrrest' ),
		'singular_name'      => esc_html__( 'Trees', 'forrrest' ),
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Tree',
		'edit_item'          => 'Edit Tree',
		'new_item'           => 'New Tree',
		'all_items'          => 'All Trees',
		'view_item'          => 'View Tree',
		'search_items'       => 'Search Trees',
		'not_found'          => 'No Trees found',
		'not_found_in_trash' => 'No Trees found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'Trees',
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => get_template_directory_uri() . "/images/tree.png",
		'show_in_rest'       => true,
		'supports'           => array( 'title' ),
		'taxonomies'         => array(),
	);
	register_post_type( 'Trees', $args );

}
add_action( 'init', 'forrrest_post_types' );
?>