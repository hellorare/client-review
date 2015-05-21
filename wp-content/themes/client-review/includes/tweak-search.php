<?php

// ==========================================================================
//
//  Search Tweaks
//
// ==========================================================================

// --------------------------------------------------------------------------
// Redirect /?s to /search/
// --------------------------------------------------------------------------

function sandpit_nice_search_redirect() {
	if (is_search() && strpos($_SERVER['REQUEST_URI'], '/wp-admin/') === false && strpos($_SERVER['REQUEST_URI'], '/search/') === false) {
	wp_redirect(home_url('/search/' . str_replace(array(' ', '%20'), array('+', '+'), urlencode(get_query_var('s')))), 301);
		 exit();
	}
}

add_action('template_redirect', 'sandpit_nice_search_redirect');

function sandpit_search_query($escaped = true) {
	$query = apply_filters('sandpit_search_query', get_query_var('s'));
	if ($escaped) {
		 $query = esc_attr($query);
	}
	return urldecode($query);
}

add_filter('get_search_query', 'sandpit_search_query');


// --------------------------------------------------------------------------
// Fix for empty search query
// --------------------------------------------------------------------------

function sandpit_request_filter($query_vars) {
	if (isset($_GET['s']) && empty($_GET['s'])) {
	$query_vars['s'] = " ";
	}
	return $query_vars;
}

add_filter('request', 'sandpit_request_filter');


// --------------------------------------------------------------------------
// Redirect search results if a single result is returned
// --------------------------------------------------------------------------

function single_result() {
	if (is_search()) {
		global $wp_query;
		if ($wp_query->post_count == 1) {
			wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
		}
	}
}

add_action('template_redirect', 'single_result');


// --------------------------------------------------------------------------
// If we go beyond the last page, force WordPress to return a 404.
// --------------------------------------------------------------------------

function paged_404_fix( ) {
	global $wp_query;

	if ( is_404() || !is_paged() || 0 != count( $wp_query->posts ) )
		return;

	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();

}

add_action( 'wp', 'paged_404_fix' );
