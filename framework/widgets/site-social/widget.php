<?php

namespace CleaniraElementorWidgets\Widgets\SiteSocial;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_SiteSocial extends Widget_Base
{

	public function get_name()
	{
		return 'bt-site-social';
	}

	public function get_title()
	{
		return __('Site Social', 'cleanira');
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

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'cleanira'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'cleanira'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'cleanira'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'cleanira'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		if (function_exists('get_field')) {
			$site_infor = get_field('site_information', 'options');
		} else {
			return;
		}

		if (empty($site_infor['site_socials'])) {
			return;
		}

		?>
		<div class="bt-elwg-site-social">
			<?php

			foreach ($site_infor['site_socials'] as $item) {
				if ($item['social'] == 'facebook') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
<<<<<<< HEAD
								<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_10935_2718)">
								<path d="M6.63965 11.6025L9.13965 9.10254L11.6396 11.6025L14.1396 9.10254" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M6.63347 16.8457C8.20888 17.7575 10.0621 18.0652 11.8477 17.7115C13.6332 17.3578 15.2292 16.3669 16.3381 14.9234C17.4469 13.4798 17.993 11.6823 17.8744 9.86595C17.7558 8.04958 16.9807 6.33831 15.6936 5.0512C14.4065 3.76409 12.6952 2.989 10.8789 2.87043C9.06249 2.75186 7.26498 3.29791 5.82147 4.40676C4.37796 5.51562 3.38697 7.1116 3.03328 8.89715C2.67958 10.6827 2.98731 12.5359 3.89909 14.1114L2.92175 17.0293C2.88502 17.1394 2.87969 17.2576 2.90636 17.3706C2.93302 17.4836 2.99062 17.5869 3.07271 17.669C3.15479 17.7511 3.25811 17.8087 3.3711 17.8353C3.48408 17.862 3.60225 17.8567 3.71237 17.8199L6.63347 16.8457Z" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</g>
								<defs>
								<clipPath id="clip0_10935_2718">
								<rect width="20" height="20" fill="white" transform="translate(0.389648 0.352539)"/>
								</clipPath>
								</defs>
								</svg>
							</a>';
				}

				if ($item['social'] == 'twitter') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
								<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_10935_2723)">
								<path d="M4.13965 3.47754H7.88965L16.6396 17.2275H12.8896L4.13965 3.47754Z" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M9.28652 11.5654L4.13965 17.2271" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M16.64 3.47754L11.4932 9.13926" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</g>
								<defs>
								<clipPath id="clip0_10935_2723">
								<rect width="20" height="20" fill="white" transform="translate(0.389648 0.352539)"/>
								</clipPath>
								</defs>
								</svg>
							</a>';
				}

				if ($item['social'] == 'skype') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
							<g clip-path="url(#clip0_10935_2735)">
								<path d="M7.88965 12.2275C7.88965 13.2627 9.00918 14.1025 10.3896 14.1025C11.7701 14.1025 12.8896 13.2627 12.8896 12.2275C12.8896 9.72754 8.02871 10.665 8.02871 8.47754C8.02871 7.44238 9.00918 6.60254 10.3896 6.60254C11.4248 6.60254 12.2357 7.07129 12.5771 7.74785" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M17.1084 11.8127C17.6633 12.5345 17.9367 13.4334 17.8776 14.3419C17.8185 15.2504 17.431 16.1063 16.7872 16.7501C16.1434 17.3938 15.2875 17.7814 14.379 17.8405C13.4705 17.8996 12.5716 17.6262 11.8498 17.0713C10.725 17.3145 9.55724 17.2716 8.4533 16.9467C7.34936 16.6218 6.34455 16.0251 5.53083 15.2114C4.71712 14.3977 4.12049 13.3929 3.79556 12.2889C3.47063 11.185 3.42778 10.0172 3.67093 8.89241C3.11601 8.17067 2.84261 7.27171 2.90171 6.36323C2.96082 5.45475 3.3484 4.5988 3.99215 3.95504C4.6359 3.31129 5.49186 2.92371 6.40034 2.86461C7.30882 2.8055 8.20778 3.0789 8.92952 3.63382C10.0543 3.39067 11.2221 3.43352 12.3261 3.75845C13.43 4.08338 14.4348 4.68001 15.2485 5.49372C16.0622 6.30744 16.6589 7.31225 16.9838 8.41619C17.3087 9.52013 17.3516 10.6879 17.1084 11.8127Z" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</g>
							<defs>
								<clipPath id="clip0_10935_2735">
								<rect width="20" height="20" fill="white" transform="translate(0.389648 0.352539)"/>
								</clipPath>
							</defs>
							</svg>
						</a>';
