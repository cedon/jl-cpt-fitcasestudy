<?php
/**
 * Create the metaboxes for writing the case study content
 */

// Create Meta Boxes
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

/*
 * Meta Box Callback for Client Info - Contains name, age, sex, and other basic information about client
 */
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
		<label for="fitcase_client_name"><?php _e( 'Client Name', 'fitcasestudy' ); ?></label>
		<input type="text" name="fitcase_client_name" id="fitcase_client_name" size="25" value="<?php fitcase_field_value( 'fitcase_client_name' ); ?>" />
	</p>

	<p>
		<label for="fitcase-client-age"><?php _e( 'Client Age', 'fitcasestudy' ); ?></label>
		<input type="text" name="fitcase_client_age" id="fitcase_client_age" value="<?php fitcase_field_value( 'fitcase-client-age' ); ?>" size="3" maxlength="3" />
	</p>

	<p>
		<label for="fitcase_client_gender"><?php _e( 'Client Gender', 'fitcasestudy' ); ?></label>
		<select id="fitcase_client_gender" name="fitcase_client_gender">
			<option value="male">Male</option>
			<option value="female">Female</option>
			<option value="Other">Other</option>
		</select>
	</p>

	<p>
		<label for="fitcase_client_height">Height:</label>
		<select name="fitcase_client_height" id="fitcase_client_height">
			<optgroup label="4&rsquo;">
				<option value="4&rsquo;">4&rsquo;</option>
				<option value="4&rsquo;&nbsp;1&rdquo;">4&rsquo;&nbsp;1&rdquo;</option>
				<option value="4&rsquo;&nbsp;2&rdquo;">4&rsquo;&nbsp;2&rdquo;</option>
				<option value="4&rsquo;&nbsp;3&rdquo;">4&rsquo;&nbsp;3&rdquo;</option>
				<option value="4&rsquo;&nbsp;4&rdquo;">4&rsquo;&nbsp;4&rdquo;</option>
				<option value="4&rsquo;&nbsp;5&rdquo;">4&rsquo;&nbsp;5&rdquo;</option>
				<option value="4&rsquo;&nbsp;6&rdquo;">4&rsquo;&nbsp;6&rdquo;</option>
				<option value="4&rsquo;&nbsp;7&rdquo;">4&rsquo;&nbsp;7&rdquo;</option>
				<option value="4&rsquo;&nbsp;8&rdquo;">4&rsquo;&nbsp;8&rdquo;</option>
				<option value="4&rsquo;&nbsp;9&rdquo;">4&rsquo;&nbsp;9&rdquo;</option>
				<option value="4&rsquo;&nbsp;10&rdquo;">4&rsquo;&nbsp;10&rdquo;</option>
				<option value="4&rsquo;&nbsp;11&rdquo;">4&rsquo;&nbsp;11&rdquo;</option>
			</optgroup>
			<optgroup label="5&rsquo;"> selected="selected"
				<option value="5&rsquo;">5&rsquo;</option>
				<option value="5&rsquo;&nbsp;1&rdquo;">5&rsquo;&nbsp;1&rdquo;</option>
				<option value="5&rsquo;&nbsp;2&rdquo;">5&rsquo;&nbsp;2&rdquo;</option>
				<option value="5&rsquo;&nbsp;3&rdquo;">5&rsquo;&nbsp;3&rdquo;</option>
				<option value="5&rsquo;&nbsp;4&rdquo;">5&rsquo;&nbsp;4&rdquo;</option>
				<option value="5&rsquo;&nbsp;5&rdquo;">5&rsquo;&nbsp;5&rdquo;</option>
				<option value="5&rsquo;&nbsp;6&rdquo;">5&rsquo;&nbsp;6&rdquo;</option>
				<option value="5&rsquo;&nbsp;7&rdquo;">5&rsquo;&nbsp;7&rdquo;</option>
				<option value="5&rsquo;&nbsp;8&rdquo;">5&rsquo;&nbsp;8&rdquo;</option>
				<option value="5&rsquo;&nbsp;9&rdquo;">5&rsquo;&nbsp;9&rdquo;</option>
				<option value="5&rsquo;&nbsp;10&rdquo;">5&rsquo;&nbsp;10&rdquo;</option>
				<option value="5&rsquo;&nbsp;11&rdquo;">5&rsquo;&nbsp;11&rdquo;</option>
			</optgroup>
			<optgroup label="6&rsquo;">
				<option value="6&rsquo;">6&rsquo;</option>
				<option value="6&rsquo;&nbsp;1&rdquo;">6&rsquo;&nbsp;1&rdquo;</option>
				<option value="6&rsquo;&nbsp;2&rdquo;">6&rsquo;&nbsp;2&rdquo;</option>
				<option value="6&rsquo;&nbsp;3&rdquo;">6&rsquo;&nbsp;3&rdquo;</option>
				<option value="6&rsquo;&nbsp;4&rdquo;">6&rsquo;&nbsp;4&rdquo;</option>
				<option value="6&rsquo;&nbsp;5&rdquo;">6&rsquo;&nbsp;5&rdquo;</option>
				<option value="6&rsquo;&nbsp;6&rdquo;">6&rsquo;&nbsp;6&rdquo;</option>
				<option value="6&rsquo;&nbsp;7&rdquo;">6&rsquo;&nbsp;7&rdquo;</option>
				<option value="6&rsquo;&nbsp;8&rdquo;">6&rsquo;&nbsp;8&rdquo;</option>
				<option value="6&rsquo;&nbsp;9&rdquo;">6&rsquo;&nbsp;9&rdquo;</option>
				<option value="6&rsquo;&nbsp;10&rdquo;">6&rsquo;&nbsp;10&rdquo;</option>
				<option value="6&rsquo;&nbsp;11&rdquo;">6&rsquo;&nbsp;11&rdquo;</option>
			</optgroup>
		</select>
	</p>

	<?php
}

function meta_box_clienthist_callback( $post ) {
	global $fitcase_post_meta;

	$fitcasestudy_client_history_content = $fitcase_post_meta['fitcase_client_history'][0];
	$editor_id = 'fitcase_client_history';

	if ( $fitcasestudy_client_history_content != '' ) {
		$editor_content = $fitcasestudy_client_history_content;
	} else {
		$editor_content = '';
	}
	?>
	<p>Enter in the history of the client.</p>
	<label for="fitcase_client_history" class="screen-reader-text"><?php _e( 'Client History Text Area', 'fitcasestudy' ); ?></label>

	<?php
	wp_editor( $editor_content, $editor_id );
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
	update_post_meta( $post_id, 'fitcase_client_name', $fitcase_client_name );

	$fitcase_client_history = $_POST['fitcase_client_history'];
	update_post_meta( $post_id, 'fitcase_client_history', $fitcase_client_history );

	error_log( 'fitcase_save_meta fired');

	error_log('$_POST Contents:' . print_r($_POST, true) );

}
add_action( 'save_post', 'fitcase_save_meta', 10, 3 );