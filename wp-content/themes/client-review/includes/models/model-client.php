<?php

// --------------------------------------------------------------------------
//   Client Model
// --------------------------------------------------------------------------

function cr_client_model()
{

	$labels = array(
		'name'                => 'Clients',
		'singular_name'       => 'Client',
		'menu_name'           => 'Clients',
		'parent_item_colon'   => 'Parent Client:',
		'all_items'           => 'All Clients',
		'view_item'           => 'View Client',
		'add_new_item'        => 'Add New Client',
		'add_new'             => 'Add Client',
		'edit_item'           => 'Edit Client',
		'update_item'         => 'Update Client',
		'search_items'        => 'Search Clients',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => '',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'client',
		'description'         => 'Clients are collectives of client users',
		'labels'              => $labels,
		'supports'            => array( 'title', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'client', $args );

}

add_action( 'init', 'cr_client_model', 0 );
