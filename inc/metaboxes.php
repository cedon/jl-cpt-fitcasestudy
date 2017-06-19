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
	        'fitcase-client-plan',
            __( 'Client Plan', 'fitcasestudy' ),
            'meta_box_client_plan_callback',
            'fitcasestudy',
            'normal',
            'high'
    );

	add_meta_box(
		'fitcase-client-results',
		__( 'Client Results', 'fitcasestudy' ),
		'meta_box_client_results_callback',
		'fitcasestudy',
		'normal',
		'high'
	);

	add_meta_box(
		'fitcase-study-client-pics',
		__( 'Client Progress Photos', 'fitcasestudy' ),
		'meta_box_client_pics_callback',
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
?>
	<p>
        <label for="fitcase_client_first_name"><?php _e( 'First Name', 'fitcasestudy' ); ?></label>
        <input type="text" name="fitcase_client_first_name" id="fitcase_client_first_name" size="25" value="<?php if ( isset( $fitcase_post_meta['fitcase_client_first_name'] ) ) echo $fitcase_post_meta['fitcase_client_first_name'][0]; ?>" />

        <label for="fitcase_client_first_name"><?php _e( 'Last Name', 'fitcasestudy' ); ?></label>
        <input type="text" name="fitcase_client_last_name" id="fitcase_client_last_name" size="25" value="<?php if ( isset( $fitcase_post_meta['fitcase_client_last_name'] ) ) echo $fitcase_post_meta['fitcase_client_last_name'][0]; ?>" />
    </p>

	<p>
        <?php
            if ( ! isset( $fitcase_post_meta['fitcase_client_sex'] ) ) {
	            $fitcase_post_meta['fitcase_client_sex'][0] = '';
            }
        ?>

        <label for="fitcase_client_sex"><?php _e( 'Sex', 'fitcasestudy' ); ?></label>
        <select id="fitcase_client_sex" name="fitcase_client_sex">
            <option value=""></option>
            <option value="Male" <?php selected( $fitcase_post_meta['fitcase_client_sex'][0], 'Male' ) ; ?>>Male</option>
            <option value="Female" <?php selected( $fitcase_post_meta['fitcase_client_sex'][0], 'Female' ) ; ?>>Female</option>
            <option value="Other" <?php selected( $fitcase_post_meta['fitcase_client_sex'][0], 'Other' ) ; ?>>Other</option>
        </select>

		<label for="fitcase_client_age"><?php _e( 'Age', 'fitcasestudy' ); ?></label>
		<input type="text" name="fitcase_client_age" id="fitcase_client_age" value="<?php if ( isset( $fitcase_post_meta['fitcase_client_age'] ) ) echo $fitcase_post_meta['fitcase_client_age'][0];  ?>" size="3" maxlength="3" />

	</p>

	<p>
        <?php _e( 'Height', 'fitcasestudy' ); ?>

        <?php
            $fitcase_height = $fitcase_feet = $fitcase_inches = $fitcase_cm = '';
            if ( isset( $fitcase_post_meta['fitcase_client_height'] ) ) {
                error_log( print_r ($fitcase_post_meta['fitcase_client_height'], true) );
                $fitcase_height = $fitcase_post_meta['fitcase_client_height'][0];
	            preg_match_all( '/[^A-Za-z\s]+/', $fitcase_height, $fitcase_matches_results );

                reset( $fitcase_matches_results );
                $fitcase_matches = current( $fitcase_matches_results );
                error_log( '[ARRAY] $fitcase_matches_results' . PHP_EOL . print_r( $fitcase_matches_results, true ) );
                $fitcase_feet = $fitcase_cm = $fitcase_matches[0];

                if ( isset( $fitcase_matches[1] )) {
	                $fitcase_inches = $fitcase_matches[1];
                }
            }

            if ( get_option( 'fitcase_toggle_measure_unit' ) == 'imperial' or strpos( $fitcase_height, 'ft' ) ) { ?>
	            <input type="hidden" name="fitcase_height_unit" id="fitcase_height_unit" aria-hidden="true" value="imperial">
	            <input type="text" name="fitcase_client_height_ft" id="fitcase_client_height_ft" maxlength="2" size="3" value="<?php echo $fitcase_feet; ?>" />
                <label for="fitcase_client_height_ft">ft </label>
                <input type="text" name="fitcase_client_height_in" id="fitcase_client_height_in" maxlength="2" size="3" value="<?php echo $fitcase_inches; ?>" />
                <label for="fitcase_client_height_in">in</label>

            <?php } else { ?>
                <input type="hidden" name="fitcase_height_unit" id="fitcase_height_unit" aria-hidden="true" value="metric">
                <input type="text" name="fitcase_client_height_cm" id="fitcase_client_height_cm" maxlength="3" size="3" value="<?php echo $fitcase_cm; ?>" />
                <label for="fitcase_client_height_in">cm </label>
            <?php }

        ?>

        <?php _e( 'Initial Weight', 'fitcasestudy' ); ?>

        <?php
            $fitcase_weight = $fitcase_kg = '';
            if ( isset( $fitcase_post_meta['fitcase_client_initial_weight'] ) ) {
                $fitcase_weight = $fitcase_post_meta['fitcase_client_initial_weight'][0];

	            preg_match_all( '/[^A-Za-z\s]+/', $fitcase_weight, $fitcase_matches_results );

	            // Unnest array generated by preg_match_all()
	            reset( $fitcase_matches_results );
	            $fitcase_matches = current( $fitcase_matches_results );

	            $fitcase_kg = $fitcase_matches[0];
            }

            if ( get_option( 'fitcase_toggle_measure_unit' ) == 'imperial' or strpos( $fitcase_weight, 'lb' ) ) { ?>
                <?php $_POST['fitcase_weight_unit'] = 'imperial'; ?>
                <input type="hidden" name="fitcase_client_initial_weight_unit" id="fitcase_weight_unit" aria-hidden="true" value="imperial">
                <input type="text" name="fitcase_client_initial_weight_lb" id="fitcase_client_initial_weight_lb" maxlength="3" size="3" value="<?php echo $fitcase_kg ?>" />
                <label for="fitcase_client_initial_weight_lb">pounds </label>
            <?php } else { ?>
	            <?php $_POST['fitcase_weight_unit'] = 'metric'; ?>
                <input type="hidden" name="fitcase_weight_unit" id="fitcase_weight_unit" aria-hidden="true" value="metric">
                <input type="text" name="fitcase_client_initial_weight_kg" id="fitcase_client_initial_weight_kg" maxlength="3" size="3" value="<?php echo $fitcase_kg ?>" />
                <label for="fitcase_client_initial_weight_kg">kg </label>
            <?php }

        ?>

        <?php _e( 'Initial Body Fat', 'fitcasestudy' ); ?>

        <?php

            $fitcase_initial_bodyfat = '';
            if ( isset( $fitcase_post_meta['fitcase_client_initial_bodyfat'] ) ) {
                $fitcase_initial_bodyfat = $fitcase_post_meta['fitcase_client_initial_bodyfat'][0];
            }
        ?>

        <input type="text" name="fitcase_client_initial_bodyfat" id="fitcase_client_initial_bodyfat" maxlength="2" size="2" value="<?php echo $fitcase_initial_bodyfat; ?>" />
        <label for="fitcase_client_initial_bodyfat">%</label>

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
}

