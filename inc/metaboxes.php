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
	wp_nonce_field( plugin_basename( __FILE__ ), 'fitcase_nonce' );

	echo '<pre>';
	    print_r($fitcase_post_meta);
	echo '</pre>';
	?>

<!--	<p>Please enter in the information on the client whom you wish to feature in a case story.</p>-->
	<p>
        <label for="fitcase_client_first_name"><?php _e( 'First Name', 'fitcasestudy' ); ?></label>
        <input type="text" name="fitcase_client_first_name" id="fitcase_client_first_name" size="25" value="<?php if ( isset( $fitcase_post_meta['fitcase_client_first_name'] ) ) echo $fitcase_post_meta['fitcase_client_first_name'][0]; ?>" />

        <label for="fitcase_client_first_name"><?php _e( 'Last Name', 'fitcasestudy' ); ?></label>
        <input type="text" name="fitcase_client_last_name" id="fitcase_client_last_name" size="25" value="<?php if ( isset( $fitcase_post_meta['fitcase_client_last_name'] ) ) echo $fitcase_post_meta['fitcase_client_last_name'][0]; ?>" />
    </p>

	<p>
        <label for="fitcase_client_sex"><?php _e( 'Sex', 'fitcasestudy' ); ?></label>
        <select id="fitcase_client_sex" name="fitcase_client_sex">
            <option value=""></option>
            <option value="Male" <?php selected( $fitcase_post_meta['fitcase_client_sex'][0], 'Male' ) ; ?>>Male</option>
            <option value="Female" <?php selected( $fitcase_post_meta['fitcase_client_sex'][0], 'Female' ) ; ?>>Female</option>
            <option value="Other" <?php selected( $fitcase_post_meta['fitcase_client_sex'][0], 'Other' ) ; ?>>Other</option>
        </select>

		<label for="fitcase-client-age"><?php _e( 'Age', 'fitcasestudy' ); ?></label>
		<input type="text" name="fitcase_client_age" id="fitcase_client_age" value="<?php if ( isset( $fitcase_post_meta['fitcase_client_age'] ) ) echo $fitcase_post_meta['fitcase_client_age'][0];  ?>" size="3" maxlength="3" />
	</p>

	<p>
        <?php _e( 'Height', 'fitcasestudy' ); ?>
        <!-- PHP If/Then Conditional to determine if ft/in or cm input fields get displayed will go here -->

        <?php _e( 'Weight', 'fircasestudy' ); ?>
        <!-- PHP If/Then Conditional to determine if lbs or kg label get displayed will go here -->
        <p>
	</p>

    <p>
        <?php
            if ( ! isset( $fitcase_post_meta['fitcase_client_goal'][0] ) ) {
                $fitcase_post_meta['fitcase_client_goal'][0] = '';
            }

            $args = array(
                'taxonomy'      => 'fitnessgoal',
                'orderby'       => 'name',
                'hide_empty'    => 0,
            );

            $fitcase_terms = get_terms( $args );

            if ( ! empty( $fitcase_terms ) ) { ?>
                <label for="fitcase_client_goal"><?php _e( 'Fitness Goal', 'fitcasestudy' ); ?></label>
                <select id="fitcase_client_goal" name="fitcase_client_goal">
                    <option value="" <?php selected( $fitcase_post_meta['fitcase_client_goal'][0], '' ); ?>></option>
                <?php foreach ( $fitcase_terms as $term ) { ?>
                    <option value="<?php echo $term->slug; ?>" <?php selected( $fitcase_post_meta['fitcase_client_goal'][0], $term->slug ); ?>><?php echo $term->name; ?></option>
                <?php } ?>
                </select>
            <?php } else {
                echo '<label for="fitcase_client_goal">' . _e( 'Fitness Goal', 'fitcasestudy' ) . '</label>';
	            echo '<span id="fitcase_client_goal" class="fitcase-warning">&nbsp; None Have Been Defined</span>';
            }

            //error_log( print_r($fitcase_terms, true) );
        ?>
    </p>
	<?php
}

