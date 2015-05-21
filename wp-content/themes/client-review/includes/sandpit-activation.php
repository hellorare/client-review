<?php

// ==========================================================================
//
//  Theme Activation
//    Activation scripts and theme plugin dependancy checking
//
// ==========================================================================


function sandpit_first_run_options() {

	// --------------------------------------------------------------------------
	// Check if theme has been activated before
	// --------------------------------------------------------------------------

	$check = get_option('sandpit_activation_check');

	if ( $check != "set" ) {

		// --------------------------------------------------------------------------
		// Add Home Page
		// --------------------------------------------------------------------------

		$default_pages = array('Home', 'About', 'Contact');
		$existing_pages = get_pages();
		$temp = array();

		foreach ($existing_pages as $page) {
			$temp[] = $page->post_title;
		}

		$pages_to_create = array_diff($default_pages, $temp);

		foreach ($pages_to_create as $new_page_title) {

			$add_default_pages = array(
				'post_title' => $new_page_title,
				'post_content' => '',
				'post_status' => 'publish',
				'post_type' => 'page'
			);

			$result = wp_insert_post($add_default_pages);
		}

		$home = get_page_by_title('Home');

		update_option('show_on_front', 'page');
		update_option('page_on_front', $home->ID);

		$home_menu_order = array(
			'ID' => $home->ID,
			'menu_order' => -1
		);

		wp_update_post($home_menu_order);


		// --------------------------------------------------------------------------
		// Create Nav Menu
		// --------------------------------------------------------------------------

		if (!has_nav_menu('main')) {
			$primary_nav_id = wp_create_nav_menu('Main', array('slug' => 'main'));
			$sandpit_nav_theme_mod['main'] = $primary_nav_id;
		}

		if ($sandpit_nav_theme_mod) {
			set_theme_mod('nav_menu_locations', $sandpit_nav_theme_mod);
		}

		// --------------------------------------------------------------------------
		// Update options
		// --------------------------------------------------------------------------

		update_option( 'rss_use_excerpt', 1 );
		update_option( 'posts_per_page', 8 );
		update_option( 'timezone_string', 'Australia/Perth' );
		update_option( 'default_post_edit_rows' , 25 );
		update_option( 'upload_path', 'assets' );
		update_option( 'uploads_use_yearmonth_folders', 0);
		update_option( 'blogdescription', '' );
		update_option( 'comments_notify' , 0);
		update_option( 'default_comment_status' , 'closed');


		// --------------------------------------------------------------------------
		// Change Permalink Structure
		// --------------------------------------------------------------------------

		if (get_option('permalink_structure') !== '/%year%/%monthnum%/%postname%/') {
			update_option('permalink_structure', '/%year%/%monthnum%/%postname%/');
		}

		global $wp_rewrite;
		$wp_rewrite->init();
		$wp_rewrite->flush_rules(); // Flush rules
		$wp_rewrite->flush_rules(); // Flush rules

		// --------------------------------------------------------------------------
		// Set Theme Activated
		// --------------------------------------------------------------------------

		add_option('sandpit_activation_check', "set");
	}
}

add_action('after_switch_theme', 'sandpit_first_run_options');