=======
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <g clip-path="url(#clip0_10935_2511)">
    <path d="M6.25 11.25L8.75 8.75L11.25 11.25L13.75 8.75" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6.24382 16.4932C7.81923 17.405 9.67248 17.7127 11.458 17.359C13.2436 17.0053 14.8396 16.0143 15.9484 14.5708C17.0573 13.1273 17.6033 11.3298 17.4847 9.51341C17.3662 7.69704 16.5911 5.98577 15.304 4.69866C14.0169 3.41156 12.3056 2.63646 10.4892 2.51789C8.67284 2.39932 6.87533 2.94537 5.43182 4.05422C3.98831 5.16308 2.99733 6.75906 2.64363 8.54461C2.28993 10.3302 2.59766 12.1834 3.50944 13.7588L2.5321 16.6768C2.49538 16.7869 2.49005 16.9051 2.51671 17.0181C2.54337 17.131 2.60097 17.2344 2.68306 17.3165C2.76514 17.3985 2.86847 17.4561 2.98145 17.4828C3.09443 17.5095 3.2126 17.5041 3.32273 17.4674L6.24382 16.4932Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </g>
  <defs>
    <clipPath id="clip0_10935_2511">
      <rect width="20" height="20" fill="white"/>
    </clipPath>
  </defs>
</svg>
							</a>';
				}
				if ($item['social'] == 'twitter') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <g clip-path="url(#clip0_10935_2516)">
    <path d="M3.75 3.125H7.5L16.25 16.875H12.5L3.75 3.125Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M8.89687 11.2129L3.75 16.8746" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M16.2504 3.125L11.1035 8.78672" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </g>
  <defs>
    <clipPath id="clip0_10935_2516">
      <rect width="20" height="20" fill="white"/>
    </clipPath>
  </defs>
</svg>
							</a>';
				}
				if ($item['social'] == 'instagram') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <g clip-path="url(#clip0_10935_2522)">
    <path d="M10 13.125C11.7259 13.125 13.125 11.7259 13.125 10C13.125 8.27411 11.7259 6.875 10 6.875C8.27411 6.875 6.875 8.27411 6.875 10C6.875 11.7259 8.27411 13.125 10 13.125Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M13.75 2.5H6.25C4.17893 2.5 2.5 4.17893 2.5 6.25V13.75C2.5 15.8211 4.17893 17.5 6.25 17.5H13.75C15.8211 17.5 17.5 15.8211 17.5 13.75V6.25C17.5 4.17893 15.8211 2.5 13.75 2.5Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14.0625 6.71875C14.494 6.71875 14.8438 6.36897 14.8438 5.9375C14.8438 5.50603 14.494 5.15625 14.0625 5.15625C13.631 5.15625 13.2812 5.50603 13.2812 5.9375C13.2812 6.36897 13.631 6.71875 14.0625 6.71875Z" fill="#212121"/>
  </g>
  <defs>
    <clipPath id="clip0_10935_2522">
      <rect width="20" height="20" fill="white"/>
    </clipPath>
  </defs>
</svg>
							</a>';
				}
				if ($item['social'] == 'skype') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <g clip-path="url(#clip0_10935_2528)">
    <path d="M7.5 11.875C7.5 12.9102 8.61953 13.75 10 13.75C11.3805 13.75 12.5 12.9102 12.5 11.875C12.5 9.375 7.63906 10.3125 7.63906 8.125C7.63906 7.08984 8.61953 6.25 10 6.25C11.0352 6.25 11.8461 6.71875 12.1875 7.39531" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M16.7188 11.4602C17.2737 12.1819 17.5471 13.0809 17.488 13.9894C17.4289 14.8978 17.0413 15.7538 16.3976 16.3976C15.7538 17.0413 14.8978 17.4289 13.9894 17.488C13.0809 17.5471 12.1819 17.2737 11.4602 16.7188C10.3354 16.9619 9.16759 16.9191 8.06365 16.5941C6.95971 16.2692 5.9549 15.6726 5.14118 14.8589C4.32747 14.0452 3.73084 13.0403 3.40591 11.9364C3.08098 10.8325 3.03813 9.66466 3.28128 8.53987C2.72636 7.81813 2.45296 6.91917 2.51207 6.01069C2.57117 5.10221 2.95875 4.24626 3.6025 3.6025C4.24626 2.95875 5.10221 2.57117 6.01069 2.51207C6.91917 2.45296 7.81813 2.72636 8.53987 3.28128C9.66466 3.03813 10.8325 3.08098 11.9364 3.40591C13.0403 3.73084 14.0452 4.32747 14.8589 5.14118C15.6726 5.9549 16.2692 6.95971 16.5941 8.06365C16.9191 9.16759 16.9619 10.3354 16.7188 11.4602Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </g>
  <defs>
    <clipPath id="clip0_10935_2528">
      <rect width="20" height="20" fill="white"/>
    </clipPath>
  </defs>
