<?php
get_header();
get_template_part('framework/templates/site', 'titlebar');

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<div class="bt-form-search">
				<h2 class="bt-form-head"><?php esc_html_e('Need a new search?', 'cleanira') ?></h2>
				<p class="bt-form-subhead"><?php esc_html_e("If you didn't find what you were looking for, try a new search!", "cleanira") ?></p>
				<form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
				<label>
					<input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search …', 'cleanira' ) ?>" value="<?php echo get_search_query(); ?>" name="s">
					<input type="hidden" name="post_type" value="post" />
				</label>
				<input type="submit" class="search-submit" value="<?php echo esc_attr__( 'Search', 'cleanira' ) ?>">
			</form>
			</div>
			<?php
			if (have_posts()) {
			?>
				<div class="bt-list-post">
					<?php
					while (have_posts()) : the_post();
						get_template_part('framework/templates/post', 'style', array('image-size' => 'large'));
					endwhile;
					?>
				</div>
			<?php
				cleanira_paging_nav();
			} else {
				get_template_part('framework/templates/post', 'none');
			}
			?>
		</div>
	</div>

</main><!-- #main -->

<?php get_footer(); ?>