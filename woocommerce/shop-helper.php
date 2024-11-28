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
/* add tax brand product */
function cleanira_create_brand_taxonomy()
{
  $args = array(
    'hierarchical' => true,
    'labels' => array(
      'name' => __('Brands', 'cleanira'),
      'singular_name' => __('Brand', 'cleanira'),
      'search_items' => __('Search Brands', 'cleanira'),
      'all_items' => __('All Brands', 'cleanira'),
      'parent_item' => __('Parent Brand', 'cleanira'),
      'parent_item_colon' => __('Parent Brand:', 'cleanira'),
      'edit_item' => __('Edit Brand', 'cleanira'),
      'update_item' => __('Update Brand', 'cleanira'),
      'add_new_item' => __('Add New Brand', 'cleanira'),
      'new_item_name' => __('New Brand Name', 'cleanira'),
      'menu_name' => __('Brands', 'cleanira'),
    ),
    'rewrite' => array(
      'slug' => 'product-brand',
      'with_front' => false,
      'hierarchical' => true,
    ),
  );

  register_taxonomy('product_brand', 'product', $args);
}

add_action('init', 'cleanira_create_brand_taxonomy', 0);

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
/* Create Product Wishlist Page */
function cleanira_product_create_pages_support()
{
  $product_wishlist_page = get_posts(array(
    'title' => 'Products Wishlist',
    'post_type' => 'page',
    'post_status'    => 'any'
  ));

  if (count($product_wishlist_page) == 0) {
    wp_insert_post(array(
      'post_type' => 'page',
      'post_status' => 'publish',
      'post_title' => 'Products Wishlist',
      'post_content' => 'Products Wishlist Page.',
      'post_name' => 'products-wishlist',
    ));
  }
}
add_action('init', 'cleanira_product_create_pages_support', 1);

function cleanira_get_products_by_rating($rating)
{
  $args = [
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_query'     => [
      [
        'key'     => '_wc_average_rating',
        'value'   => $rating,
        'compare' => '=',
        'type'    => 'NUMERIC',
      ],
    ],
  ];

  $query = new WP_Query($args);
  return '(' . $query->found_posts . ')';
}

