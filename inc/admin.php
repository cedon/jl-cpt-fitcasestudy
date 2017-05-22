<?php

/*
 * Admin Panel Settings Registration
 */

/**
 * Creates thr Admin Panel Menu
 */

function fitcase_admin_menu() {
	add_menu_page(
		'Fitness Case Studies',
		'Fitness Case Studies',
		'editor',
		'fitcase_admin_menu',
		'fitcase_admin_menu_callback',
		'dashicons-universal-access',
		9
	);

	add_submenu_page(
		'fitcase_admin_menu',
		__( 'Options', 'fitcasestudy' ),
		__( 'Options', 'fitcasestudy' ),
		'administrator',
		'fitcase_admin_menu_options',
		'fitcase_admin_menu_options_callback'
	);
}
add_action( 'admin_menu', 'fitcase_admin_menu' );

function fitcase_admin_menu_callback() {

}

function fitcase_admin_menu_options_callback() { ?>
	<form method="post" action="options.php">
	<?php
		settings_fields( 'fitcase_settings_section' );
		do_settings_sections( 'fitcase_admin_menu_options' );
		submit_button();
	?>
	</form>

<?php }

/**
 * Initializes the plugin options page by registering Sections, Fields, and Settings
 */

function fitcase_initialize_plugin_options() {
	add_settings_section(
		'fitcase_settings_section',
		'Fitness Case Study Options',
		'fitcase_general_options_callback',
		'fitcase_admin_menu_options'
	);

	// Add JSON-LD Toggle Option
	add_settings_field(
		'fitcase_toggle_jsonld',
		'JSON-LD',
		'fitcase_toggle_jsonld_callback',
		'fitcase_admin_menu_options',
		'fitcase_settings_section',
		array(
			'Use JSON-LD for encoding linked data. Please note that enabling this will disable JSON-LD output from Yoast SEO.',
		)
	);

	// Register JSON-LD Toggle Option
	register_setting(
		'fitcase_settings_section',
		'fitcase_toggle_jsonld'
	);
}
add_action( 'admin_init', 'fitcase_initialize_plugin_options' );

function fitcase_general_options_callback() {
	echo '<p>These options control the various features of Fitness Case Studies</p>';
}

function fitcase_toggle_jsonld_callback( $args ) {
	// ID & Name attributes MUST match the ID of the add_settings_field() declaration
	$fitcase_html = '<input type="checkbox" id="fitcase_toggle_jsonld" name="fitcase_toggle_jsonld" value="1" ' . checked( 1, get_option( 'fitcase_toggle_jsonld' ), false ) . '/>';

	// Add description from arguments
	$fitcase_html .= '<label for="fitcase_use_jsonld"> ' . $args[0] . '</label>';

	echo $fitcase_html;
}