<?php

function review_can_user_view()
{
	global $current_user;
	global $post;

	if ($current_user->ID == 1)
		return true;

	$project = get_field('project', $post);

	$client = get_field('client', 'project_' . $project);

	$user_clients = get_field('client', 'user_' . $current_user->ID);

	if (!is_array($user_clients))
		$user_clients = array($user_clients);

	$user_clients = wp_list_pluck($user_clients, 'ID');

	if (in_array($client, $user_clients))
		return true;

}
