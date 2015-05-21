<?php

// --------------------------------------------------------------------------
// Custom Body Classes
// --------------------------------------------------------------------------

function custom_body_classes( $classes, $class ) {

	if(!is_front_page() )
		$classes[] = 'not-home';

	global $post;

	if (!is_home() && $post) {
		$classes[] = $post->post_name;
	}

	return $classes;
}

add_filter( 'body_class', 'custom_body_classes', 10, 2 );
