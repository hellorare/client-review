<?php

// ==========================================================================
//
//  Theme Enqueue
//    Scripts and Styles enqueue
//
// ==========================================================================


// --------------------------------------------------------------------------
// Enqueue Scripts
// --------------------------------------------------------------------------

function sandpit_enqueue_scripts() {

	// Deregister local scripts

	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'comment-reply' );

	// Register Scripts

	wp_register_script( 'sandpit-angular-app', get_bloginfo('template_url') . '/js/app.js', 'sandpit-plugin-set', '', true );

	// Queue Scripts

	wp_localize_script( 'sandpit-angular-app', 'info', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'user_id' => get_current_user_id(),
		'current_id' => get_the_id(),
		'concept_type' => get_field('concept_type')
	));

	wp_enqueue_script( 'jquery', get_bloginfo('template_url') . '/js/plugins.js', '', '', false );
	wp_enqueue_script( 'sandpit-scripts', get_bloginfo('template_url') . '/js/script.js', 'jquery', '', true );
	wp_enqueue_script( 'sandpit-angular-app' );


}

if ( !is_admin()) add_action('wp_enqueue_scripts', 'sandpit_enqueue_scripts', 0 );
