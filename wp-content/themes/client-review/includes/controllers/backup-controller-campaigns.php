<?php

// --------------------------------------------------------------------------
//   Get Campaigns by Clients
// --------------------------------------------------------------------------

function get_campaigns_by_clients($client)
{

	if (is_numeric($client)) {
		$clients[] = $client;
	} else {
		$clients = $client;
	}

	$taxonomies = array('campaign');

	$args = array(
		'get' => 'all'
	);

	$campaigns = get_terms( $taxonomies, $args );

	// Return all if client not set

	if (!isset($client))
		return $campaigns;


	foreach ($campaigns as $key => &$campaign) {

		if (!in_array(get_field('client', 'campaign_' . $campaign->term_id), $clients)) {
			unset($campaigns[$key]);
		}
	}

	return $campaigns;

}
