<?php

// --------------------------------------------------------------------------
//   Get Projects by Campaign
// --------------------------------------------------------------------------

function get_projects_by_clients($client = NULL)
{

	if (is_numeric($client)) {
		$clients[] = $client;
	} else {
		$clients = $client;
	}

	$taxonomies = array('project');

	$args = array(
		'get' => 'all'
	);

	$projects = get_terms( $taxonomies, $args );

	if (!isset($client))
		return $projects;

	foreach ($projects as $key => &$project) {

		if (isset($clients) && !in_array(get_field('client', 'project_' . $project->term_id), $clients)) {

			unset($projects[$key]);

		}
	}

	return $projects;

}
