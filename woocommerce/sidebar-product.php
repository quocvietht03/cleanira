<?php

/**
 * The Template for displaying products filters
 *
 * @version 1.0.0
 */

defined('ABSPATH') || exit;
?>
<div class="bt-product-sidebar">
  <form class="bt-product-filter-form" action="" method="get">
    <h2 class="bt-form-title">
      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
        <path d="M25.2223 5.41737C25.0877 5.10621 24.8645 4.84151 24.5806 4.65618C24.2966 4.47086 23.9645 4.37308 23.6255 4.37503H4.37546C4.03676 4.3757 3.70553 4.47464 3.42196 4.65985C3.13838 4.84506 2.91465 5.10858 2.77789 5.41845C2.64114 5.72831 2.59724 6.07121 2.65153 6.40553C2.70582 6.73985 2.85596 7.05123 3.08374 7.3019L3.09249 7.31175L10.5005 15.2217V23.625C10.5004 23.9418 10.5863 24.2526 10.749 24.5243C10.9116 24.7961 11.145 25.0186 11.4242 25.1681C11.7034 25.3176 12.018 25.3886 12.3343 25.3734C12.6507 25.3582 12.957 25.2575 13.2206 25.0819L16.7206 22.7478C16.9605 22.588 17.1573 22.3714 17.2933 22.1172C17.4294 21.8631 17.5005 21.5793 17.5005 21.291V15.2217L24.9095 7.31175L24.9183 7.3019C25.1485 7.05238 25.3 6.74058 25.3541 6.40543C25.4082 6.07028 25.3624 5.72663 25.2223 5.41737ZM15.9889 14.2822C15.8375 14.4427 15.7524 14.6544 15.7505 14.875V21.291L12.2505 23.625V14.875C12.2505 14.6528 12.1661 14.4389 12.0142 14.2767L4.37546 6.12503H23.6255L15.9889 14.2822Z" fill="#212121" />
      </svg>
      <span><?php echo esc_html_e( 'Filters', 'cleanira' ) ?></span>
    </h2>
    <div class="bt-product-filter-fields">
      <!--Sort order-->
      <input type="hidden" class="bt-product-sort-order" name="sort_order" value="<?php if (isset($_GET['sort_order'])) echo esc_attr($_GET['sort_order']); ?>">

      <!--View current page-->
      <input type="hidden" class="bt-product-current-page" name="current_page" value="<?php echo isset($_GET['current_page']) ? esc_attr($_GET['current_page']) : ''; ?>">

      <div class="bt-form-field bt-field-type-search">
        <input type="text" name="search_keyword" value="<?php if (isset($_GET['search_keyword'])) echo esc_attr($_GET['search_keyword']); ?>" placeholder="<?php esc_attr_e('Search …', 'cleanira'); ?>">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 6.35 6.35" fill="currentColor">
            <path d="M2.894.511a2.384 2.384 0 0 0-2.38 2.38 2.386 2.386 0 0 0 2.38 2.384c.56 0 1.076-.197 1.484-.523l.991.991a.265.265 0 0 0 .375-.374l-.991-.992a2.37 2.37 0 0 0 .523-1.485C5.276 1.58 4.206.51 2.894.51zm0 .53c1.026 0 1.852.825 1.852 1.85S3.92 4.746 2.894 4.746s-1.851-.827-1.851-1.853.825-1.852 1.851-1.852z"></path>
          </svg>
        </a>
      </div>
      <div class="bt-form-field bt-field-price">
        <label for="bt-price-slider">Price</label>
        <div id="bt-price-slider"></div>
        <div class="bt-field-price-options">
          <div class="bt-field-min-price">
            <label for="bt-min-price">Min price</label>
            <input type="number" id="bt-min-price" name="min_price" value="">
          </div>
          <div class="bt-field-max-price">
            <label for="bt-max-price">Max price</label>
            <input type="number" id="bt-max-price" name="max_price" value="">
          </div>
        </div>
      </div>

      <div class="bt-form-action">
        <a href="#" class="bt-reset-btn disable">
          <?php echo esc_html__('Reset All', 'cleanira'); ?>
        </a>
      </div>
    </div>
  </form>
</div>

<div class="bt-sidebar-overlay"></div>