<?php

add_action( 'admin_head-edit-tags.php', 'cr_campaign_remove_parent_field' );

function cr_campaign_remove_parent_field()
{

		if ( !in_array($_GET['taxonomy'], array('project')) )
				return;

		$parent = 'parent()';

		if ( isset( $_GET['action'] ) )
				$parent = 'parent().parent()';

		?>
				<script type="text/javascript">
						jQuery(document).ready(function($)
						{
								$('label[for=parent]').<?php echo $parent; ?>.remove();
								$('label[for=tag-slug]').<?php echo $parent; ?>.remove();
						});
				</script>
		<?php
}
