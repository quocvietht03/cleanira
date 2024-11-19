<?php
/*
 * Single Post
 */

get_header();
?>

<main id="bt_main" class="bt-site-main">
	<div class="bt-main-image-full">
		<?php echo cleanira_post_featured_render('full');
		?>
	</div>
	<div class="bt-container-single">
		<?php
		while (have_posts()) : the_post();
		?>
			<div class="bt-main-post">
				<?php get_template_part('framework/templates/post'); ?>
			</div>
		<?php
			echo cleanira_tags_render();

			echo cleanira_author_render();

			echo cleanira_related_posts();

			// cleanira_post_nav();

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) comments_template();
		endwhile;
		?>
	</div>

</main><!-- #main -->

<?php get_footer(); ?>