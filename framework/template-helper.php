<?php
if (! isset($content_width)) $content_width = 900;
if (is_singular()) wp_enqueue_script("comment-reply");

if (! function_exists('cleanira_setup')) {
	function cleanira_setup()
	{
		/* Load textdomain */
		load_theme_textdomain('cleanira', get_template_directory() . '/languages');

		/* Add custom logo */
		add_theme_support('custom-logo');

		/* Add RSS feed links to <head> for posts and comments. */
		add_theme_support('automatic-feed-links');

		/* Enable support for Post Thumbnails, and declare sizes. */
		add_theme_support('post-thumbnails');

		/* Enable support for Title Tag */
		add_theme_support("title-tag");

		/* This theme uses wp_nav_menu() in locations. */
		register_nav_menus(array(
			'primary_menu'   => esc_html__('Primary Menu', 'cleanira'),

		));

		/* This theme styles the visual editor to resemble the theme style, specifically font, colors, icons, and column width. */
		add_editor_style('editor-style.css');

		/* Switch default core markup for search form, comment form, and comments to output valid HTML5. */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		));

		/* This theme allows users to set a custom background. */
		add_theme_support('custom-background', apply_filters('cleanira_custom_background_args', array(
			'default-color' => 'f5f5f5',
		)));

		/* Add support for featured content. */
		add_theme_support('featured-content', array(
			'featured_content_filter' => 'cleanira_get_featured_posts',
			'max_posts' => 6,
		));

		/* This theme uses its own gallery styles. */
		add_filter('use_default_gallery_style', '__return_false');

		/* Add support woocommerce */
		add_theme_support('woocommerce');
	}
}
add_action('after_setup_theme', 'cleanira_setup');

/* Custom Site Title */
if (! function_exists('cleanira_wp_title')) {
	function cleanira_wp_title($title, $sep)
	{
		global $paged, $page;
		if (is_feed()) {
			return $title;
		}
		// Add the site name.
		$title .= get_bloginfo('name');
		// Add the site description for the home/front page.
		$site_description = get_bloginfo('description', 'display');
		if ($site_description && (is_home() || is_front_page())) {
			$title = "$title $sep $site_description";
		}
		// Add a page number if necessary.
		if ($paged >= 2 || $page >= 2) {
			$title = sprintf(esc_html__('Page %s', 'cleanira'), max($paged, $page)) . " $sep $title";
		}
		return $title;
	}
	add_filter('wp_title', 'cleanira_wp_title', 10, 2);
}

/* Logo */
if (!function_exists('cleanira_logo')) {
	function cleanira_logo($url = '', $height = 30)
	{
		if (!$url) {
			$url = get_template_directory_uri() . '/assets/images/site-logo.png';
		}
		echo '<a href="' . home_url('/') . '"><img class="logo" style="height: ' . esc_attr($height) . 'px; width: auto;" src="' . esc_url($url) . '" alt="' . esc_attr__('Logo', 'cleanira') . '"/></a>';
	}
}