/* Field Product */
function cleanira_product_field_radio_html($slug = '', $field_title = '', $field_value = '')
{
  if (empty($slug)) {
    return;
  }

  $terms = get_terms(array(
    'taxonomy' => $slug,
    'hide_empty' => true
  ));

  $field_title_default = !empty($field_title) ? $field_title : 'Choose';

  if (!empty($terms)) { ?>
    <div class="bt-form-field bt-field-type-radio <?php echo 'bt-field-' . $slug; ?>">
      <div class="bt-field-title"><?php echo esc_html($field_title_default) ?></div>
      <?php foreach ($terms as $term) { ?>
        <?php if ($term->slug == $field_value) { ?>
          <div class="item-radio">
            <input type="radio" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($term->slug); ?>" value="<?php echo esc_attr($term->slug); ?>" checked>
            <label for="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?> </label>
            <span class="bt-count"><?php echo '(' . $term->count . ')'; ?></span>
          </div>
        <?php } else { ?>
          <div class="item-radio">
            <input type="radio" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($term->slug); ?>" value="<?php echo esc_attr($term->slug); ?>">
            <label for="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?> </label>
            <span class="bt-count"><?php echo '(' . $term->count . ')'; ?></span>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  <?php }
}

function cleanira_product_field_multiple_html($slug = '', $field_title = '', $field_value = '')
{
  if (empty($slug)) {
    return;
  }

  $terms = get_terms(array(
    'taxonomy' => $slug,
    'hide_empty' => true
  ));

  if (!empty($terms)) {
  ?>
    <div class="bt-form-field bt-field-type-multi" data-name="<?php echo esc_attr($slug); ?>">
      <?php
      if (!empty($field_title)) {
        echo '<div class="bt-field-title">' . $field_title . '</div>';
      }
      ?>

      <div class="bt-field-list">
        <?php foreach ($terms as $term) { ?>
          <div class="<?php echo (str_contains($field_value, $term->slug)) ? 'bt-field-item checked' : 'bt-field-item' ?>">
            <a href="#" data-slug="<?php echo esc_attr($term->slug); ?>">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M28.1489 8.44723C28.6566 8.98059 28.6358 9.82456 28.1025 10.3323L12.6951 24.9989C12.4319 25.2494 12.078 25.3817 11.7151 25.3652C11.3522 25.3486 11.0118 25.1848 10.7725 24.9114L4.8466 18.1422C4.36156 17.5882 4.41752 16.7458 4.97159 16.2607C5.52565 15.7757 6.36802 15.8317 6.85306 16.3857L11.8633 22.109L26.2639 8.4008C26.7972 7.89308 27.6412 7.91387 28.1489 8.44723Z" fill="white" />
                </svg>
              </span>
              <?php echo esc_html($term->name); ?>
              <div class="bt-count"><?php echo '(' . $term->count . ')'; ?></div>
            </a>
          </div>
        <?php } ?>
      </div>

      <input type="hidden" name="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr($field_value); ?>">
    </div>
  <?php
  }
}

function cleanira_product_field_price_slider($field_title = '', $field_min_value = '', $field_max_value = '')
{
  $prices = cleanira_highest_and_lowest_product_price();
  $currency_symbol = get_woocommerce_currency_symbol();
  if ($prices['lowest_price'] == $prices['highest_price']) {
    return;
  }

  $start_min_value = !empty($field_min_value) ? $field_min_value : $prices['lowest_price'];
  $start_max_value = !empty($field_max_value) ? $field_max_value : $prices['highest_price'];

  ?>
  <div class="bt-form-field bt-field-price">
    <?php
    if (!empty($field_title)) {
      echo '<div class="bt-field-title">' . $field_title . '</div>';
    }
    ?>
    <div id="bt-price-slider" data-range-min="<?php echo intval($prices['lowest_price']); ?>" data-range-max="<?php echo intval($prices['highest_price']); ?>" data-start-min="<?php echo intval($start_min_value); ?>" data-start-max="<?php echo intval($start_max_value); ?>"></div>
    <div class="bt-field-price-options">
      <div class="bt-field-min-price">
        <label for="bt-min-price"><?php esc_html_e('Min price', 'cleanira') ?></label>
        <input type="number" id="bt-min-price" name="min_price" value="" placeholder="<?php echo esc_attr($start_min_value); ?>">
        <span class="bt-currency"><?php echo esc_attr($currency_symbol); ?></span>
      </div>
      <div class="bt-field-max-price">
        <label for="bt-max-price"><?php esc_html_e('Max price', 'cleanira') ?></label>
        <input type="number" id="bt-max-price" name="max_price" value="" placeholder="<?php echo esc_attr($start_max_value); ?>">
        <span class="bt-currency"><?php echo esc_attr($currency_symbol); ?></span>
      </div>
    </div>
  </div>
<?php
}
function cleanira_product_field_rating($slug = '', $field_title = '', $field_value = '')
{
  if (empty($slug)) {
    return;
  }

  $field_title_default = !empty($field_title) ? $field_title : 'Choose';
?>
  <div class="bt-form-field bt-field-type-rating <?php echo 'bt-field-' . $slug; ?>">
    <div class="bt-field-title"><?php echo esc_html($field_title_default) ?></div>
    <?php for ($rating = 5; $rating >= 1; $rating--) {
      $stars = str_repeat('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
  <path d="M14.6431 7.17815L11.8306 9.60502L12.6875 13.2344C12.7347 13.4314 12.7226 13.638 12.6525 13.8281C12.5824 14.0182 12.4575 14.1833 12.2937 14.3025C12.1298 14.4217 11.9343 14.4896 11.7319 14.4977C11.5294 14.5059 11.3291 14.4538 11.1562 14.3481L7.99996 12.4056L4.84184 14.3481C4.66898 14.4532 4.4689 14.5048 4.2668 14.4963C4.06469 14.4879 3.8696 14.4199 3.70609 14.3008C3.54257 14.1817 3.41795 14.0169 3.3479 13.8272C3.27786 13.6374 3.26553 13.4312 3.31246 13.2344L4.17246 9.60502L1.35996 7.17815C1.20702 7.04597 1.09641 6.87166 1.04195 6.67699C0.987486 6.48232 0.99158 6.27592 1.05372 6.08356C1.11586 5.89121 1.23329 5.72142 1.39135 5.59541C1.54941 5.4694 1.7411 5.39274 1.94246 5.37502L5.62996 5.07752L7.05246 1.63502C7.12946 1.44741 7.26051 1.28693 7.42894 1.17398C7.59738 1.06104 7.7956 1.00073 7.9984 1.00073C8.2012 1.00073 8.39942 1.06104 8.56785 1.17398C8.73629 1.28693 8.86734 1.44741 8.94434 1.63502L10.3662 5.07752L14.0537 5.37502C14.2555 5.39209 14.4477 5.46831 14.6064 5.59415C14.765 5.71999 14.883 5.88984 14.9455 6.08243C15.008 6.27502 15.0123 6.48178 14.9579 6.6768C14.9034 6.87183 14.7926 7.04644 14.6393 7.17877L14.6431 7.17815Z" fill="#212121"/>
</svg>', $rating) . str_repeat('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
  <path d="M14.9483 6.07866C14.8858 5.88649 14.7678 5.71712 14.6092 5.59189C14.4506 5.46665 14.2585 5.39116 14.0571 5.37491L10.3696 5.07741L8.9458 1.63429C8.86881 1.44667 8.73776 1.28619 8.56932 1.17325C8.40088 1.06031 8.20267 1 7.99987 1C7.79707 1 7.59885 1.06031 7.43041 1.17325C7.26197 1.28619 7.13093 1.44667 7.05393 1.63429L5.63143 5.07679L1.94205 5.37491C1.74029 5.39198 1.54805 5.4682 1.38941 5.59404C1.23078 5.71988 1.11281 5.88974 1.05028 6.08232C0.987751 6.27491 0.983448 6.48167 1.03791 6.67669C1.09237 6.87172 1.20317 7.04633 1.35643 7.17866L4.16893 9.60554L3.31205 13.2343C3.26413 13.4314 3.27586 13.6384 3.34577 13.8288C3.41567 14.0193 3.54058 14.1847 3.70465 14.304C3.86873 14.4234 4.06456 14.4913 4.26729 14.4991C4.47002 14.5069 4.67051 14.4544 4.8433 14.348L7.99955 12.4055L11.1577 14.348C11.3305 14.4531 11.5306 14.5047 11.7327 14.4962C11.9348 14.4878 12.1299 14.4198 12.2934 14.3007C12.4569 14.1816 12.5816 14.0168 12.6516 13.8271C12.7217 13.6373 12.734 13.431 12.6871 13.2343L11.8271 9.60491L14.6396 7.17804C14.7941 7.04593 14.9059 6.87094 14.9608 6.67523C15.0158 6.47952 15.0114 6.27189 14.9483 6.07866ZM13.9896 6.42054L10.9458 9.04554C10.8764 9.10537 10.8248 9.18312 10.7965 9.27031C10.7683 9.3575 10.7646 9.45076 10.7858 9.53992L11.7158 13.4649C11.7182 13.4703 11.7184 13.4765 11.7165 13.482C11.7145 13.4876 11.7105 13.4922 11.7052 13.4949C11.6939 13.5037 11.6908 13.5018 11.6814 13.4949L8.26143 11.3918C8.18266 11.3434 8.09201 11.3177 7.99955 11.3177C7.90709 11.3177 7.81644 11.3434 7.73768 11.3918L4.31768 13.4962C4.3083 13.5018 4.3058 13.5037 4.29393 13.4962C4.28865 13.4935 4.28461 13.4889 4.28263 13.4833C4.28066 13.4777 4.2809 13.4716 4.2833 13.4662L5.2133 9.54117C5.2345 9.45201 5.23078 9.35875 5.20257 9.27156C5.17435 9.18437 5.12272 9.10662 5.0533 9.04679L2.00955 6.42179C2.00205 6.41554 1.99518 6.40991 2.00143 6.39054C2.00768 6.37116 2.01268 6.37366 2.02205 6.37241L6.01705 6.04991C6.10868 6.04206 6.19637 6.00908 6.27047 5.9546C6.34457 5.90013 6.40221 5.82628 6.43705 5.74116L7.9758 2.01554C7.9808 2.00491 7.98268 1.99991 7.99768 1.99991C8.01268 1.99991 8.01455 2.00491 8.01955 2.01554L9.56205 5.74116C9.59722 5.82631 9.65523 5.90008 9.72967 5.95434C9.80412 6.00861 9.89211 6.04125 9.98393 6.04866L13.9789 6.37116C13.9883 6.37116 13.9939 6.37116 13.9996 6.38929C14.0052 6.40741 13.9996 6.41429 13.9896 6.42054Z" fill="#212121"/>
</svg>', 5 - $rating);
    ?>
      <?php if ($rating == $field_value) { ?>
        <div class="item-rating">
          <span class="check-rating"></span>
          <input type="radio" name="<?php echo esc_attr($slug); ?>" id="<?php echo 'rating' . $rating ?>" value="<?php echo esc_attr($rating); ?>" checked>
          <?php
          echo '<label class="bt-star" for="rating' . $rating . '">' . $stars . '<span>' . esc_html__('& up', 'cleanira') . '</span></label>';
          ?>
          <span class="bt-count"><?php echo cleanira_get_products_by_rating($rating) ?></span>
        </div>
      <?php } else { ?>
        <div class="item-rating">
          <span class="check-rating"></span>
          <input type="radio" name="<?php echo esc_attr($slug); ?>" id="<?php echo 'rating' . $rating ?>" value="<?php echo esc_attr($rating); ?>">
          <?php
          echo '<label class="bt-star" for="rating' . $rating . '">' . $stars . '<span>' . esc_html__('& up', 'cleanira') . '</span></label>';
          ?>
          <span class="bt-count"><?php echo cleanira_get_products_by_rating($rating) ?></span>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
<?php
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
function cleanira_highest_and_lowest_product_price()
{
  $args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish'
  );

  $query = new WP_Query($args);

  $prices = [];

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $sale_price = get_post_meta(get_the_ID(), '_sale_price', true);
      if (!empty($sale_price)) {
        $prices[] = floatval($sale_price);
      } else {
        $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
        if (!empty($regular_price)) {
          $prices[] = floatval($regular_price);
        }
      }
    }

    if (!empty($prices)) {
      $highest_price = ceil(max($prices));
      $lowest_price = floor(min($prices));
      return array(
        'highest_price' => $highest_price,
        'lowest_price'  => $lowest_price
      );
    }
  }

  wp_reset_postdata();

  return array(
    'highest_price' => 0,
    'lowest_price'  => 0
  );
}
function cleanira_product_pagination($current_page, $total_page)
{
  if (1 >= $total_page) {
    return;
  }

  ob_start();
?>
  <nav class="bt-pagination bt-product-pagination" role="navigation">
    <?php if (1 != $current_page) { ?>
      <a class="prev page-numbers" href="#" data-page="<?php echo esc_attr($current_page - 1); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13" fill="none">
          <path d="M0.839282 12.4903C0.630446 12.2842 0.611461 11.9616 0.782327 11.7343L0.839282 11.6692L5.91327 6.6604L0.839282 1.65162C0.630446 1.44548 0.611461 1.1229 0.782327 0.895592L0.839282 0.830468C1.04812 0.624326 1.37491 0.605586 1.6052 0.774247L1.67117 0.830468L7.16137 6.24982C7.3702 6.45596 7.38919 6.77854 7.21832 7.00585L7.16137 7.07098L1.67117 12.4903C1.44145 12.7171 1.069 12.7171 0.839282 12.4903Z" fill="#212121"></path>
        </svg> <?php echo esc_html__('Prev', 'cleanira'); ?></a>
    <?php } ?>

    <?php
    for ($i = 1; $i <= $total_page; $i++) {
      if (7 > $total_page) {
        if ($i == $current_page) {
          echo '<span class="page-numbers current">' . $i . '</span>';
        } else {
          echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
        }
      } else {
        if ($i == $current_page) {
          echo '<span class="page-numbers current">' . $i . '</span>';
        }

        if (5 > $current_page) {
          if ($i != $current_page && $i < $current_page + 3) {
            echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
          }

          if ($i == $current_page + 3) {
            echo '<span class="page-numbers dots">...</span>';
          }

          if ($i == $total_page) {
            echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
          }
        }

        if ($total_page - 4 < $current_page) {
          if ($i != $current_page && $i > $current_page - 3) {
            echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
          }

          if ($i == $current_page - 3) {
            echo '<span class="page-numbers dots">...</span>';
          }

          if ($i == 1) {
            echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
          }
        }

        if ($total_page - 4 >= $current_page && 5 <= $current_page) {
          if ($i != $current_page && $i > $current_page - 3 && $i < $current_page + 3) {
            echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
          }

          if ($i == $current_page - 3 || $i == $current_page + 3) {
            echo '<span class="page-numbers dots">...</span>';
          }

          if ($i == 1) {
            echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
          }

          if ($i == $total_page) {
            echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
          }
        }
      }
    }
    ?>

    <?php if ($total_page != $current_page) { ?>
      <a class="next page-numbers" href="#" data-page="<?php echo esc_attr($current_page + 1); ?>"><?php echo esc_html__('Next', 'cleanira'); ?><svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13" fill="none">
          <path d="M0.839282 12.4903C0.630446 12.2842 0.611461 11.9616 0.782327 11.7343L0.839282 11.6692L5.91327 6.6604L0.839282 1.65162C0.630446 1.44548 0.611461 1.1229 0.782327 0.895592L0.839282 0.830468C1.04812 0.624326 1.37491 0.605586 1.6052 0.774247L1.67117 0.830468L7.16137 6.24982C7.3702 6.45596 7.38919 6.77854 7.21832 7.00585L7.16137 7.07098L1.67117 12.4903C1.44145 12.7171 1.069 12.7171 0.839282 12.4903Z" fill="#212121"></path>
        </svg></a>
    <?php } ?>
  </nav>
  <?php
  return ob_get_clean();
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

  if (isset($params['sort_order']) && $params['sort_order'] != '') {
    if ($params['sort_order'] == 'date_high' || $params['sort_order'] == 'date_low') {
      $query_args['orderby'] = 'date';

      if ($params['sort_order'] == 'date_high') {
        $query_args['order'] = 'DESC';
      } else {
        $query_args['order'] = 'ASC';
      }
    }
    if ($params['sort_order'] == 'price_high' || $params['sort_order'] == 'price_low') {
      $query_args['meta_key'] = '_price';
      $query_args['orderby'] = 'meta_value_num';

      if ($params['sort_order'] == 'price_high') {
        $query_args['order'] = 'DESC';
      } else {
        $query_args['order'] = 'ASC';
      }
    }
    if ($params['sort_order'] == 'best_selling') {
      $query_args['meta_key'] = 'total_sales';
      $query_args['orderby'] = 'meta_value_num';
      $query_args['order'] = 'DESC';
    }
    if ($params['sort_order'] == 'average_rating') {
      $query_args['meta_key'] = '_wc_average_rating';
      $query_args['orderby'] = 'meta_value_num';
      $query_args['order'] = 'DESC';
    }
  }

  $query_tax = array();

  if (isset($params['product_cat']) && $params['product_cat'] != '') {
    $query_tax[] = array(
      'taxonomy' => 'product_cat',
      'field' => 'slug',
      'terms' => explode(',', $params['product_cat'])
    );
  }
  if (isset($params['product_brand']) && $params['product_brand'] != '') {
    $query_tax[] = array(
      'taxonomy' => 'product_brand',
      'field' => 'slug',
      'terms' => explode(',', $params['product_brand'])
    );
  }
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
  if (isset($params['product_rating']) && $params['product_rating'] != '') {
    $query_meta['rating_clause'] = array(
      array(
        'key' => '_wc_average_rating',
        'value' => $params['product_rating'],
        'compare' => '=',
        'type'    => 'NUMERIC'
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
  $limit = get_option('woocommerce_catalog_rows') * get_option('woocommerce_catalog_columns');
  $query_args = cleanira_products_query_args($_POST, $limit);
  $wp_query = new \WP_Query($query_args);
  $current_page = isset($_POST['current_page']) && $_POST['current_page'] != '' ? absint($_POST['current_page']) : 1;
  $total_page = $wp_query->max_num_pages;

  $paged = !empty($wp_query->query_vars['paged']) ? $wp_query->query_vars['paged'] : 1;

  $total_products = $wp_query->found_posts;

  // Update Results Block
  ob_start();
  if ($total_products > 0) {
    printf(
      __('%s Products Recommended for You', 'cleanira'),
      '<span class="highlight">' . esc_html($total_products) . '</span>'
    );
  } else {
    echo esc_html__('No results', 'cleanira');
  }
  $output['results'] = ob_get_clean();

  // Update Loop Post
  if ($wp_query->have_posts()) {
    ob_start();
    while ($wp_query->have_posts()) {
      $wp_query->the_post();
      wc_get_template_part('content', 'product');
    }

    $output['items'] = ob_get_clean();
    $output['pagination'] = cleanira_product_pagination($current_page, $total_page);
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
  $ex_items = count($product_ids) < 3 ? 3 - count($product_ids) : 0;
  if (isset($_COOKIE['productcomparecookie']) && !empty($_COOKIE['productcomparecookie'])) {
    $productcompare = $_COOKIE['productcomparecookie'];
    $product_ids = explode(',', $productcompare);
  }
  $ex_items = count($product_ids) < 3 ? 3 - count($product_ids) : 0;
  ob_start();
  if (!empty($product_ids)) {
  ?>
    <div class="bt-table-title">
      <h2><?php esc_html_e('Compare products', 'cleanira') ?></h2>
    </div>
    <div class="bt-table-compare">
      <div class="bt-table--head">
        <div class="bt-table--col"><?php esc_html_e('Thumbnail', 'cleanira') ?></div>
        <div class="bt-table--col"><?php esc_html_e('Product Name', 'cleanira') ?></div>
        <div class="bt-table--col"><?php esc_html_e('Price', 'cleanira') ?></div>
        <div class="bt-table--col"><?php esc_html_e('Stock status', 'cleanira') ?></div>
        <div class="bt-table--col"><?php esc_html_e('Rating', 'cleanira') ?></div>
        <div class="bt-table--col"><?php esc_html_e('Brand', 'cleanira') ?></div>
        <div class="bt-table--col"></div>
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
            $stock_status = $product->is_in_stock() ? __('In Stock', 'cleanira') : __('Out of Stock', 'cleanira');
            $brand = wp_get_post_terms($id, 'product_brand', ['fields' => 'names']);
            $brand_list = !empty($brand) ? implode(', ', $brand) : '';

            $brands = wp_get_post_terms($id, 'product_brand', ['fields' => 'all']);
            $brand_links = [];
            foreach ($brands as $brand) {
              $brand_links[] = '<a href="' . get_term_link($brand) . '">' . esc_html($brand->name) . '</a>';
            }
            $brand_list = !empty($brand_links) ? implode(', ', $brand_links) : '';

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
                <?php echo '<p>' . $product_price . '</p>'; ?>
              </div>
              <div class="bt-table--col bt-stock">
                <?php echo '<p>' . $stock_status . '</p>'; ?>
              </div>
              <div class="bt-table--col bt-rating">
                <div class="bt-product-rating">
                  <?php echo wc_get_rating_html($product->get_average_rating());  ?>
                  <?php if ($product->get_rating_count()): ?>
                    <div class="bt-product-rating--count">
                      (<?php echo $product->get_rating_count(); ?>)
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="bt-table--col bt-brand">
                <?php echo '<p>' . $brand_list . '</p>'; ?>
              </div>
              <div class="bt-table--col bt-add-to-cart">
                <a href="?add-to-cart=<?php echo $id; ?>" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_<?php echo $id; ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $id; ?>" data-product_sku="" rel="nofollow"><?php esc_attr_e('Add to cart', 'cleanira') ?></a>
              </div>
            </div>
        <?php
          }
        }
        ?>
        <?php
        if ($ex_items > 0) {
          for ($i = 0; $i < $ex_items; $i++) {
        ?>
            <div class="bt-table--row bt-product-add-compare">
              <div class="bt-table--col bt-thumb">
                <div class="bt-cover-image">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
                    <path d="M256 512a25 25 0 0 1-25-25V25a25 25 0 0 1 50 0v462a25 25 0 0 1-25 25z"></path>
                    <path d="M487 281H25a25 25 0 0 1 0-50h462a25 25 0 0 1 0 50z"></path>
                  </svg>
                  <span> <?php echo __('Add Product To Compare', 'autoart'); ?></span>
                </div>
              </div>
              <div class="bt-table--col bt-name">

              </div>
              <div class="bt-table--col bt-price">

              </div>
              <div class="bt-table--col bt-stock">
              </div>
              <div class="bt-table--col bt-rating">
              </div>
              <div class="bt-table--col bt-brand">
              </div>
              <div class="bt-table--col bt-add-to-cart">

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


function cleanira_products_wishlist()
{
  if (isset($_POST['productwishlistcookie']) && !empty($_POST['productwishlistcookie'])) {
    $product_ids = explode(',', $_COOKIE['productwishlistcookie']);
    $output['count'] = count($product_ids);

    ob_start();
    foreach ($product_ids as $product_id) {
      $product = wc_get_product($product_id);
      if ($product) {
        $product_price = $product->get_price_html();
        $stock_status = $product->is_in_stock() ? __('In Stock', 'cleanira') : __('Out of Stock', 'cleanira');
    ?>
        <div class="bt-table--row bt-product-item">
          <div class="bt-table--col bt-product-remove">
            <a href="#" data-id="<?php echo esc_attr($product_id); ?>" class="bt-product-remove-wishlist">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                <path d="M9.64052 9.10965C9.67536 9.14449 9.703 9.18586 9.72186 9.23138C9.74071 9.2769 9.75042 9.32569 9.75042 9.37496C9.75042 9.42424 9.74071 9.47303 9.72186 9.51855C9.703 9.56407 9.67536 9.60544 9.64052 9.64028C9.60568 9.67512 9.56432 9.70276 9.51879 9.72161C9.47327 9.74047 9.42448 9.75017 9.37521 9.75017C9.32594 9.75017 9.27714 9.74047 9.23162 9.72161C9.1861 9.70276 9.14474 9.67512 9.1099 9.64028L6.00021 6.53012L2.89052 9.64028C2.82016 9.71064 2.72472 9.75017 2.62521 9.75017C2.5257 9.75017 2.43026 9.71064 2.3599 9.64028C2.28953 9.56991 2.25 9.47448 2.25 9.37496C2.25 9.27545 2.28953 9.18002 2.3599 9.10965L5.47005 5.99996L2.3599 2.89028C2.28953 2.81991 2.25 2.72448 2.25 2.62496C2.25 2.52545 2.28953 2.43002 2.3599 2.35965C2.43026 2.28929 2.5257 2.24976 2.62521 2.24976C2.72472 2.24976 2.82016 2.28929 2.89052 2.35965L6.00021 5.46981L9.1099 2.35965C9.18026 2.28929 9.2757 2.24976 9.37521 2.24976C9.47472 2.24976 9.57016 2.28929 9.64052 2.35965C9.71089 2.43002 9.75042 2.52545 9.75042 2.62496C9.75042 2.72448 9.71089 2.81991 9.64052 2.89028L6.53036 5.99996L9.64052 9.10965Z" fill="#C72929" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="#C72929">
                <path d="M493.815 70.629c-11.001-1.003-20.73 7.102-21.733 18.102l-2.65 29.069C424.473 47.194 346.429 0 256 0 158.719 0 72.988 55.522 30.43 138.854c-5.024 9.837-1.122 21.884 8.715 26.908 9.839 5.024 21.884 1.123 26.908-8.715C102.07 86.523 174.397 40 256 40c74.377 0 141.499 38.731 179.953 99.408l-28.517-20.367c-8.989-6.419-21.48-4.337-27.899 4.651-6.419 8.989-4.337 21.479 4.651 27.899l86.475 61.761c12.674 9.035 30.155.764 31.541-14.459l9.711-106.53c1.004-11.001-7.1-20.731-18.1-21.734zM472.855 346.238c-9.838-5.023-21.884-1.122-26.908 8.715C409.93 425.477 337.603 472 256 472c-74.377 0-141.499-38.731-179.953-99.408l28.517 20.367c8.989 6.419 21.479 4.337 27.899-4.651 6.419-8.989 4.337-21.479-4.651-27.899l-86.475-61.761c-12.519-8.944-30.141-.921-31.541 14.459L.085 419.637c-1.003 11 7.102 20.73 18.101 21.733 11.014 1.001 20.731-7.112 21.733-18.102l2.65-29.069C87.527 464.806 165.571 512 256 512c97.281 0 183.012-55.522 225.57-138.854 5.024-9.837 1.122-21.884-8.715-26.908z"></path>
              </svg>
            </a>
          </div>
          <div class="bt-table--col bt-product-thumb">
            <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="bt-thumb">
              <?php echo $product->get_image('medium'); ?>
            </a>
          </div>
          <div class="bt-table--col bt-product-title">
            <h3 class="bt-title">
              <a href="<?php echo esc_url(get_permalink($product_id)); ?>">
                <?php echo $product->get_name(); ?>
              </a>
            </h3>
          </div>
          <div class="bt-table--col bt-product-price">
            <?php
            if ($product_price) {
              echo '<span>' . $product_price . '</span>';
            }
            ?>
          </div>
          <div class="bt-table--col bt-product-stock">
            <span><?php echo esc_html($stock_status); ?></span>
          </div>
          <div class="bt-table--col bt-product-add-to-cart">
            <a href="?add-to-cart=<?php echo esc_attr($product_id); ?>" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_<?php echo esc_attr($product_id); ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr($product_id); ?>" data-product_sku="" rel="nofollow"><?php esc_attr_e('Add to cart', 'cleanira') ?></a>
          </div>
        </div>
<?php }
    }
    $output['items'] = ob_get_clean();
  } else {
    $output['items'] = '<div class="bt-no-results">' . __('Post not found!', 'cleanira') . '<a href="/shop/">' . __('Back to Shop', 'cleanira') . '</a></div>';
  }

  wp_send_json_success($output);

  die();
}
add_action('wp_ajax_cleanira_products_wishlist', 'cleanira_products_wishlist');
add_action('wp_ajax_nopriv_cleanira_products_wishlist', 'cleanira_products_wishlist');
