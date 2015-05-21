<?php

// --------------------------------------------------------------------------
//   Get Clients
// --------------------------------------------------------------------------

add_action( 'wp_ajax_review_get_clients', 'review_get_clients' );
add_action( 'wp_ajax_nopriv_review_get_clients', 'review_get_clients' );

function review_get_clients()
{

	if (isset($_GET['user_id']))
		$user_id = $_GET['user_id'];

	$clients = get_clients_by_user($user_id);

	// $clients[] = $_GET;

	echo json_encode(array_values($clients));

	die();

}


// --------------------------------------------------------------------------
//   Get Projects
// --------------------------------------------------------------------------

add_action( 'wp_ajax_review_get_projects', 'review_get_projects' );
add_action( 'wp_ajax_nopriv_review_get_projects', 'review_get_projects' );

function review_get_projects()
{

	// If we want projects by client

	if (isset($_GET['client_id'])) {

		$client = $_GET['client_id'];

		$projects = get_projects_by_clients($client);

	}

	// If we just get them all

	elseif (isset($_GET['user_id'])) {

		$user = $_GET['user_id'];

		$clients = get_clients_by_user($user);

		$client_ids = wp_list_pluck($clients, 'ID');

		$projects = get_projects_by_clients($client_ids);

	}

	echo json_encode(array_values($projects));

	die();

}

// --------------------------------------------------------------------------
//   Get Concepts
// --------------------------------------------------------------------------

add_action( 'wp_ajax_review_get_concepts', 'review_get_concepts' );
add_action( 'wp_ajax_nopriv_review_get_concepts', 'review_get_concepts' );

function review_get_concepts()
{

	$projects = explode(',', $_GET['projects']);

	$concepts = get_concepts_by_project($projects);

	// $concepts[] = $_GET;

	echo json_encode($concepts);

	die();

}
