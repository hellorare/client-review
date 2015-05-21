<?php

// --------------------------------------------------------------------------
//   Concept Model
// --------------------------------------------------------------------------

function cr_concept_model()
{

	$labels = array(
		'name'                => 'Concepts',
		'singular_name'       => 'Concept',
		'menu_name'           => 'Concepts',
		'parent_item_colon'   => 'Parent Concept:',
		'all_items'           => 'All Concepts',
		'view_item'           => 'View Concept',
		'add_new_item'        => 'Add New Concept',
		'add_new'             => 'Add Concept',
		'edit_item'           => 'Edit Concept',
		'update_item'         => 'Update Concept',
		'search_items'        => 'Search Concepts',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => '%project%',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'concept',
		'description'         => 'Concepts are artwork',
		'labels'              => $labels,
		'supports'            => array( 'title', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-images-alt2',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'concept', $args );

}

add_action( 'init', 'cr_concept_model', 0 );


// --------------------------------------------------------------------------
//   Permalink Structure
// --------------------------------------------------------------------------

add_filter('post_type_link', 'cr_projects_permalink_structure', 10, 4);

function cr_projects_permalink_structure($post_link, $post, $leavename, $sample)
{

	if ( false !== strpos( $post_link, '%project%' ) ) {

		$project_terms = get_the_terms( $post->ID, 'project' );

		$project_term = array_pop( $project_terms );

		$post_link = str_replace( '%project%', $project_term->slug, $post_link );

	}

	return $post_link;

}
