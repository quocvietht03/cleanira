<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop');
get_template_part('framework/templates/site', 'titlebar');
if (function_exists('get_field')) {
	$template_section = get_field('template_section_appointment', 'options');
}
$product_id = get_the_ID();
$product = wc_get_product($product_id);
$product_type = $product->get_type();
?>
<main id="bt_main" class="bt-site-main <?php echo ($product_type == 'redq_rental') ? 'bt-site-appointment' : ''; ?>">
	<div class="bt-main-content">
		<div class="bt-main-product-ss">
			<div class="bt-container">

				<?php while (have_posts()) : ?>
					<?php the_post();
				
					if ($product_type == 'redq_rental') {
						wc_get_template_part('content', 'single-appointment');
					} else {
						wc_get_template_part('content', 'single-product');
					}
					?>

				<?php endwhile; // end of the loop. 
				?>

			</div>
		</div>
	</div>
</main>
<?php
if ($product_type == 'redq_rental') {
	if (!empty($template_section['template_section_bottom_appointment'])) {
		foreach ($template_section['template_section_bottom_appointment'] as $key => $item) {
			$id_template = $item->ID;
			echo do_shortcode('[elementor-template id="' . esc_attr($id_template) . '"]');
		}
	}
}
?>
<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