</svg>
							</a>';
				}
				if ($item['social'] == 'telegram') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <g clip-path="url(#clip0_10935_2533)">
    <path d="M6.24939 10.5366L13.301 16.7186C13.3822 16.7903 13.4806 16.8396 13.5867 16.8618C13.6927 16.8839 13.8027 16.8781 13.9058 16.845C14.0089 16.8118 14.1016 16.7524 14.1749 16.6726C14.2481 16.5928 14.2994 16.4953 14.3236 16.3897L17.4994 2.59521C17.5025 2.58138 17.5018 2.56696 17.4973 2.55351C17.4928 2.54006 17.4848 2.52807 17.474 2.51884C17.4633 2.50961 17.4502 2.50348 17.4362 2.5011C17.4223 2.49873 17.4079 2.5002 17.3947 2.50537L1.56189 8.70146C1.4636 8.73929 1.38023 8.80798 1.3243 8.89722C1.26837 8.98646 1.2429 9.09143 1.2517 9.19638C1.26051 9.30133 1.30312 9.4006 1.37313 9.47927C1.44315 9.55794 1.5368 9.61178 1.64001 9.63271L6.24939 10.5366Z" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6.25 10.5375L17.4539 2.50781" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.71641 13.577L7.325 16.0582C7.23859 16.1479 7.12737 16.2097 7.00561 16.2357C6.88384 16.2617 6.75708 16.2507 6.64157 16.2042C6.52607 16.1577 6.42709 16.0778 6.35732 15.9747C6.28755 15.8715 6.25018 15.7499 6.25 15.6254V10.5371" stroke="#212121" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </g>
  <defs>
    <clipPath id="clip0_10935_2533">
      <rect width="20" height="20" fill="white"/>
    </clipPath>
  </defs>
</svg>
							</a>';
>>>>>>> d95e248e05c6491e79af199668811f7261c818fa
				}

				if ($item['social'] == 'instagram') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
							<g clip-path="url(#clip0_10935_2729)">
								<path d="M10.3896 13.4775C12.1155 13.4775 13.5146 12.0784 13.5146 10.3525C13.5146 8.62665 12.1155 7.22754 10.3896 7.22754C8.66376 7.22754 7.26465 8.62665 7.26465 10.3525C7.26465 12.0784 8.66376 13.4775 10.3896 13.4775Z" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M14.1396 2.85254H6.63965C4.56858 2.85254 2.88965 4.53147 2.88965 6.60254V14.1025C2.88965 16.1736 4.56858 17.8525 6.63965 17.8525H14.1396C16.2107 17.8525 17.8896 16.1736 17.8896 14.1025V6.60254C17.8896 4.53147 16.2107 2.85254 14.1396 2.85254Z" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M14.4521 7.07129C14.8836 7.07129 15.2334 6.72151 15.2334 6.29004C15.2334 5.85857 14.8836 5.50879 14.4521 5.50879C14.0207 5.50879 13.6709 5.85857 13.6709 6.29004C13.6709 6.72151 14.0207 7.07129 14.4521 7.07129Z" fill="#636666"/>
							</g>
							<defs>
								<clipPath id="clip0_10935_2729">
								<rect width="20" height="20" fill="white" transform="translate(0.389648 0.352539)"/>
								</clipPath>
							</defs>
							</svg>
						</a>';
				}

				if ($item['social'] == 'telegram') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
							<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_10935_2740)">
							<path d="M6.63904 10.8892L13.6906 17.0712C13.7718 17.1429 13.8703 17.1922 13.9763 17.2143C14.0824 17.2365 14.1923 17.2307 14.2954 17.1975C14.3986 17.1643 14.4913 17.1049 14.5645 17.0251C14.6378 16.9453 14.689 16.8479 14.7133 16.7423L17.889 2.94775C17.8921 2.93392 17.8914 2.9195 17.8869 2.90605C17.8825 2.89259 17.8744 2.88061 17.8637 2.87138C17.8529 2.86215 17.8399 2.85602 17.8259 2.85364C17.8119 2.85127 17.7976 2.85274 17.7844 2.8579L1.95154 9.054C1.85325 9.09183 1.76988 9.16052 1.71395 9.24976C1.65802 9.339 1.63255 9.44397 1.64135 9.54892C1.65016 9.65387 1.69277 9.75313 1.76278 9.83181C1.8328 9.91048 1.92644 9.96432 2.02966 9.98525L6.63904 10.8892Z" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M6.63965 10.89L17.8436 2.86035" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M10.1061 13.9295L7.71465 16.4107C7.62824 16.5004 7.51702 16.5622 7.39525 16.5882C7.27349 16.6142 7.14673 16.6033 7.03122 16.5568C6.91572 16.5103 6.81674 16.4303 6.74697 16.3272C6.6772 16.2241 6.63983 16.1024 6.63965 15.9779V10.8896" stroke="#636666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</g>
							<defs>
							<clipPath id="clip0_10935_2740">
							<rect width="20" height="20" fill="white" transform="translate(0.389648 0.352539)"/>
							</clipPath>
							</defs>
							</svg>
						</a>';
				}

			}
			?>
		</div>
		<?php
	}

	protected function content_template() {}
}
