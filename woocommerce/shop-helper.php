<?php
// WooCommerce custom hooks
add_action('cleanira_woocommerce_template_loop_product_link_open', 'woocommerce_template_loop_product_link_open', 10);
add_action('cleanira_woocommerce_template_loop_product_link_close', 'woocommerce_template_loop_product_link_close', 5);
add_action('cleanira_woocommerce_show_product_loop_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('cleanira_woocommerce_template_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('cleanira_woocommerce_template_loop_product_title', 'woocommerce_template_loop_product_title', 10);
add_action('cleanira_woocommerce_template_loop_rating', 'woocommerce_template_loop_rating', 5);
add_action('cleanira_woocommerce_template_loop_price', 'woocommerce_template_loop_price', 10);
add_action('cleanira_woocommerce_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10);

add_action('cleanira_woocommerce_template_single_title', 'woocommerce_template_single_title', 5);
add_action('cleanira_woocommerce_template_single_rating', 'woocommerce_template_single_rating', 10);
add_action('cleanira_woocommerce_template_single_price', 'woocommerce_template_single_price', 10);
add_action('cleanira_woocommerce_template_single_excerpt', 'woocommerce_template_single_excerpt', 20);
add_action('cleanira_woocommerce_template_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30);
add_action('cleanira_woocommerce_template_single_meta', 'woocommerce_template_single_meta', 40);
add_action('cleanira_woocommerce_template_single_sharing', 'woocommerce_template_single_sharing', 50);


add_action('cleanira_woocommerce_shop_loop_item_subtitle', 'cleanira_woocommerce_template_loop_subtitle', 10, 2);


function cleanira_woocommerce_template_loop_subtitle()
{
  $subtitle = get_post_meta(get_the_ID(), '_subtitle', true);

  if (!empty($subtitle)) {
    echo '<span class="woocommerce-loop-product__subtitle">' . $subtitle . '</span>';
  }

  return;
}

add_action('woocommerce_single_product_summary', 'cleanira_woocommerce_template_single_subtitle', 3);
function cleanira_woocommerce_template_single_subtitle()
{
  $subtitle = get_post_meta(get_the_ID(), '_subtitle', true);

  if (!empty($subtitle)) {
    echo '<span class="woocommerce-product-subtitle">' . $subtitle . '</span>';
  }

  return;
}

// WooCommerce percentage flash
add_filter('woocommerce_sale_flash', 'cleanira_woocommerce_percentage_sale', 10, 3);
function cleanira_woocommerce_percentage_sale($html, $post, $product)
{
  if ($product->is_type('variable')) {
    $percentages = array();

    // Get all variation prices
    $prices = $product->get_variation_prices();

    // Loop through variation prices
    foreach ($prices['price'] as $key => $price) {
      // Only on sale variations
      if ($prices['regular_price'][$key] !== $price) {
        // Calculate and set in the array the percentage for each variation on sale
        $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
      }
    }
    // We keep the highest value
    $percentage = max($percentages) . '%';
  } elseif ($product->is_type('grouped')) {
    $percentages = array();

    foreach ($product->get_children() as $child_id) {
      $child = wc_get_product($child_id);
      if (!empty($child->get_sale_price())) {
        $regular_price = $child->get_regular_price();
        $sale_price = $child->get_sale_price();
        $percentages[] = round(100 - ($sale_price / $regular_price * 100));
      }
    }

    $percentage = max($percentages) . '%';
  } else {
    $regular_price = (float) $product->get_regular_price();
    $sale_price = (float) $product->get_sale_price();

    $percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
  }

  return '<span class="onsale">' . $percentage . '</span>';
}

add_filter('woocommerce_pagination_args', 'cleanira_woocommerce_pagination_args');
function cleanira_woocommerce_pagination_args()
{
  $total   = isset($total) ? $total : wc_get_loop_prop('total_pages');
  $current = isset($current) ? $current : wc_get_loop_prop('current_page');
  $base    = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
  $format  = isset($format) ? $format : '';

  if ($total <= 1) {
    return;
  }

  return array(
    'base'     => $base,
    'format'   => $format,
    'total'    => $total,
    'current'  => $current,
    'mid_size' => 1,
    'add_args' => false,
    'prev_text' => '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.71889 15.782L10.4536 15.0749C10.6275 14.9076 10.6275 14.6362 10.4536 14.4688L4.69684 8.92851L17.3672 8.92852C17.6131 8.92852 17.8125 8.73662 17.8125 8.49994L17.8125 7.49994C17.8125 7.26326 17.6131 7.07137 17.3672 7.07137L4.69684 7.07137L10.4536 1.53101C10.6275 1.36366 10.6275 1.0923 10.4536 0.924907L9.71889 0.2178C9.545 0.0504438 9.26304 0.0504438 9.08911 0.2178L1.31792 7.69691C1.14403 7.86426 1.14403 8.13562 1.31792 8.30301L9.08914 15.782C9.26304 15.9494 9.545 15.9494 9.71889 15.782Z"/>
                    </svg> ' . esc_html__('Prev', 'cleanira'),
    'next_text' => esc_html__('Next', 'cleanira') . '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.28111 0.217951L8.54638 0.925058C8.37249 1.09242 8.37249 1.36377 8.54638 1.53117L14.3032 7.07149L1.63283 7.07149C1.38691 7.07149 1.18752 7.26338 1.18752 7.50006L1.18752 8.50006C1.18752 8.73674 1.38691 8.92863 1.63283 8.92863L14.3032 8.92863L8.54638 14.469C8.37249 14.6363 8.37249 14.9077 8.54638 15.0751L9.28111 15.7822C9.455 15.9496 9.73696 15.9496 9.91089 15.7822L17.6821 8.30309C17.856 8.13574 17.856 7.86438 17.6821 7.69699L9.91086 0.217952C9.73696 0.0505587 9.455 0.0505586 9.28111 0.217951Z"/>
                  </svg>',
  );
}

// WooCommerce availability
add_filter('woocommerce_get_availability', 'cleanira_woocommerce_show_in_stock', 10, 2);
function cleanira_woocommerce_show_in_stock($availability, $product)
{
  if (!$product->managing_stock() && $product->is_in_stock()) {
    $availability['availability'] = __('In Stock', 'cleanira');
  }

  $availability['availability'] = __('Availability: ', 'cleanira') . '<span>' . $availability['availability'] . '</span>';

  return $availability;
}

// WooCommerce ralated params
add_filter('woocommerce_output_related_products_args', 'cleanira_woocommerce_related_products_args', 20);
function cleanira_woocommerce_related_products_args($args)
{
  if (function_exists('get_field')) {
    $related_posts = get_field('product_related_posts', 'options');
    $args['posts_per_page'] = !empty($related_posts['number_posts']) ? $related_posts['number_posts'] : 4;
  } else {
    $args['posts_per_page'] = 4;
  }

  $args['columns'] = 4;

  return $args;
}
if (function_exists('get_field')) {
  $enable_related_posts = get_field('enable_related_posts', 'options');
  if (!$enable_related_posts) {
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
  }
}
// WooCommerce custom field
add_action('woocommerce_product_options_general_product_data', 'cleanira_woocommerce_custom_field');
function cleanira_woocommerce_custom_field()
{
  global $post;

  woocommerce_wp_text_input(
    array(
      'id'          => '_subtitle',
      'label'       => __('Subtitle', 'cleanira'),
      'description' => ''
    )
  );
}

add_action('woocommerce_process_product_meta', 'cleanira_woocommerce_custom_field_save');
function cleanira_woocommerce_custom_field_save($post_id)
{
  $subtitle = $_POST['_subtitle'];
  if (!empty($subtitle)) {
    update_post_meta($post_id, '_subtitle', esc_attr($subtitle));
  } else {
    update_post_meta($post_id, '_subtitle', '');
  }
}

/* Remove the additional information tab */
add_filter('woocommerce_product_tabs', 'cleanira_woocommerce_remove_additional_information_tabs', 98);

function cleanira_woocommerce_remove_additional_information_tabs($tabs)
{
  unset($tabs['additional_information']);
  return $tabs;
}
/* Add additional information to the bottom of the description */
add_filter('the_content', 'cleanira_woocommerce_add_additional_information');
function cleanira_woocommerce_add_additional_information($content)
{
  global $product;
  if (is_product()) {
    ob_start();
    do_action('woocommerce_product_additional_information', $product);
    $additional_info_content = ob_get_clean();
    if (!empty($additional_info_content)) {
      $content .= '<h3>' . esc_html__('Additional Information:', 'cleanira') . '</h3>' . $additional_info_content;
    }
  }
  return $content;
}
/* Custom the "Description" title */
add_filter('woocommerce_product_description_heading', 'cleanira_woocommerce_custom_description_heading');
function cleanira_woocommerce_custom_description_heading()
{
  return esc_html__('Key Ingredient:', 'cleanira');
}
/* Custom the "Review" tab title */
add_filter('woocommerce_product_tabs', 'cleanira_woocommerce_custom_reviews_tab_title');
function cleanira_woocommerce_custom_reviews_tab_title($tabs)
{
  if (isset($tabs['reviews'])) {
    global $product;
    $review_count = $product->get_review_count();
    $tabs['reviews']['title'] = sprintf(__('Reviews <span>%d</span>', 'cleanira'), $review_count);
  }
  return $tabs;
}


/* auto update mini cart */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_icon_add_to_cart_fragment');
if (!function_exists('woocommerce_icon_add_to_cart_fragment')) {
  function woocommerce_icon_add_to_cart_fragment($fragments)
  {
    global $woocommerce;
    ob_start();
?>
    <span class="cart_total"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
  <?php
    $fragments['span.cart_total'] = ob_get_clean();
    return $fragments;
  }
}
/* Product wishlist */
function cleanira_is_wishlist($post_id)
{
  if (isset($_COOKIE['productwishlistcookie']) && $_COOKIE['productwishlistcookie'] != '') {
    $product_wishlist = explode(',', $_COOKIE['productwishlistcookie']);

    if (in_array((string)$post_id, $product_wishlist)) {
      return true;
    } else {
      return false;
    }
  }
}

/* Product compare */
function cleanira_is_compare($post_id)
{
  if (isset($_COOKIE['productcomparecookie']) && $_COOKIE['productcomparecookie'] != '') {
    $product_compare = explode(',', $_COOKIE['productcomparecookie']);

    if (in_array((string)$post_id, $product_compare)) {
      return true;
    } else {
      return false;
    }
  }
}

function cleanira_products_query_args($params = array(), $limit = 9)
{
  $query_args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => $limit
  );

  if (isset($params['current_page']) && $params['current_page'] != '') {
    $query_args['paged'] = absint($params['current_page']);
  }

  if (isset($params['search_keyword']) && $params['search_keyword'] != '') {
    $query_args['s'] = $params['search_keyword'];
  }

  // if (isset($params['sort_order']) && $params['sort_order'] != '') {
  // 	if ($params['sort_order'] == 'date_high' || $params['sort_order'] == 'date_low') {
  // 		$query_args['orderby'] = 'date';

  // 		if ($params['sort_order'] == 'date_high') {
  // 			$query_args['order'] = 'DESC';
  // 		} else {
  // 			$query_args['order'] = 'ASC';
  // 		}
  // 	}

  // 	if ($params['sort_order'] == 'mileage_high' || $params['sort_order'] == 'mileage_low') {
  // 		$query_args['meta_key'] = 'product_mileage';
  // 		$query_args['orderby'] = 'meta_value_num';

  // 		if ($params['sort_order'] == 'mileage_high') {
  // 			$query_args['order'] = 'DESC';
  // 		} else {
  // 			$query_args['order'] = 'ASC';
  // 		}
  // 	}

  // 	if ($params['sort_order'] == 'price_high' || $params['sort_order'] == 'price_low') {
  // 		$query_args['meta_key'] = 'product_price';
  // 		$query_args['orderby'] = 'meta_value_num';

  // 		if ($params['sort_order'] == 'price_high') {
  // 			$query_args['order'] = 'DESC';
  // 		} else {
  // 			$query_args['order'] = 'ASC';
  // 		}
  // 	}
  // }

  $query_tax = array();

  // if (isset($params['product_categories']) && $params['product_categories'] != '') {
  // 	$query_tax[] = array(
  // 		'taxonomy' => 'product_categories',
  // 		'field' => 'slug',
  // 		'terms' => explode(',', $params['product_categories'])
  // 	);
  // }

  if (!empty($query_tax)) {
    $query_args['tax_query'] = $query_tax;
  }

  $query_meta = array();


  if (isset($params['min_price']) && $params['min_price'] != '' && isset($params['max_price']) && $params['max_price'] != '') {
    $min_price = $params['min_price'];
    $max_price = $params['max_price'];

    $query_meta['price_clause'] = array(
      array(
        'key' => '_price',
        'value' => array($min_price, $max_price),
        'compare' => 'BETWEEN',
        'type' => 'DECIMAL'
      ),
    );
  }

  if (!empty($query_meta)) {
    $query_args['meta_query'] = $query_meta;
    $query_args['relation'] = 'AND';
  }

  return $query_args;
}


function cleanira_products_filter()
{
  $limit = 9;
  $query_args = cleanira_products_query_args($_POST, $limit);
  $wp_query = new \WP_Query($query_args);
  $current_page = isset($_POST['current_page']) && $_POST['current_page'] != '' ? absint($_POST['current_page']) : 1;
  $total_page = $wp_query->max_num_pages;

  $paged = !empty($wp_query->query_vars['paged']) ? $wp_query->query_vars['paged'] : 1;
  $prev_posts = ($paged - 1) * $wp_query->query_vars['posts_per_page'];
  $from = 1 + $prev_posts;
  $to = count($wp_query->posts) + $prev_posts;
  $of = $wp_query->found_posts;

  // Update Results Block
  ob_start();
  if ($of > 0) {
    printf(esc_html__('Showing %s - %s of %s results', 'cleanira'), $from, $to, $of);
  } else {
    echo esc_html__('No results', 'cleanira');
  }
  $output['results'] = ob_get_clean();

  // Update Layout view
  $view = isset($_POST['view_type']) && $_POST['view_type'] != '' ? $_POST['view_type'] : '';
  $output['view'] = $view;

  // Update Loop Post
  if ($wp_query->have_posts()) {
    ob_start();
    while ($wp_query->have_posts()) {
      $wp_query->the_post();
      wc_get_template_part('content', 'product');
    }

    $output['items'] = ob_get_clean();
    //	$output['pagination'] = cleanira_products_pagination($current_page, $total_page);
  } else {
    $output['items'] = '<h3 class="not-found-post">' . esc_html__('Sorry, No products found', 'cleanira') . '</h3>';
    $output['pagination'] = '';
  }

  wp_reset_postdata();

  wp_send_json_success($output);

  die();
}
add_action('wp_ajax_cleanira_products_filter', 'cleanira_products_filter');
add_action('wp_ajax_nopriv_cleanira_products_filter', 'cleanira_products_filter');


function cleanira_products_compare()
{
  $productcompare = '';
  $product_ids = array();

  if (isset($_COOKIE['productcomparecookie']) && !empty($_COOKIE['productcomparecookie'])) {
    $productcompare = $_COOKIE['productcomparecookie'];
    $product_ids = explode(',', $productcompare);
  }

  ob_start();
  if (!empty($product_ids)) {
  ?>
    <div class="bt-table-title">
      <h2><?php esc_html_e('Compare products', 'cleanira') ?></h2>
    </div>
    <div class="bt-table-compare">
      <div class="bt-table--head">
        <div class="bt-table--col"><?php esc_html_e('Product Info', 'cleanira') ?></div>
        <div class="bt-table--col"><?php esc_html_e('Product Name', 'cleanira') ?></div>
        <div class="bt-table--col"><?php esc_html_e('Price', 'cleanira') ?></div>
        <div class="bt-table--col"><?php esc_html_e('Button', 'cleanira') ?></div>
      </div>
      <div class="bt-table--body">
        <?php
        foreach ($product_ids as $key => $id) {
          $product = wc_get_product($id);
          if ($product) {
            $product_url = get_permalink($id);
            $product_name = $product->get_name();
            $product_image = wp_get_attachment_image_src($product->get_image_id(), 'medium');
            if (!$product_image) {
              $product_image_url = wc_placeholder_img_src();
            } else {
              $product_image_url = $product_image[0];
            }
            $product_price = $product->get_price_html();
        ?>
            <div class="bt-table--row">
              <div class="bt-table--col bt-thumb">
                <a href="<?php echo esc_url($product_url); ?>">
                  <img src="<?php echo esc_url($product_image_url); ?>" alt="<?php echo esc_attr($product_name); ?>">
                  <div class="bt-remove-item" data-id="<?php echo esc_attr($id) ?>"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                      <path d="M9.64052 9.10965C9.67536 9.14449 9.703 9.18586 9.72186 9.23138C9.74071 9.2769 9.75042 9.32569 9.75042 9.37496C9.75042 9.42424 9.74071 9.47303 9.72186 9.51855C9.703 9.56407 9.67536 9.60544 9.64052 9.64028C9.60568 9.67512 9.56432 9.70276 9.51879 9.72161C9.47327 9.74047 9.42448 9.75017 9.37521 9.75017C9.32594 9.75017 9.27714 9.74047 9.23162 9.72161C9.1861 9.70276 9.14474 9.67512 9.1099 9.64028L6.00021 6.53012L2.89052 9.64028C2.82016 9.71064 2.72472 9.75017 2.62521 9.75017C2.5257 9.75017 2.43026 9.71064 2.3599 9.64028C2.28953 9.56991 2.25 9.47448 2.25 9.37496C2.25 9.27545 2.28953 9.18002 2.3599 9.10965L5.47005 5.99996L2.3599 2.89028C2.28953 2.81991 2.25 2.72448 2.25 2.62496C2.25 2.52545 2.28953 2.43002 2.3599 2.35965C2.43026 2.28929 2.5257 2.24976 2.62521 2.24976C2.72472 2.24976 2.82016 2.28929 2.89052 2.35965L6.00021 5.46981L9.1099 2.35965C9.18026 2.28929 9.2757 2.24976 9.37521 2.24976C9.47472 2.24976 9.57016 2.28929 9.64052 2.35965C9.71089 2.43002 9.75042 2.52545 9.75042 2.62496C9.75042 2.72448 9.71089 2.81991 9.64052 2.89028L6.53036 5.99996L9.64052 9.10965Z" fill="#212121" />
                    </svg></div>
                </a>
              </div>
              <div class="bt-table--col bt-name">
                <h3><a href="<?php echo esc_url($product_url); ?>"><?php echo esc_html($product_name); ?></a></h3>
              </div>
              <div class="bt-table--col bt-price">
                <p><?php echo $product_price; ?></p>
              </div>
              <div class="bt-table--col bt-add-to-cart">
                <a href="?add-to-cart=<?php echo $id; ?>" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_<?php echo $id; ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $id; ?>" data-product_sku="" aria-label="Add to cart: “Great Value Disposable”" rel="nofollow" data-success_message="“Great Value Disposable” has been added to your cart"><?php esc_attr_e( 'Add to cart', 'cleanira' ) ?></a>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
<?php
    $count = count($product_ids);
    $output['count'] = $count;
  }
  $output['product'] = ob_get_clean();

  wp_send_json_success($output);
  die();
}

add_action('wp_ajax_cleanira_products_compare', 'cleanira_products_compare');
add_action('wp_ajax_nopriv_cleanira_products_compare', 'cleanira_products_compare');
