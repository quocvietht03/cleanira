<?php
namespace CleaniraElementorWidgets\Widgets\TestimonialLoopItem;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_TestimonialLoopItem extends Widget_Base
{

	public function get_name()
	{
		return 'bt-testimonial-loop-item';
	}

	public function get_title()
	{
		return __('Testimonial Loop Item', 'cleanira');
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

	}

	protected function register_style_section_controls()
	{

		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__('Box', 'cleanira'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'box_border_radius',
			[
				'label' => __('Border Radius', 'cleanira'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .bt-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Padding', 'cleanira'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .bt-post',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'cleanira'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rating_style',
			[
				'label' => __('Rating', 'cleanira'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'rating_width',
			[
				'label' => esc_html__('Size', 'cleanira'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .bt-post--rating svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .bt-post--title' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bt-post:hover .bt-post--title' => 'color: {{VALUE}};',
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

		$this->add_control(
			'desc_style',
			[
				'label' => __('Description', 'cleanira'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __('Color', 'cleanira'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __('Typography', 'cleanira'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--desc',
			]
		);

		$this->add_control(
			'avatar_style',
			[
				'label' => __('Avatar', 'cleanira'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'avatar_border_radius',
			[
				'label' => __('Border Radius', 'cleanira'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .bt-post--avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'avatar_width',
			[
				'label' => esc_html__('Size', 'cleanira'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .bt-post--avatar' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'package_style',
			[
				'label' => __('Package', 'cleanira'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'package_color',
			[
				'label' => __('Color', 'cleanira'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--meta .bt-post--package' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'package_color_hover',
			[
				'label' => __('Color Hover', 'cleanira'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post:hover .bt-post--meta .bt-post--package' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'package_typography',
				'label' => __('Typography', 'cleanira'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--meta .bt-post--package',
			]
		);

		$this->add_control(
			'date_style',
			[
				'label' => __('Date', 'cleanira'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => __('Color', 'cleanira'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--meta .bt-post--date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'date_color_hover',
			[
				'label' => __('Color Hover', 'cleanira'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post:hover .bt-post--meta .bt-post--date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => __('Typography', 'cleanira'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--meta .bt-post--date',
			]
		);

		$this->end_controls_section();

	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		?>
		<div class="bt-elwg-testimonial-loop-item--default">
			<?php get_template_part('framework/templates/testimonial', 'style'); ?>
		</div>
		<?php
	}

	protected function content_template()
	{

	}
}