function meta_box_clienthist_callback( $post ) {
	global $fitcase_post_meta;

	$editor_id = 'fitcase_client_history';
	$fitcase_client_history_content = '';

	if ( isset( $fitcase_post_meta['fitcase_client_history'] ) ) {
		$fitcase_client_history_content = $fitcase_post_meta['fitcase_client_history'][0];
    }

	if ( $fitcase_client_history_content != '' ) {
		$editor_content = $fitcase_client_history_content;
	} else {
		$editor_content = '';
	}
	?>
	<p>Enter in the history of the client.</p>

	<?php
	$editor_settings = array(
		'textarea_rows' => 5,
	);
	wp_editor( $editor_content, $editor_id, $editor_settings );
}

function meta_box_client_plan_callback ( $post ) {
	global $fitcase_post_meta;

	$editor_id = 'fitcase_client_plan';
	$fitcase_client_plan_content = '';

	if( isset( $fitcase_post_meta['fitcase_client_plan'] ) ) {
		$fitcase_client_plan_content = $fitcase_post_meta['fitcase_client_plan'][0];
    }

    if ( $fitcase_client_plan_content != '' ) {
	    $editor_content = $fitcase_client_plan_content;
	} else {
	    $editor_content = '';
    }

    $editor_settings = array(
		'media_buttons' => false,
        'textarea_rows' => 5,
	);

	wp_editor( $editor_content, $editor_id, $editor_settings );
}

