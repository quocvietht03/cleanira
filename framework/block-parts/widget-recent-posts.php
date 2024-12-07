<?php

/**
 * Block Name: Widget - Recent Posts
 **/

$number_posts = get_field('number_posts');

$recent_posts = wp_get_recent_posts(array(
	'numberposts' => $number_posts,
	'post_status' => 'publish'
));

?>
<div id="<?php echo 'bt_block--' . $block['id']; ?>" class="widget widget-block bt-block-recent-posts">
	<?php foreach ($recent_posts as $post_item) { ?>
		<div class="bt-post">
			<a href="<?php echo get_permalink($post_item['ID']) ?>">
				<div class="bt-post--thumbnail">
					<div class="bt-cover-image">
						<?php echo get_the_post_thumbnail($post_item['ID'], 'thumbnail'); ?>
					</div>
				</div>
				<div class="bt-post--infor">
					<div class="bt-post--date">
						<?php echo get_the_date(get_option('date_format'), $post_item['ID']); ?>
					</div>
					<?php echo '<h3 class="bt-post--title">' . $post_item['post_title'] . '</h3>'; ?>
					<div class="bt-post--author">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
							<path d="M6.66683 5.83333C6.66683 7.67428 8.15925 9.16667 10.0002 9.16667C11.8411 9.16667 13.3335 7.67428 13.3335 5.83333C13.3335 3.99238 11.8411 2.5 10.0002 2.5C8.15925 2.5 6.66683 3.99238 6.66683 5.83333Z" stroke="#2D77DC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							<path d="M10.0002 11.6667C13.2218 11.6667 15.8335 14.2784 15.8335 17.5001H4.16683C4.16683 14.2784 6.7785 11.6667 10.0002 11.6667Z" stroke="#2D77DC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						<?php echo esc_html__('By ', 'cleanira') . get_the_author_meta('display_name', $post_item['post_author']); ?>
					</div>
				</div>
			</a>
		</div>
	<?php } ?>
</div>