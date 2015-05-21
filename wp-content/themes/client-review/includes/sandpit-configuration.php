<?php

// ==========================================================================
//
//  Theme Configuration
//    General theme hooks and filters
//
// ==========================================================================


// --------------------------------------------------------------------------
// Add theme support
// --------------------------------------------------------------------------

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'nav-menus' );
add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'caption', 'gallery') );


// --------------------------------------------------------------------------
// Image sizes
// --------------------------------------------------------------------------

add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );

set_post_thumbnail_size( 150, 150, true );
add_image_size( 'hero', 1920, 900, true );
add_image_size( 'banner', 650, 300, true );
add_image_size( 'large-banner', 960, 400, true );
add_image_size( 'single-post-thumbnail', 200, 200, true );


update_option('large_size_w', 650);
update_option('large_size_h', 650);
update_option('large_crop', 1);


update_option('medium_size_w', 350);
update_option('medium_size_h', 350);
update_option('medium_crop', 1);


// --------------------------------------------------------------------------
// Media uploader image sizes
// --------------------------------------------------------------------------

update_option('image_default_align', 'none' );
update_option('image_default_link_type', 'none' );
update_option('image_default_size', 'large' );


function sandpit_add_custom_image_sizes( $imageSizes ) {

	$my_sizes = array(
		'hero'                  => 'Hero',
		'banner'                => 'Banner',
		'large-banner'          => 'Large Banner',
		'single-post-thumbnail' => 'Single Post Thumbnail'
	);

	return array_merge( $imageSizes, $my_sizes );

}

add_filter( 'image_size_names_choose', 'sandpit_add_custom_image_sizes' );


// --------------------------------------------------------------------------
// Add primary navigation
// --------------------------------------------------------------------------

register_nav_menus( array(
	'primary' => __( 'Primary Navigation' ),
) );


// --------------------------------------------------------------------------
// Add theme sidebars
// --------------------------------------------------------------------------

register_sidebar(array(
	'name'          => __( 'Primary Widget Area' ),
	'id'            => 'primary-widget-area',
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section>',
	'before_title'  => '<h4 class="widget-title">',
	'after_title'   => '</h4>',
));


// --------------------------------------------------------------------------
// Remove Dashboard Widgets
// --------------------------------------------------------------------------

function sandpit_remove_dashboard_widgets() {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
	remove_meta_box('dashboard_secondary', 'dashboard', 'side');
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
}

add_action('wp_dashboard_setup', 'sandpit_remove_dashboard_widgets');


// --------------------------------------------------------------------------
// Remove Sidebar Widgets
// --------------------------------------------------------------------------

function sandpit_deregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}

add_action('widgets_init', 'sandpit_deregister_default_wp_widgets', 1);


// --------------------------------------------------------------------------
// Admin Menu
// --------------------------------------------------------------------------

function sandpit_admin_menu() {
	 remove_menu_page('link-manager.php');
}

add_action( 'admin_menu', 'sandpit_admin_menu' );


// --------------------------------------------------------------------------
// Clean Head
// --------------------------------------------------------------------------

// Remove links to the extra feeds (e.g. category feeds)
remove_action( 'wp_head', 'feed_links_extra', 3 );
// Remove links to the general feeds (e.g. posts and comments)
remove_action( 'wp_head', 'feed_links', 2 );
// Remove link to the RSD service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link' );
// Remove link to the Windows Live Writer manifest file
remove_action( 'wp_head', 'wlwmanifest_link' );
// Remove cononical link
remove_action( 'wp_head', 'rel_canonical' );
// Remove index link
remove_action( 'wp_head', 'index_rel_link' );
// Remove prev link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// Remove start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// Remove relational links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// Remove XHTML generator showing WP version
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);

// Remove locale stylesheet
remove_action( 'wp_head', 'locale_stylesheet', 10 );

// Remove admin bar styles
function sandpit_remove_admin_header_includes() {
	remove_action( 'wp_head', '_admin_bar_bump_cb');
	remove_action( 'wp_head', 'wp_admin_bar_header' );
}
add_action('get_header', 'sandpit_remove_admin_header_includes');


// --------------------------------------------------------------------------
// Vanity rewrite rules
// --------------------------------------------------------------------------

add_action('generate_rewrite_rules', 'sandpit_add_rewrites');

function sandpit_add_rewrites($content) {
	$stylesheetdirectory = explode('/themes/', get_stylesheet_directory());
	$theme_name = next($stylesheetdirectory);
	global $wp_rewrite;
	$sandpit_new_non_wp_rules = array(
		'style.css'    => 'wp-content/themes/'. $theme_name . '/style.css',
		'js/(.*)'      => 'wp-content/themes/'. $theme_name . '/js/$1',
		'images/(.*)'  => 'wp-content/themes/'. $theme_name . '/images/$1',
		'fonts/(.*)'   => 'wp-content/themes/'. $theme_name . '/fonts/$1',
		'favicon.ico'  => 'wp-content/themes/'. $theme_name . '/images/favicon.ico',
		'humans.txt'   => 'wp-content/themes/'. $theme_name . '/humans.txt'
	);
	$wp_rewrite->non_wp_rules += $sandpit_new_non_wp_rules;

}

function sandpit_clean_assets($content) {
	$theme_dir = explode('/themes/', $content);
	$theme_name = next($theme_dir);
	$current_path = '/wp-content/themes/' . $theme_name;
	$new_path = '';
	$content = str_replace($current_path, $new_path, $content);
	return $content;
}

add_filter('bloginfo', 'sandpit_clean_assets');
add_filter('stylesheet_directory_uri', 'sandpit_clean_assets');
add_filter('template_directory_uri', 'sandpit_clean_assets');
