<?php

// Register the Settings
function fitcase_register_settings() {
	add_settings_section(
		'fitcase-general-settings',
		'General Options',
		'fitcase_general_settings_callback',
		'fitcasestudy-settings'
	);

	add_settings_field(
		'fitcase-json-ld',
		'Enable JSON-LD',
		'fitcase_jsonld_callback',
		'fitcasestudy-settings',
		'fitcase-general-settings',
		array(
			'Use the built-in JSON-LD output. Please note that this <strong>will</strong> disable the default output of Yoast SEO.'
		)
	);
}
add_action( 'admin_init', 'fitcase_register_settings' );

function fitcase_general_settings_callback() {
	echo '<p>Lorem Impsom and so forth...</p>';
}

function fitcase_jsonld_callback() {

	// ID & Name attritubes MUST match the ID of the add_settings_field() declaration
	$fitcase_json_html = '<input type="checkbox" id="fitcase-json-ld" name="fitcase-json-ld" value="1" ' .checked( 1, get_option( 'fitcase-json-ld' ), false ) . '/>';

	// Add description from arguments
	$fitcase_json_html .= '<label for="fitcase-json-ld"> ' . $args[0] . '</label>';

}

// Register Settings
register_setting(
	'fitcase-general-settings',
	'fitcase-json-ld'
);

// Add Admin Page
function fitcase_admin_page() {
	add_menu_page(
		'Fitness Case Studies',
		'OPTIONS',
		'administrator',
		'fitcasestudy-settings',
		'fitcase_admin_callback' );

	add_submenu_page(
		'fitcasestudy-settings',
		'Case Study Options',
		'Options',
		'administrator',
		'fitcasestudy-options',
		'fitcase_options_callback'
	);
}
add_action( 'admin_menu', 'fitcase_admin_page' );

function fitcase_admin_callback() {
	$fitcase_admin_html = '<div class="wrap">';
		$fitcase_admin_html .= '<h2>Fitness Case Study</h2>';
	$fitcase_admin_html .= '</div>';

	echo $fitcase_admin_html;
}

function fitcase_options_callback() {
	$fitcase_html = '<div class="wrap">';
		$fitcase_html .= '<h2>Fitness Case Study</h2>';
	$fitcase_html .= '</div>';

	echo $fitcase_html;
}