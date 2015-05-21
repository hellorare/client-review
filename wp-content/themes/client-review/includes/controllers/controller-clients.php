<?php

// --------------------------------------------------------------------------
//   Get Clients by User
// --------------------------------------------------------------------------

function get_clients_by_user($user)
{

	if ($user != '1') {

		$clients = get_field('client', 'user_' . $user);

	} else {

		$args = array(
			'post_type' => 'client',
		);

		$clients = get_posts( $args );

	}

	return $clients;

}
