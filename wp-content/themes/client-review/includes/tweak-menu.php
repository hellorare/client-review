<?php

// ==========================================================================
//
//  Menu Tweaks
//
// ==========================================================================

// --------------------------------------------------------------------------
// Custom walker for cleaner nav menu
// --------------------------------------------------------------------------

add_filter('nav_menu_item_id', '__return_null');

/**
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 */

function sandpit_nav_menu_css_class($classes, $item) {
	$slug = sanitize_title($item->title);
	$classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
	$classes = preg_replace('/((menu|page)[-_\w+]+)+/', '', $classes);

	$classes[] = 'menu-item-' . $slug;

	$classes = array_unique($classes);

	return array_filter($classes, 'is_element_empty');
}

add_filter('nav_menu_css_class', 'sandpit_nav_menu_css_class', 10, 2);
