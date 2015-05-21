<?php


add_action( 'wp_ajax_review_get_revisions', 'review_get_revisions' );
add_action( 'wp_ajax_nopriv_review_get_revisions', 'review_get_revisions' );

function review_get_revisions()
{

	$conceptType = get_field('concept_type', $_GET['current_id']);

	$knownTypes = array(
		'copy',
		'image',
		'flash',
		'video',
		'pdf',
		'storyboard'
	);

	if (in_array($conceptType, $knownTypes)) {

		$revisions = get_field($conceptType, $_GET['current_id']);

		echo json_encode($revisions);

	} else {

		echo 'Concept type not recognised';

	}

	die();

}
