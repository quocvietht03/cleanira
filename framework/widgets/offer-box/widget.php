<?php

namespace CleaniraElementorWidgets\Widgets\OfferBox;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

class Widget_OfferBox extends Widget_Base
{

    public function get_name()
    {
        return 'bt-offer-box';
    }

    public function get_title()
    {
        return __('Offer Box', 'cleanira');
    }

    public function get_icon()
    {
        return 'eicon-posts-ticker';
    }

    public function get_categories()
    {
        return ['cleanira'];
    }

    public function get_script_depends()
    {
        return ['elementor-widgets'];
    }

    protected function register_layout_section_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'cleanira'),
            ]
        );

        $this->add_control(
            'offer_reverse',
            [
                'label' => __('Enable Reverse', 'cleanira'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'cleanira'),
                'label_off' => __('No', 'cleanira'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'offer_image',
            [
                'label' => esc_html__('Image', 'cleanira'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'offer_discount',
            [
                'label' => __('Discount', 'cleanira'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('', 'cleanira'),
            ]
        );
        $this->add_control(
            'offer_heading',
            [
                'label' => __('Heading', 'cleanira'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('', 'cleanira'),
            ]
        );

        $this->add_control(
            'offer_description',
            [
                'label' => __('Description', 'cleanira'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('', 'cleanira'),
            ]
        );

        $this->add_control(
            'offer_button',
            [
                'label' => __('Button', 'cleanira'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Book now', 'cleanira'),
            ]
        );
        $this->add_control(
            'offer_button_link',
            [
                'label' => __('Button Link', 'cleanira'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
            ]
        );
        $this->end_controls_section();
    }

    protected function register_style_section_controls()
    {
        $this->start_controls_section(
            'section_style_item',
            [
                'label' => esc_html__('General', 'cleanira'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'offer_list_border',
            [
                'label' => __('Border Width', 'cleanira'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
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
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--item' => 'border-bottom: {{SIZE}}{{UNIT}} solid #e9e9e9;',
                ],
            ]
        );
        $this->add_control(
            'offer_list_color',
            [
                'label' => __('Border Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--item' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'offer_list_maps_height',
            [
                'label' => __('Maps height', 'cleanira'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 213,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--maps iframe' => 'height: {{SIZE}}px;',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_heading',
            [
                'label' => esc_html__('Heading', 'cleanira'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'offer_title_style',
            [
                'label' => esc_html__('Title', 'cleanira'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'offer_title_color',
            [
                'label' => __('Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-infor .bt-offer-title-wrap h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'offer_title_hover_color',
            [
                'label' => __('Color Hover', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-infor:hover .bt-offer-title-wrap h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offer_title_typography',
                'label' => __('Typography', 'cleanira'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-infor .bt-offer-title-wrap h2 ',
            ]
        );
        $this->add_control(
            'offer_address_color',
            [
                'label' => __('Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-infor .bt-offer-title-wrap span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offer_address_typography',
                'label' => __('Typography', 'cleanira'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-infor .bt-offer-title-wrap span',
            ]
        );
        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'style_normal',
            [
                'label' => __('Normal', 'cleanira'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-button a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Background Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-button a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_border_color',
            [
                'label' => __('border Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-button a' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover',
            [
                'label' => __('Hover', 'cleanira'),
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => __('Text Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-button a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => __('Background Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-button a:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_border_color_hover',
            [
                'label' => __('border Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--heading-button a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__('Content', 'cleanira'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'offer_opening_hours_style',
            [
                'label' => esc_html__('Opening Hours', 'cleanira'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'offer_opening_hours_color',
            [
                'label' => __('Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--oppening-hours .bt-offer-time h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offer_opening_hours_typography',
                'label' => __('Typography', 'cleanira'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--oppening-hours .bt-offer-time h3',
            ]
        );
        $this->add_control(
            'offer_list_time_style',
            [
                'label' => esc_html__('List Time', 'cleanira'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'offer_title_list_time_color',
            [
                'label' => __('Title Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--oppening-hours .bt-offer-time--title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offer_title_list_time_typography',
                'label' => __('Title Typography', 'cleanira'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--oppening-hours .bt-offer-time--title',
            ]
        );
        $this->add_control(
            'offer_hours_list_time_color',
            [
                'label' => __('Hours Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--oppening-hours .bt-offer-time--hours' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offer_hours_list_time_typography',
                'label' => __('Hours Typography', 'cleanira'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--oppening-hours .bt-offer-time--hours',
            ]
        );
        $this->add_control(
            'offer_meta_style',
            [
                'label' => esc_html__('Meta', 'cleanira'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'offer_title_meta_color',
            [
                'label' => __('Title Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--meta-item .bt-offer-info h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offer_title_meta_typography',
                'label' => __('Title Typography', 'cleanira'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--meta-item .bt-offer-info h4',
            ]
        );
        $this->add_control(
            'offer_content_meta_color',
            [
                'label' => __('Content Color', 'cleanira'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--meta-item .bt-offer-info span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offer_content_meta_typography',
                'label' => __('Content Typography', 'cleanira'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-elwg-offer-list--default .bt-offer-list--meta-item .bt-offer-info span',
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_layout_section_controls();
        //     $this->register_style_section_controls();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <div class="bt-elwg-offer-box--default">
            <div class="bt-offer <?php echo ($settings['offer_reverse'] === 'yes') ? 'bt-reverse' : ''; ?>">
                <div class="bt-offer--image">
                    <?php if (!empty($settings['offer_image']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['offer_image']['url']); ?>">
                    <?php endif; ?>
                    <div class="bt-line">
                        <div class="bt-line-top"></div>
                        <div class="bt-line-left"></div>
                        <div class="bt-line-right"></div>
                        <div class="bt-line-bottom"></div>
                    </div>
                </div>
                <div class="bt-offer--infor">
                    <div class="bt-offer--inner">
                        <?php if (!empty($settings['offer_discount'])) : ?>
                            <h2 class="bt-offer--discount"><?php echo esc_html($settings['offer_discount']); ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($settings['offer_heading'])) : ?>
                            <h3 class="bt-offer--heading"><?php echo esc_html($settings['offer_heading']); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($settings['offer_description'])) : ?>
                            <p class="bt-offer--description"><?php echo esc_html($settings['offer_description']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($settings['offer_button']) && !empty($settings['offer_button_link'])) : ?>
                            <div class="bt-offer--button bt-button-hover">
                                <a href="<?php echo esc_url($settings['offer_button_link']); ?>" class="bt-primary-btn bt-button">
                                    <span class="bt-heading"><?php echo esc_html($settings['offer_button']); ?></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_10966_1169)">
                                            <path d="M3.125 10H16.875" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_10966_1169">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="bt-line">
                        <div class="bt-line-top"></div>
                        <div class="bt-line-left"></div>
                        <div class="bt-line-right"></div>
                        <div class="bt-line-bottom"></div>
                    </div>
                </div>
            </div>
        </div>
<?php }

    protected function content_template() {}
}
