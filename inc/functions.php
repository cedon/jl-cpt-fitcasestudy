<?php
function fitcase_field_value( $field_id, $echo = false ) {

	global $fitcase_post_meta;

	if ( isset ( $fitcase_post_meta[$field_id] ) ) {
		return $fitcase_post_meta[$field_id][0];
	} elseif ( isset ( $fitcase_post_meta[$field_id] ) && $echo == true ) {
		echo $fitcase_post_meta[$field_id][0];
	} else {
		return;
	}
}

function testMetric() {
	$units = get_option( 'fitcase_toggle_height_unit' );
	if ( ( !isset( $fitcase_post_meta['fitcase_client_height'] ) && $units == 'ft' ) xor strpos( fitcase_field_value( 'fitcase_client_height' ), 'ft' ) )  {
		error_log('The Height is in Feet');
	} else {
		error_log( 'The Height is in Centimeters');
	}
}

function test_save_hook( $post_id, $post, $update ) {
	$updated = ( $update ) ? "updated" : "saved";
	//error_log( "Post type of " . $post->post_type . " was " . $updated );

	//error_log( print_r($_REQUEST) );
}
add_action( 'save_post', 'test_save_hook', 10, 3 );