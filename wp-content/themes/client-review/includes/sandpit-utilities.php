<?php

// ==========================================================================
//
//  Theme Utilities
//    Universal functions and variables
//
// ==========================================================================

// --------------------------------------------------------------------------
//   Check if variable is set and return it, else return false
// --------------------------------------------------------------------------

function issetor(&$var, $default = false) {
	return isset($var) ? $var : $default;
}


// --------------------------------------------------------------------------
//   Check if an element has content, else return false
// --------------------------------------------------------------------------

function is_element_empty($element) {
	$element = trim($element);
	return empty($element) ? false : true;
}


// --------------------------------------------------------------------------
//   List hooked functions
// --------------------------------------------------------------------------

function list_hooked_functions( $tag=false ) {
	global $wp_filter;
	if ( $tag ) {
		$hook[$tag]=$wp_filter[$tag];
		if ( !is_array( $hook[$tag] ) ) {
			trigger_error( "Nothing found for '$tag' hook", E_USER_WARNING );
			return;
		}
	}
	else {
		$hook=$wp_filter;
		ksort( $hook );
	}
	echo '<pre>';
	foreach ( $hook as $tag => $priority ) {
		echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";
		ksort( $priority );
		foreach ( $priority as $priority => $function ) {
			echo $priority;
			foreach ( $function as $name => $properties ) echo "\t$name<br />";
		}
	}
	echo '</pre>';
	return;
}


// --------------------------------------------------------------------------
//   Functions for leading slashes
// --------------------------------------------------------------------------

function leadingslashit( $string ) {
	return '/' . unleadingslashit( $string );
}

function unleadingslashit( $string ) {
	return ltrim( $string, '/' );
}
