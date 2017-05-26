<?php
function fitcase_field_value( $field_id ) {

	global $fitcase_post_meta;

	if ( isset ( $fitcase_post_meta[$field_id] ) ) {
		echo $fitcase_post_meta[$field_id][0];
	}

}