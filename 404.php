<?php
/*
Template Name: 404 Template
*/
?>
<?php get_header();
get_template_part( 'framework/templates/site', 'titlebar');
?>

<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<h2><?php esc_html_e('404 Error', 'cleanira'); ?></h2>
			<h3><?php esc_html_e('Sorry! The Page Not Found ;(', 'cleanira'); ?></h3>
			<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'cleanira'); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
</main><!-- #main -->
<?php get_footer(); ?>