/* Nav Menu */
if (!function_exists('cleanira_nav_menu')) {
	function cleanira_nav_menu($menu_slug = '', $theme_location = '', $container_class = '')
	{
		if (has_nav_menu($theme_location) || $menu_slug) {
			wp_nav_menu(array(
				'menu'				=> $menu_slug,
				'container_class' 	=> $container_class,
				'items_wrap'      	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'theme_location'  	=> $theme_location
			));
		} else {
			wp_page_menu(array(
				'menu_class'  => $container_class
			));
		}
	}
}
/* Page title */
if (!function_exists('cleanira_page_title')) {
	function cleanira_page_title()
	{
		ob_start();
		if (is_front_page()) {
			esc_html_e('Home', 'cleanira');
		} elseif (is_home()) {
			esc_html_e('Blog', 'cleanira');
		} elseif (is_search()) {
			esc_html_e('Search', 'cleanira');
		} elseif (is_404()) {
			esc_html_e('404', 'cleanira');
		} elseif (is_page()) {
			echo get_the_title();
		} elseif (is_archive()) {
			if (is_category()) {
				single_cat_title();
			} elseif (get_post_type() == 'service') {
				if (!is_tax()) {
					echo post_type_archive_title();
				} else {
					single_cat_title();
				}
			} elseif (get_post_type() == 'product') {
				if (wc_get_page_id('shop')) {
					echo get_the_title(wc_get_page_id('shop'));
				} else {
					single_term_title();
				}
			} elseif (is_tag()) {
				single_tag_title();
			} elseif (is_author()) {
				printf(__('Author: %s', 'cleanira'), '<span class="vcard">' . get_the_author() . '</span>');
			} elseif (is_day()) {
				printf(__('Day: %s', 'cleanira'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_month()) {
				printf(__('Month: %s', 'cleanira'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_year()) {
				printf(__('Year: %s', 'cleanira'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_tax('post_format', 'post-format-aside')) {
				esc_html_e('Aside', 'cleanira');
			} elseif (is_tax('post_format', 'post-format-gallery')) {
				esc_html_e('Gallery', 'cleanira');
			} elseif (is_tax('post_format', 'post-format-image')) {
				esc_html_e('Image', 'cleanira');
			} elseif (is_tax('post_format', 'post-format-video')) {
				esc_html_e('Video', 'cleanira');
			} elseif (is_tax('post_format', 'post-format-quote')) {
				esc_html_e('Quote', 'cleanira');
			} elseif (is_tax('post_format', 'post-format-link')) {
				esc_html_e('Link', 'cleanira');
			} elseif (is_tax('post_format', 'post-format-status')) {
				esc_html_e('Status', 'cleanira');
			} elseif (is_tax('post_format', 'post-format-audio')) {
				esc_html_e('Audio', 'cleanira');
			} elseif (is_tax('post_format', 'post-format-chat')) {
				esc_html_e('Chat', 'cleanira');
			} else {
				echo get_the_title(wc_get_page_id('shop'));
			}
		} else {
			echo get_the_title();
		}

		return ob_get_clean();
	}
}

/* Page breadcrumb */
if (!function_exists('cleanira_page_breadcrumb')) {
	function cleanira_page_breadcrumb($home_text = 'Home', $delimiter = '-')
	{
		global $post;

		if (is_front_page()) {
			echo '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ' . esc_html('Front Page', 'cleanira');
		} elseif (is_home()) {
			echo  '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ' . esc_html('Blog', 'cleanira');
		} else {
			echo '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ';
		}

		if (is_category()) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' <span class="bt-deli">' . $delimiter . '</span> ');
			echo '<span class="current">' . single_cat_title(esc_html__('Archive by category: ', 'cleanira'), false) . '</span>';
		} elseif (is_tag()) {
			echo '<span class="current">' . single_tag_title(esc_html__('Posts tagged: ', 'cleanira'), false) . '</span>';
		} elseif (is_post_type_archive()) {
			echo post_type_archive_title('<span class="current">', '</span>');
		} elseif (is_tax()) {
			echo '<span class="current">' . single_term_title(esc_html__('Archive by taxonomy: ', 'cleanira'), false) . '</span>';
		} elseif (is_search()) {
			echo '<span class="current">' . esc_html__('Search results for: ', 'cleanira') . get_search_query() . '</span>';
		} elseif (is_day()) {
			echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . ' ' . get_the_time('Y') . '</a> <span class="bt-deli">' . $delimiter . '</span> ';
			echo '<span class="current">' . get_the_time('d') . '</span>';
		} elseif (is_month()) {
			echo '<span class="current">' . get_the_time('F') . ' ' . get_the_time('Y') . '</span>';
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post') {
				if (get_post_type() == 'product') {
					$terms = get_the_terms(get_the_ID(), 'product_cat', '', '');
					if (!empty($terms) && !is_wp_error($terms)) {
						the_terms(get_the_ID(), 'product_cat', '', ', ');
						echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
					} else {
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				} else {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					if ($post_type->rewrite) {
						echo '<a href="' . esc_url(home_url('/')) . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
						echo ' <span class="bt-deli">' . $delimiter . '</span> ';
					}
					echo '<span class="current">' . get_the_title() . '</span>';
				}
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' <span class="bt-deli">' . $delimiter . '</span> ');
				echo '' . $cats;
				echo '<span class="current">' . get_the_title() . '</span>';
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			if ($post_type) echo '<span class="current">' . $post_type->labels->name . '</span>';
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_page() && !is_front_page() && !$post->post_parent) {
			echo '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_page() && !is_front_page() && $post->post_parent) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo '' . $breadcrumbs[$i];
				if ($i != count($breadcrumbs) - 1)
					echo ' <span class="bt-deli">' . $delimiter . '</span> ';
			}
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_author()) {
			global $author;
			$userdata = get_userdata($author);
			echo '<span class="current">' . esc_html__('Articles posted by ', 'cleanira') . $userdata->display_name . '</span>';
		} elseif (is_404()) {
			echo '<span class="current">' . esc_html__('Error 404', 'cleanira') . '</span>';
		}

		if (get_query_var('paged')) {
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo '<span class="bt-pages"> (';
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . esc_html__('Page', 'cleanira') . ' ' . get_query_var('paged');
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')</span>';
		}
	}
}

/* Display navigation to next/previous post */
if (! function_exists('cleanira_post_nav')) {
	function cleanira_post_nav()
	{
		$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
		$next     = get_adjacent_post(false, '', false);
		if (! $next && ! $previous) {
			return;
		}
?>
		<nav class="bt-post-nav clearfix">
			<?php
			previous_post_link('<div class="bt-post-nav--item bt-prev"><span>' . esc_html__('Previous', 'cleanira') . '</span><h3>%link</h3></div>');
			next_post_link('<div class="bt-post-nav--item bt-next"><span>' . esc_html__('Next', 'cleanira') . '</span><h3>%link</h3></div>');
			?>
		</nav>
	<?php
	}
}

/* Display paginate links */
if (! function_exists('cleanira_paginate_links')) {
	function cleanira_paginate_links($wp_query)
	{
		if ($wp_query->max_num_pages <= 1) {
			return;
		}
	?>
		<nav class="bt-pagination" role="navigation">
			<?php
			$big = 999999999; // need an unlikely integer
			echo paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $wp_query->max_num_pages,
				'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13" fill="none">
  <path d="M0.839282 12.4903C0.630446 12.2842 0.611461 11.9616 0.782327 11.7343L0.839282 11.6692L5.91327 6.6604L0.839282 1.65162C0.630446 1.44548 0.611461 1.1229 0.782327 0.895592L0.839282 0.830468C1.04812 0.624326 1.37491 0.605586 1.6052 0.774247L1.67117 0.830468L7.16137 6.24982C7.3702 6.45596 7.38919 6.77854 7.21832 7.00585L7.16137 7.07098L1.67117 12.4903C1.44145 12.7171 1.069 12.7171 0.839282 12.4903Z" fill="#212121"></path>
</svg>' . esc_html__('Prev', 'cleanira'),
				'next_text' => esc_html__('Next', 'cleanira') . '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13" fill="none">
  <path d="M0.839282 12.4903C0.630446 12.2842 0.611461 11.9616 0.782327 11.7343L0.839282 11.6692L5.91327 6.6604L0.839282 1.65162C0.630446 1.44548 0.611461 1.1229 0.782327 0.895592L0.839282 0.830468C1.04812 0.624326 1.37491 0.605586 1.6052 0.774247L1.67117 0.830468L7.16137 6.24982C7.3702 6.45596 7.38919 6.77854 7.21832 7.00585L7.16137 7.07098L1.67117 12.4903C1.44145 12.7171 1.069 12.7171 0.839282 12.4903Z" fill="#212121"></path>
</svg>',
			));
			?>
		</nav>
	<?php
	}
}

/* Display navigation to next/previous set of posts */
if (! function_exists('cleanira_paging_nav')) {
	function cleanira_paging_nav()
	{
		if ($GLOBALS['wp_query']->max_num_pages < 2) {
			return;
		}

		$paged        = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
		$pagenum_link = html_entity_decode(get_pagenum_link());
		$query_args   = array();
		$url_parts    = explode('?', $pagenum_link);

		if (isset($url_parts[1])) {
			wp_parse_str($url_parts[1], $query_args);
		}

		$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
		$pagenum_link = trailingslashit($pagenum_link) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

	?>
		<nav class="bt-pagination" role="navigation">
			<?php
			echo paginate_links(array(
				'base'     => $pagenum_link,
				'format'   => $format,
				'total'    => $GLOBALS['wp_query']->max_num_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map('urlencode', $query_args),
				'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13" fill="none">
  <path d="M0.839282 12.4903C0.630446 12.2842 0.611461 11.9616 0.782327 11.7343L0.839282 11.6692L5.91327 6.6604L0.839282 1.65162C0.630446 1.44548 0.611461 1.1229 0.782327 0.895592L0.839282 0.830468C1.04812 0.624326 1.37491 0.605586 1.6052 0.774247L1.67117 0.830468L7.16137 6.24982C7.3702 6.45596 7.38919 6.77854 7.21832 7.00585L7.16137 7.07098L1.67117 12.4903C1.44145 12.7171 1.069 12.7171 0.839282 12.4903Z" fill="#212121"/>
</svg>' . esc_html__('Prev', 'cleanira'),
				'next_text' => esc_html__('Next', 'cleanira') . '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13" fill="none">
  <path d="M0.839282 12.4903C0.630446 12.2842 0.611461 11.9616 0.782327 11.7343L0.839282 11.6692L5.91327 6.6604L0.839282 1.65162C0.630446 1.44548 0.611461 1.1229 0.782327 0.895592L0.839282 0.830468C1.04812 0.624326 1.37491 0.605586 1.6052 0.774247L1.67117 0.830468L7.16137 6.24982C7.3702 6.45596 7.38919 6.77854 7.21832 7.00585L7.16137 7.07098L1.67117 12.4903C1.44145 12.7171 1.069 12.7171 0.839282 12.4903Z" fill="#212121"/>
</svg>',
			));
			?>
		</nav>
<?php
	}
}
