<?php

// Register Custom Taxonomy
function fitness_goal_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Fitness Goals', 'Taxonomy General Name', 'fitcasestudy' ),
		'singular_name'              => _x( 'Fitness Goal', 'Taxonomy Singular Name', 'fitcasestudy' ),
		'menu_name'                  => __( 'Fitness Goals', 'fitcasestudy' ),
		'all_items'                  => __( 'All Goals', 'fitcasestudy' ),
		'parent_item'                => __( 'Parent Goal', 'fitcasestudy' ),
		'parent_item_colon'          => __( 'Parent Goal:', 'fitcasestudy' ),
		'new_item_name'              => __( 'New Goal', 'fitcasestudy' ),
		'add_new_item'               => __( 'Add New Goal', 'fitcasestudy' ),
		'edit_item'                  => __( 'Edit Goal', 'fitcasestudy' ),
		'update_item'                => __( 'Update Goal', 'fitcasestudy' ),
		'view_item'                  => __( 'View Goal', 'fitcasestudy' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'fitcasestudy' ),
		'add_or_remove_items'        => __( 'Add or Remove Goal', 'fitcasestudy' ),
		'choose_from_most_used'      => __( 'Common Goals', 'fitcasestudy' ),
		'popular_items'              => __( 'Popular Goals', 'fitcasestudy' ),
		'search_items'               => __( 'Search Goals', 'fitcasestudy' ),
		'not_found'                  => __( 'Goal Not Found', 'fitcasestudy' ),
		'no_terms'                   => __( 'No items', 'fitcasestudy' ),
		'items_list'                 => __( 'Items list', 'fitcasestudy' ),
		'items_list_navigation'      => __( 'Items list navigation', 'fitcasestudy' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'fitnessgoal', array( 'fitcasestudy' ), $args );

}
add_action( 'init', 'fitness_goal_taxonomy', 0 );