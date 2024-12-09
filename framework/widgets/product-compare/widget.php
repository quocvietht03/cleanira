<?php

namespace CleaniraElementorWidgets\Widgets\ProductCompare;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_ProductCompare extends Widget_Base
{

	public function get_name()
	{
		return 'bt-product-compare';
	}

	public function get_title()
	{
		return __('Product Compare', 'cleanira');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['cleanira'];
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __('Layout', 'cleanira'),
			]
		);

		$this->end_controls_section();
	}


	protected function register_style_section_controls()
	{
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'cleanira'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{

		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	public function post_social_share()
	{

		$social_item = array();
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-facebook" data-toggle="tooltip" title="' . esc_attr__('Facebook', 'cleanira') . '" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                            <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                          </svg>
                        </a>
                      </li>';
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-twitter" data-toggle="tooltip" title="' . esc_attr__('Twitter', 'cleanira') . '" href="https://twitter.com/share?url=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                          </svg>
                        </a>
                      </li>';
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-google-plus" data-toggle="tooltip" title="' . esc_attr__('Google Plus', 'cleanira') . '" href="https://plus.google.com/share?url=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512">
                            <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                          </svg>
                        </a>
                      </li>';
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-linkedin" data-toggle="tooltip" title="' . esc_attr__('Linkedin', 'cleanira') . '" href="https://www.linkedin.com/shareArticle?url=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                          </svg>
                        </a>
                      </li>';
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-pinterest" data-toggle="tooltip" title="' . esc_attr__('Pinterest', 'cleanira') . '" href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 496 512">
                            <path d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/>
                          </svg>
                        </a>
                      </li>';

		ob_start();
?>
		<div class="bt-post-share">
			<?php
			if (!empty($social_item)) {
				echo '<span>' . esc_html__('Share: ', 'cleanira') . '</span><ul>' . implode(' ', $social_item) . '</ul>';
			}
			?>
		</div>
	<?php
		return ob_get_clean();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$productcompare = '';
		$product_ids = array();
		$ex_items = count($product_ids) < 3 ? 3 - count($product_ids) : 0;
		if (isset($_COOKIE['productcomparecookie']) && !empty($_COOKIE['productcomparecookie'])) {
			$productcompare = $_COOKIE['productcomparecookie'];
			$product_ids = explode(',', $productcompare);
		}
		$ex_items = count($product_ids) < 3 ? 3 - count($product_ids) : 0;
	?>
		<div class="bt-elwg-products-compare--default">
			<div class="bt-popup-compare bt-compare-elwwg">
				<div class="bt-compare-body woocommerce">
					<div class="bt-loading-wave"></div>
					<div class="bt-compare-load">

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
												<div class="bt-remove-item" data-id="<?php echo esc_attr($id) ?>">
													<div class="bt-icon">
													<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
														<path d="M9.64052 9.10965C9.67536 9.14449 9.703 9.18586 9.72186 9.23138C9.74071 9.2769 9.75042 9.32569 9.75042 9.37496C9.75042 9.42424 9.74071 9.47303 9.72186 9.51855C9.703 9.56407 9.67536 9.60544 9.64052 9.64028C9.60568 9.67512 9.56432 9.70276 9.51879 9.72161C9.47327 9.74047 9.42448 9.75017 9.37521 9.75017C9.32594 9.75017 9.27714 9.74047 9.23162 9.72161C9.1861 9.70276 9.14474 9.67512 9.1099 9.64028L6.00021 6.53012L2.89052 9.64028C2.82016 9.71064 2.72472 9.75017 2.62521 9.75017C2.5257 9.75017 2.43026 9.71064 2.3599 9.64028C2.28953 9.56991 2.25 9.47448 2.25 9.37496C2.25 9.27545 2.28953 9.18002 2.3599 9.10965L5.47005 5.99996L2.3599 2.89028C2.28953 2.81991 2.25 2.72448 2.25 2.62496C2.25 2.52545 2.28953 2.43002 2.3599 2.35965C2.43026 2.28929 2.5257 2.24976 2.62521 2.24976C2.72472 2.24976 2.82016 2.28929 2.89052 2.35965L6.00021 5.46981L9.1099 2.35965C9.18026 2.28929 9.2757 2.24976 9.37521 2.24976C9.47472 2.24976 9.57016 2.28929 9.64052 2.35965C9.71089 2.43002 9.75042 2.52545 9.75042 2.62496C9.75042 2.72448 9.71089 2.81991 9.64052 2.89028L6.53036 5.99996L9.64052 9.10965Z" fill="#212121" />
													</svg>
													</div>
												</div>
												<a href="<?php echo esc_url($product_url); ?>">
													<img src="<?php echo esc_url($product_image_url); ?>" alt="<?php echo esc_attr($product_name); ?>">

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
											<div class="bt-table--col bt-rating ">
												<div class="bt-product-rating">
													<?php echo wc_get_rating_html($product->get_average_rating());  ?>
													<?php if ($product->get_rating_count()): ?>
														<div class="bt-product-rating--count">
															(<?php echo esc_html($product->get_rating_count()); ?>)
														</div>
													<?php endif; ?>
												</div>
											</div>
											<div class="bt-table--col bt-brand">
												<?php echo '<p>' . $brand_list . '</p>'; ?>
											</div>
											<div class="bt-table--col bt-add-to-cart">
												<a href="?add-to-cart=<?php echo esc_attr($id); ?>" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_<?php echo esc_attr($id); ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr($id); ?>" data-product_sku="" rel="nofollow"><?php echo esc_html__('Add to cart', 'cleanira') ?></a>
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
													<span> <?php echo __('Add Product To Compare', 'cleanira'); ?></span>
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
					</div>
					<?php echo '<div class="bt-compare-share bt-social-share">' . $this->post_social_share() . '</div>'; ?>
				</div>
			</div>
		</div>
<?php
	}

	protected function content_template() {}
}
