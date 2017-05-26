<?php
function fitcase_field_value( $field_id ) {

	global $fitcase_post_meta;

	if ( isset ( $fitcase_post_meta[$field_id] ) ) {
		echo $fitcase_post_meta[$field_id][0];
	}
}

function test_save_hook( $post_id, $post, $update ) {
	$updated = ( $update ) ? "updated" : "saved";
	//error_log( "Post type of " . $post->post_type . " was " . $updated );

	error_log( print_r($_REQUEST) );
}
add_action( 'save_post', 'test_save_hook', 10, 3 );