<?php

// Register Custom Post Type
function fitnesscasestudy() {

	$labels = array(
		'name'                  => _x( 'Case Studies', 'Post Type General Name', 'fitcasestudy' ),
		'singular_name'         => _x( 'Case Study', 'Post Type Singular Name', 'fitcasestudy' ),
		'menu_name'             => __( 'Fitness Case Studies', 'fitcasestudy' ),
		'name_admin_bar'        => __( 'Post Type', 'fitcasestudy' ),
		'archives'              => __( 'Item Archives', 'fitcasestudy' ),
		'attributes'            => __( 'Item Attributes', 'fitcasestudy' ),
		'parent_item_colon'     => __( 'Parent Case', 'fitcasestudy' ),
		'all_items'             => __( 'All Cases', 'fitcasestudy' ),
		'add_new_item'          => __( 'Add New Case', 'fitcasestudy' ),
		'add_new'               => __( 'Add New Case Study', 'fitcasestudy' ),
		'new_item'              => __( 'New Case Study', 'fitcasestudy' ),
		'edit_item'             => __( 'Edit Case Study', 'fitcasestudy' ),
		'update_item'           => __( 'Update Case Study', 'fitcasestudy' ),
		'view_item'             => __( 'View Case', 'fitcasestudy' ),
		'view_items'            => __( 'View Cases', 'fitcasestudy' ),
		'search_items'          => __( 'Search Case', 'fitcasestudy' ),
		'not_found'             => __( 'Case Not Found', 'fitcasestudy' ),
		'not_found_in_trash'    => __( 'Case not found in Trash', 'fitcasestudy' ),
		'featured_image'        => __( 'Featured Image', 'fitcasestudy' ),
		'set_featured_image'    => __( 'Set featured image', 'fitcasestudy' ),
		'remove_featured_image' => __( 'Remove featured image', 'fitcasestudy' ),
		'use_featured_image'    => __( 'Use as featured image', 'fitcasestudy' ),
		'insert_into_item'      => __( 'Insert into case', 'fitcasestudy' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'fitcasestudy' ),
		'items_list'            => __( 'Items list', 'fitcasestudy' ),
		'items_list_navigation' => __( 'Items list navigation', 'fitcasestudy' ),
		'filter_items_list'     => __( 'Filter items list', 'fitcasestudy' ),
	);
	$args = array(
		'label'                 => __( 'Case Study', 'fitcasestudy' ),
		'description'           => __( 'A case study specficially designed for fitness professionals', 'fitcasestudy' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array( 'fitnessgoal' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'cases',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'fit-case-study', $args );

}
add_action( 'init', 'fitnesscasestudy', 0 );