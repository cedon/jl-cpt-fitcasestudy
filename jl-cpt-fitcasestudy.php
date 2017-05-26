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

// JSON Linked Data
if ( get_option( 'fitcase_toggle_jsonld' ) ) {
	?>
	<script language="JavaScript">
		console.log('JSON-LD is Enabled');
	</script>
	<?php
	//require_once ( plugin_dir_path( __FILE__) . 'inc/jsonld.php' );
}
// Post Template

