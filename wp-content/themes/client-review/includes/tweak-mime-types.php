<?php

add_filter('upload_mimes', 'sandpit_modify_mime_types');
	function sandpit_modify_mime_types($existing_mimes){
	$existing_mimes['swf'] = 'text/swf';
	return $existing_mimes;
}