function meta_box_clienthist_callback( $post ) {
	global $fitcase_post_meta;

	$editor_id = 'fitcase_client_history';
	$fitcasestudy_client_history_content = '';

	if ( isset( $fitcase_post_meta['fitcase_client_history'] ) ) {
		$fitcasestudy_client_history_content = $fitcase_post_meta['fitcase_client_history'][0];
    }

	if ( $fitcasestudy_client_history_content != '' ) {
		$editor_content = $fitcasestudy_client_history_content;
	} else {
		$editor_content = '';
	}
	?>
	<p>Enter in the history of the client.</p>

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


	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Verify Nonce
    if ( ! isset( $_POST['fitcase_nonce'] ) ) {
	    return;
    }

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page' , $post_id ) ) {
		return;
	}

	if ( isset( $_POST[ 'fitcase_client_first_name' ] ) ) {
	    $fitcase_client_first_name = $_POST[ 'fitcase_client_first_name' ];
		update_post_meta( $post_id, 'fitcase_client_first_name', $fitcase_client_first_name );
	}

	if ( isset( $_POST[ 'fitcase_client_last_name' ] ) ) {
		$fitcase_client_last_name = $_POST[ 'fitcase_client_last_name' ];
		update_post_meta( $post_id, 'fitcase_client_last_name', $fitcase_client_last_name );
	}

//    if ( isset( $_POST[ 'fitcase_client_last_name' ] ) && isset( $_POST[ 'fitcase_client_first_name' ] ) ) {
//	    $firstname = $_POST[ 'fitcase_client_first_name' ];
//	    $lastname = $_POST[ 'fitcase_client_last_name' ];
//	    $fullname = $firstname . ' ' . $lastname;
//	    unset( $_POST[ 'fitcase_client_first_name' ] );
//	    unset( $_POST[ 'fitcase_client_last_name' ] );
//	    update_post_meta( $post_id, 'fitcase_client_name', $fullname );
//    }

	if ( isset( $_POST['fitcase_client_age'] ) ) {
	    $fitcase_client_age = $_POST['fitcase_client_age'];
	    update_post_meta( $post_id, 'fitcase_client_age', $fitcase_client_age );
    }

    if ( isset( $_POST['fitcase_client_sex'] ) ) {
	    $fitcase_client_sex = $_POST['fitcase_client_sex'];
	    update_post_meta( $post_id, 'fitcase_client_sex', $fitcase_client_sex );
    }

    if ( isset( $_POST['fitcase_client_goal'] ) ) {
	    $fitcase_client_goal = $_POST['fitcase_client_goal'];
	    update_post_meta( $post_id, 'fitcase_client_goal', $fitcase_client_goal );
    }

	if ( isset( $_POST['fitcase_client_history'] ) ) {
		$fitcase_client_history = $_POST[ 'fitcase_client_history' ];
		update_post_meta( $post_id, 'fitcase_client_history', $fitcase_client_history );
	}

	$_POST['fitcase_test_post_key'] = 'BLAH!!';
	$fitcase_test = $_POST['fitcase_test_post_key'];
	update_post_meta( $post_id, 'fitcase_test', $fitcase_test );

	error_log('$_POST Contents:' . print_r($_POST, true) );

}
add_action( 'save_post', 'fitcase_save_meta', 10, 3 );

function fitcase_add_post_title_slug( $data ) {
    if ( $data['post_type'] == 'fitcasestudy' ) {

        $title = 'Case Study';
        $permalink = $title;

	    if ( isset ( $_POST[ 'fitcase_client_first_name' ] ) ) {
		    $title .= ' - ' . $_POST['fitcase_client_first_name'];
		    $permalink = $_POST['fitcase_client_first_name'];
        }

	    if ( isset( $_POST['fitcase_client_last_name'] ) ) {
		    $title .= ' ' . strtoupper( substr( $_POST['fitcase_client_last_name'], 0, 1 ) );
		    $permalink .= ' ' . strtoupper( substr( $_POST['fitcase_client_last_name'], 0, 1 ) );
	    }

	   if ( isset( $_POST['fitcase_client_sex'] ) && $_POST['fitcase_client_sex'] != '' ) {
	        $title .= ' - ' . $_POST['fitcase_client_sex'];
	        $permalink .= ' ' . $_POST['fitcase_client_sex'];
       }

	    if ( isset( $_POST['fitcase_client_age'] ) ) {
		    $title .= ' Age ' . $_POST['fitcase_client_age'];
		    $permalink .= ' age ' . $_POST['fitcase_client_age'];
	    }
	    $data['post_title'] = $title;
	    $data['post_name'] = sanitize_title( $permalink );
    }

    error_log( '=== Filter $data ===');
    error_log( print_r($data, true) );
    return $data;
}
add_filter( 'wp_insert_post_data', 'fitcase_add_post_title_slug' );