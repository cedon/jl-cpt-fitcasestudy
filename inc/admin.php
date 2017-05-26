<?php

/*
 * Admin Panel Settings Registration
 */

/**
 * Creates the Admin Panel Subpage for Plugin Options and places it in the submenu defined by the custom
 * post type delcaration.
 */

function fitcase_admin_menu() {
	add_submenu_page(
		'edit.php?post_type=fitcasestudy',
		__( 'Options', 'fitcasestudy' ),
		__( 'Options', 'fitcasestudy' ),
		'administrator',
		'fitcase_admin_menu_options',
		'fitcase_admin_menu_options_callback'
	);
}
add_action( 'admin_menu', 'fitcase_admin_menu' );

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

/**
 * Create the metaboxes for writing the case study content
 */

// Create Meta Boxes for Case Studies
function add_meta_boxes_fitcasestudy() {
    add_meta_box(
        'fitcase-client-info',
        __( 'Client Information', 'fitcasestudy' ),
        'meta_box_clientinfo_callback',
        'fitcasestudy',
        'normal',
        'high'
    );

    add_meta_box(
        'fitcase-client-history',
        __( 'Client History', 'fitcasestudy' ),
        'meta_box_clienthist_callback',
        'fitcasestudy',
        'normal',
        'high'
    );

	add_meta_box(
		'fitcase-client-results',
		__( 'Client Results', 'fitcasestudy' ),
		'meta_box_clientresults_callback',
		'fitcasestudy',
		'normal',
		'high'
	);

	add_meta_box(
	        'fitcase-study-client-pics',
            __( 'Client Progress Photos', 'fitcasestudy' ),
            'meta_box_clientpics_callback',
            'fitcasestudy',
            'side',
            'default'
    );
}
add_action( 'add_meta_boxes', 'add_meta_boxes_fitcasestudy' );

function meta_box_clientinfo_callback( $post )  {
    global $fitcase_post_meta;
    $fitcase_post_meta = get_post_meta( $post->ID );
	wp_nonce_field( plugin_basename( __FILE__ ), 'fitcase-nonce' );

	echo '<pre>';
	print_r($fitcase_post_meta);
	echo '</pre>';
?>

    <p>Please enter in the information on the client whom you wish to feature in a case story.</p>
    <p>
        <label for="fitcase-client-name"><?php _e( 'Client Name', 'fitcasestudy' ); ?></label>
        <input type="text" name="fitcase_client_name" id="fitcase_client_name" size="25" value="<?php fitcase_field_value( 'client_name' ); ?>" />
    </p>

    <p>
        <label for="fitcase-client-age"><?php _e( 'Client Age', 'fitcasestudy' ); ?></label>
        <input type="text" name="fitcase_client-age" id="fitcase_client_age" value="<?php fitcase_field_value( 'fitcase-client-age' ); ?>" size="3" maxlength="3" />
    </p>

    <p>
        <label for="fitcase-client-gender"><?php _e( 'Client Gender', 'fitcasestudy' ); ?></label>
        <select name="fitcase-client-gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="Other">Other</option>
        </select>
    </p>

<?php
}

function meta_box_clienthist_callback( $post ) {
	echo '<pre>';
	//print_r($post_id);
	echo '</pre>';
}

function meta_box_clientresults_callback( $post ) {
	echo '<h2>Client Results</h2>';
}

function meta_box_clientpics_callback( $post ) {
    $fitcase_post_meta = get_post_meta( $post->ID );
?>

    <p>Before/After photos of client</p>

<?php
}

/**
 * Save Meta Box Data to the database
 */
function fitcase_save_meta( $post_id, $post, $update ) {

    global $fitcase_post_meta;
    $fitcase_post_meta = get_post_meta( $post_id );
	error_log( 'fitcase_save_meta is firing');


	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	    error_log( 'fitcase_save_meta: Doing Autosave');
        return;
    }

    // Verify Nonce
    

    if ( !current_user_can( 'edit_post', $post_id ) ) {
        error_log('fitcase_save_meta: user cannot edit posts');
        return;
    }

    if ( !current_user_can( 'edit_page' , $post_id ) ) {
            error_log( 'fitcase_save_meta: user cannot edit pages');
            return;
    }

    error_log('All Conditions are Met');

    $fitcase_client_name = $_POST['fitcase_client_name'];
    update_post_meta( $post_id, 'client_name', $fitcase_client_name );

    error_log( 'fitcase_save_meta fired');

    error_log('$_POST Contents:');
    error_log( print_r($_POST, true));

}
add_action( 'save_post', 'fitcase_save_meta', 10, 3 );