<?php

namespace CleaniraElementorWidgets\Widgets\ServicesList;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_ServicesList extends Widget_Base
{

	public function get_name()
	{
		return 'bt-services-list';
	}

	public function get_title()
	{
		return __('Services List', 'cleanira');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['cleanira'];
	}

	protected function get_supported_ids()
	{
		$supported_ids = [];

		$wp_query = new \WP_Query(array(
			'post_type' => 'service',
			'post_status' => 'publish',
			'posts_per_page' => -1
		));

		if ($wp_query->have_posts()) {
			while ($wp_query->have_posts()) {
				$wp_query->the_post();
				$supported_ids[get_the_ID()] = get_the_title();
			}
		}

		return $supported_ids;
	}

	public function get_supported_taxonomies()
	{
		$supported_taxonomies = [];

		$categories = get_terms(array(
			'taxonomy' => 'service_categories',
			'hide_empty' => false,
		));
		if (!empty($categories)  && !is_wp_error($categories)) {
			foreach ($categories as $category) {
				$supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	protected function register_query_section_controls()
	{
		$this->start_controls_section(
			'section_query',
			[
				'label' => __('Query', 'cleanira'),
			]
		);

		$this->start_controls_tabs('tabs_query');

		$this->start_controls_tab(
			'tab_query_include',
			[
				'label' => __('Include', 'cleanira'),
			]
		);

		$this->add_control(
			'ids',
			[
				'label' => __('Ids', 'cleanira'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __('Category', 'cleanira'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_query_exnlude',
			[
				'label' => __('Exclude', 'cleanira'),
			]
		);

		$this->add_control(
			'ids_exclude',
			[
				'label' => __('Ids', 'cleanira'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category_exclude',
			[
				'label' => __('Category', 'cleanira'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __('Offset', 'cleanira'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'description' => __('Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'cleanira'),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'orderby',
			[
				'label' => __('Order By', 'cleanira'),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __('Date', 'cleanira'),
					'post_title' => __('Title', 'cleanira'),
					'menu_order' => __('Menu Order', 'cleanira'),
					'rand' => __('Random', 'cleanira'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __('Order', 'cleanira'),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __('ASC', 'cleanira'),
					'desc' => __('DESC', 'cleanira'),
				],
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label' => __('Posts Per Page', 'cleanira'),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
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
		$this->add_responsive_control(
			'section_ratio',
			[
				'label' => __('Space Between', 'cleanira'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-service-list ' => 'grid-gap: {{SIZE}}px;',
				],
			]
		);
		$this->add_control(
			'icon_style',
			[
				'label' => __('Icon', 'cleanira'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __('Color', 'cleanira'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--icon svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => __('Title', 'cleanira'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Color', 'cleanira'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __('Color Hover', 'cleanira'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Typography', 'cleanira'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--title',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_query_section_controls();

		$this->register_style_section_controls();
	}

	public function query_posts()
	{
		$settings = $this->get_settings_for_display();

		$args = [
			'post_type' => 'service',
			'post_status' => 'publish',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
		];


		if (!empty($settings['ids'])) {
			$args['post__in'] = $settings['ids'];
		}

		if (!empty($settings['ids_exclude'])) {
			$args['post__not_in'] = $settings['ids_exclude'];
		}

		if (!empty($settings['category'])) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'service_categories',
					'terms' 		=> $settings['category'],
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
			);
		}

		if (!empty($settings['category_exclude'])) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'service_categories',
					'terms' 		=> $settings['category_exclude'],
					'field' 		=> 'term_id',
					'operator' 		=> 'NOT IN'
				)
			);
		}

		if (0 !== absint($settings['offset'])) {
			$args['offset'] = $settings['offset'];
		}

		return $query = new \WP_Query($args);
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$query = $this->query_posts();
		$placeholder_img_url = \Elementor\Utils::get_placeholder_image_src();

?>
		<div class="bt-elwg-service-list">
			<?php
			if ($query->have_posts()) {
			?>
				<div class="bt-service-list">
					<?php
					while ($query->have_posts()) : $query->the_post();
					$img_1 = get_field('image_template_1', get_the_ID());
					$img_1_url = !empty($img_1['url']) ? $img_1['url'] : $placeholder_img_url;
					$service_types = get_field('service_types', get_the_ID());
					?>
						<div class="bt-service-list-item bubble-container">
							<div class="bt-post--img">
								<img src="<?php echo esc_url( $img_1_url ) ?>" alt="">
							</div>
							<div class="bt-post--content">
								<?php echo cleanira_post_title_render(); ?>
								<?php if (!empty($service_types)): ?>
									<ul class="bt-service-types">
										<?php foreach ($service_types as $type): ?>
											<li class="bt-type-item"><?php echo esc_html( $type['name'] ) ?></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
								<?php echo cleanira_service_button_book_now_render('Request An Estimate'); ?>
							</div>
							<!-- Small, medium, and large bubbles -->
							<?php 
								for ($i = 1; $i <= 10; $i++): 
									switch ($i) {
										case 1:
										case 4:
										case 7:
											$bubble_size = 'small';
											break;
										case 2:
										case 5:
										case 8:
											$bubble_size = 'large';
											break;
										default:
											$bubble_size = 'medium';
											break;
									}
								?>
								<img class="bubble <?php echo $bubble_size ?>" src="<?php echo CLEANIRA_IMG_DIR . 'img-bubble-white.png'; ?>" alt="">
							<?php endfor; ?>
						</div>
					<?php
					endwhile;
					?>
				</div>
			<?php
			} else {
				get_template_part('framework/templates/post', 'none');
			}
			?>
		</div>
<?php
		wp_reset_postdata();
	}

	protected function content_template()
	{
	}
}