function meta_box_client_results_callback( $post ) {
	global $fitcase_post_meta;

	$editor_id = 'fitcase_client_results';
	$fitcase_client_results_content = '';

	if ( isset( $fitcase_post_meta['fitcase_client_results'] ) ) {
	    $fitcase_client_results_content = $fitcase_post_meta['fitcase_client_results'][0];
    }

	if ( $fitcase_client_results_content != '' ) {
		$editor_content = $fitcase_client_results_content;
    } else {
	    $editor_content = '';
    }

    $fitcase_weight = $fitcase_kg = '';
    if ( isset( $fitcase_post_meta['fitcase_client_current_weight'] ) ) {
    $fitcase_weight = $fitcase_post_meta['fitcase_client_current_weight'][0];

    preg_match_all( '/[^A-Za-z\s]+/', $fitcase_weight, $fitcase_matches_results );

    // Unnest array generated by preg_match_all()
    reset( $fitcase_matches_results );
    $fitcase_matches = current( $fitcase_matches_results );

    $fitcase_kg = $fitcase_matches[0];
    } ?>

	<?php _e( 'Current Weight &amp; Body Fat', 'fitcasestudy' ); ?>
    <p>
	<?php if ( get_option( 'fitcase_toggle_measure_unit' ) == 'imperial' or strpos( $fitcase_weight, 'lb' ) ) { ?>
		<?php $_POST['fitcase_weight_unit'] = 'imperial'; ?>
        <input type="text" name="fitcase_client_initial_weight_lb" id="fitcase_client_initial_weight_lb" maxlength="3" size="3" value="<?php echo $fitcase_kg ?>" />
        <label for="fitcase_client_current_weight_lb">pounds </label>
	<?php } else { ?>
		<?php $_POST['fitcase_weight_unit'] = 'metric'; ?>
        <input type="text" name="fitcase_client_current_weight_kg" id="fitcase_client_current_weight_kg" maxlength="3" size="3" value="<?php echo $fitcase_kg ?>" />
        <label for="fitcase_client_current_weight_kg">kg </label>
	<?php }

	$fitcase_current_bodyfat = '';
	if ( isset( $fitcase_post_meta['fitcase_client_current_bodyfat'] ) ) {
		$fitcase_current_bodyfat = $fitcase_post_meta['fitcase_client_current_bodyfat'][0];
	}
	?>

        <input type="text" name="fitcase_client_current_bodyfat" id="fitcase_client_current_bodyfat" maxlength="2" size="2" value="<?php echo $fitcase_current_bodyfat; ?>" />
        <label for="fitcase_client_current_bodyfat">%</label>
    </p>
	<?php
	$editor_settings = array(
		'textarea_rows' => 5,
	);
	wp_editor( $editor_content, $editor_id, $editor_settings );
}

