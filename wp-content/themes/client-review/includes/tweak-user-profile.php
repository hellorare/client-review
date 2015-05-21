<?php

// --------------------------------------------------------------------------
//   Remove color options
// --------------------------------------------------------------------------
add_action('admin_head', 'cr_remove_profile_color');

function cr_remove_profile_color() {
	global $_wp_admin_css_colors;
	$_wp_admin_css_colors = 0;
}


add_action( 'init', 'cr_remove_profile_options_setup' );

function cr_remove_profile_options_setup() {

	if (current_user_can('manage_options')) {
		return;
	}

	foreach( array('profile','user-edit') as $hook )
		add_action( "admin_footer-$hook.php", 'cr_remove_profile_options' );
}

function cr_remove_profile_options() {
	?>
	<script>
		jQuery(document).ready(function ($) {

			$("#email").prop('disabled', true);

			$('#url, #description, #nickname').parent().parent().hide(0);

			$('#rich_editing').parent().parent().parent().parent().hide(0);

			$("h3:contains('Personal Options')").hide(0);

		});
	</script>
	<?php
}
