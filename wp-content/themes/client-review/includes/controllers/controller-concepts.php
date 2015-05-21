<?php

// --------------------------------------------------------------------------
//   Get Concepts by Project
// --------------------------------------------------------------------------

function get_concepts_by_project($project)
{

	if (is_numeric($project)) {
		$projects[] = $project;
	} else {
		$projects = $project;
	}

	$args = array(
		'post_type' => 'concept',
		'posts_per_page' => -1
	);

	$args['tax_query'][] = array(
				'taxonomy' => 'project',
				'field' => 'id',
				'terms' => $projects
			);

	$concepts = get_posts( $args );

	foreach ($concepts as $key => &$concept) {
		$concept->permalink = get_permalink( $concept->ID );
		$concept->concept_type = get_field('concept_type', $concept->ID);
		$concept->thumbnail = get_field('thumbnail', $concept->ID);
	}

	return $concepts;
}
