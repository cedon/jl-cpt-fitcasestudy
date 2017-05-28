<?php

/*
Plugin Name: JL Fitness Case Study Custom Post Type
Plugin URI: http://jonliebold.com
Description: A plugin to create a custom post type for Case Studies specifically for fitness professionals and facilities.
Version: 1.0
Author: Jon Liebold
Author URI: http://jonliebold.com
Text Domain: fitcasestudy
License: GPLv2 or later
*/

// Plugin Helper Functions
require_once ( plugin_dir_path( __FILE__ ) . 'inc/functions.php' );

// Custom Post Type Definition
require_once ( plugin_dir_path( __FILE__ ) . 'inc/post-type.php');

// Custom Taxonomy Definition
require_once ( plugin_dir_path( __FILE__ ) . 'inc/taxonomy.php' );

// Administrative Options
require_once ( plugin_dir_path( __FILE__ ) . 'inc/admin.php' );

// Case Study Writing Functions
require_once ( plugin_dir_path( __FILE__ ) . 'inc/metaboxes.php');

// JSON Linked Data
if ( get_option( 'fitcase_toggle_jsonld' ) ) {
	//require_once ( plugin_dir_path( __FILE__) . 'inc/jsonld.php' );
}

// Plugin Activation Hook
function fitcase_activation() {
	// Custom Post Type and Custom Taxonomy Functions Get Moved Here
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'fitcase_activation' );

// Plugin Deactivation Hook
function fitcase_deactivation() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'fitcase_deactivation' );

// Enqueue All JavaScript and CSS Files
function fitcase_admin_enqueues() {
	wp_enqueue_script( 'fitcasestudy-admin-js', plugin_dir_url( __FILE__ ) . 'js/fitcasestudy-admin.js', array( 'jquery' ), '0.1', false );
}
//add_action( 'admin_enqueue_scripts', 'fitcase_admin_enqueues' );