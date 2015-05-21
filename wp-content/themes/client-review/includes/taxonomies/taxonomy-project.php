<?php

// --------------------------------------------------------------------------
//   Project Taxonomy
// --------------------------------------------------------------------------

function cr_add_project_taxonomy() {

	$labels = array(
		'name'                       => 'Project',
		'singular_name'              => 'Project',
		'menu_name'                  => 'Projects',
		'all_items'                  => 'All Projects',
		'parent_item'                => 'Parent Project',
		'parent_item_colon'          => 'Parent Project:',
		'new_item_name'              => 'New Item Project',
		'add_new_item'               => 'Add New Project',
		'edit_item'                  => 'Edit Project',
		'update_item'                => 'Update Project',
		'separate_items_with_commas' => 'Separate projects with commas',
		'search_items'               => 'Search Projects',
		'add_or_remove_items'        => 'Add or remove Projects',
		'choose_from_most_used'      => 'Choose from the most used projects',
		'not_found'                  => 'Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'project', array( 'concept' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'cr_add_project_taxonomy', 0 );
