<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

global $wp_query;
$total_products = $wp_query->found_posts;

get_header( 'shop' );
get_template_part( 'framework/templates/site', 'titlebar');

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content">
		<div class="bt-main-products-ss">
			<div class="bt-container">
				<div class="bt-products-sidebar">
					<?php get_template_part( 'woocommerce/sidebar', 'product'); ?>
				</div>
				<div class="bt-main-products-inner">
					<div class="bt-spinner"><?php echo cleanira_get_icon_svg_html('img-spinner-loading'); ?></div>
					<div class="bt-products-topbar">
						<div class="bt-results-count"><?php echo $total_products ?> Products Recommended for You</div>
						<div class="bt-results-orderby">
							<label for="bt-results-sort-field">Sort by:</label>
							<select name="bt_product_results_orderby" id="bt-results-sort-field">
								<option value="date_desc">Date: latest first</option>
								<option value="date_asc">Date: oldest first</option>
								<option value="popularity">Popularity</option>
								<option value="rating">Average Rating</option>
								<option value="price_desc">Price: high to low</option>
								<option value="price_asc">Price: low to high</option>
							</select>
						</div>
					</div>
					<div class="bt-product-layout">
					<?php
					if ( woocommerce_product_loop() ) {		

						woocommerce_product_loop_start();

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						}

						woocommerce_product_loop_end();

						/**
						 * Hook: woocommerce_after_shop_loop.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					} else {
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						//do_action( 'woocommerce_no_products_found' );
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
get_footer( 'shop' );