function meta_box_client_pics_callback( $post ) {
	global $fitcase_post_meta;
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

	if ( isset( $_POST['fitcase_client_age'] ) ) {
	    $fitcase_client_age = $_POST['fitcase_client_age'];
	    update_post_meta( $post_id, 'fitcase_client_age', $fitcase_client_age );
    }

    if ( isset( $_POST['fitcase_client_sex'] ) ) {
	    $fitcase_client_sex = $_POST['fitcase_client_sex'];
	    update_post_meta( $post_id, 'fitcase_client_sex', $fitcase_client_sex );
    }

    if ( isset( $_POST['fitcase_height_unit'] ) ) {
	    $fitcase_client_height_unit = $_POST['fitcase_height_unit'];
        if ( $fitcase_client_height_unit == 'imperial' ) {
            $fitcase_hght_ft = $_POST['fitcase_client_height_ft'];
            $fitcase_hght_in = $_POST['fitcase_client_height_in'];
            $fitcase_client_height = $fitcase_hght_ft . 'ft ' . $fitcase_hght_in . 'in';
        } elseif ($fitcase_client_height_unit == 'metric' ){
            $fitcase_hght_cm = $_POST['fitcase_client_height_cm'];
            $fitcase_client_height = $fitcase_hght_cm . 'cm';
        } else {
            wp_die( 'Invalid Unit for Client Height' );
        }
	    update_post_meta( $post_id, 'fitcase_client_height', $fitcase_client_height );
    }

    if ( isset( $_POST['fitcase_weight_unit'] ) ) {
	    $fitcase_client_initial_weight_unit = $_POST['fitcase_weight_unit'];
	    if ( $fitcase_client_initial_weight_unit == 'imperial' ) {
            $fitcase_client_initial_weight = $_POST['fitcase_client_initial_weight_lb'] . ' pounds';
	    } elseif ( $fitcase_client_initial_weight_unit == 'metric') {
		    $fitcase_client_initial_weight = $_POST['fitcase_client_initial_weight_kg'] . ' kg';
        } else {
		    wp_die( 'Invalid Unit for Client Weight' );
        }
        update_post_meta( $post_id, 'fitcase_client_initial_weight', $fitcase_client_initial_weight );
    } else {
	    wp_die( 'No Weight' );
    }

    if ( isset( $_POST['fitcase_client_initial_bodyfat'] ) ) {
        $fitcase_client_initial_bodyfat = $_POST['fitcase_client_initial_bodyfat'];
        update_post_meta( $post_id, 'fitcase_client_initial_bodyfat', $fitcase_client_initial_bodyfat );
    }

    if ( isset( $_POST['fitcase_client_goal'] ) ) {
	    $fitcase_client_goal = $_POST['fitcase_client_goal'];
	    update_post_meta( $post_id, 'fitcase_client_goal', $fitcase_client_goal );
    }

	if ( isset( $_POST['fitcase_client_history'] ) ) {
		$fitcase_client_history = $_POST[ 'fitcase_client_history' ];
		update_post_meta( $post_id, 'fitcase_client_history', $fitcase_client_history );
	}

	if ( isset( $_POST['fitcase_client_plan'] ) ) {
	    $fitcase_client_plan = $_POST['fitcase_client_plan'];
	    update_post_meta( $post_id, 'fitcase_client_plan', $fitcase_client_plan );
    }

	if ( isset( $_POST['fitcase_weight_unit'] ) ) {
		$fitcase_client_current_weight_unit = $_POST['fitcase_weight_unit'];
		if ( $fitcase_client_current_weight_unit == 'imperial' ) {
			$fitcase_client_current_weight = $_POST['fitcase_client_current_weight_lb'] . ' pounds';
		} elseif ( $fitcase_client_current_weight_unit == 'metric') {
			$fitcase_client_current_weight = $_POST['fitcase_client_current_weight_kg'] . ' kg';
		} else {
			wp_die( 'Invalid Unit for Client Weight' );
		}
		update_post_meta( $post_id, 'fitcase_client_current_weight', $fitcase_client_current_weight );
	} else {
		wp_die( 'No Weight' );
	}

	if ( isset( $_POST['fitcase_client_current_bodyfat'] ) ) {
		$fitcase_client_current_bodyfat = $_POST['fitcase_client_current_bodyfat'];
		update_post_meta( $post_id, 'fitcase_client_current_bodyfat', $fitcase_client_current_bodyfat );
	}

	if ( isset( $_POST['fitcase_client_results'] ) ) {
		$fitcase_client_results = $_POST['fitcase_client_results'];
		update_post_meta( $post_id, 'fitcase_client_results', $fitcase_client_results );
	}

//	$_POST['fitcase_test_post_key'] = 'BLAH!!';
//	$fitcase_test = $_POST['fitcase_test_post_key'];
//	update_post_meta( $post_id, 'fitcase_test', $fitcase_test );

	error_log('[ARRAY] $_POST Contents:' . print_r($_POST, true) );

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