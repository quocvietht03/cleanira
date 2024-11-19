<article <?php post_class('bt-post'); ?>>
	<div class="bt-post--featured-wrap">
	
	</div>
	<div class="bt-post--infor">
	<?php
		echo cleanira_post_category_render();
	echo cleanira_post_publish_render();
	if (is_single()) {
		echo cleanira_single_post_title_render();
	} else {
		echo cleanira_post_title_render();
	}
	echo cleanira_post_meta_render();
	?>
	</div>
	<?php
	echo cleanira_post_content_render();
	?>
</article>