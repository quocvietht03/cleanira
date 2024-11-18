<?php

/**
 * Site Titlebar
 *
 */
$background_color = !empty(get_field('title_bar_bg_color', 'options')) ? get_field('title_bar_bg_color', 'options') : '#F1F5FB';
?>
<section class="bt-site-titlebar" style="background-color: <?php echo esc_attr($background_color) ?>">
  <div class="bt-container">
    <div class="bt-wave bt-wave-bottom" data-negative="false">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
        <path class="bt-wave-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
	c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
	c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
      </svg>
    </div>
    <div class="bt-page-titlebar">
      <div class="bt-page-titlebar--breadcrumb">
        <?php
        $home_text = 'Homepage';
        $delimiter = '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
              <path opacity="0.5" d="M4.12922 10.3724C3.97259 10.2178 3.95835 9.97591 4.0865 9.80543L4.12922 9.75658L7.93471 6L4.12922 2.24342C3.97259 2.08881 3.95835 1.84688 4.0865 1.67639L4.12922 1.62755C4.28584 1.47294 4.53094 1.45889 4.70365 1.58539L4.75314 1.62755L8.87078 5.69207C9.02741 5.84667 9.04165 6.08861 8.9135 6.25909L8.87078 6.30793L4.75314 10.3724C4.58085 10.5425 4.30151 10.5425 4.12922 10.3724Z" fill="#212121"/>
            </svg>';
        echo cleanira_page_breadcrumb($home_text, $delimiter);
        ?>
      </div>
      <h1 class="bt-page-titlebar--title"><?php echo cleanira_page_title(); ?></h1>
    </div>
  </div>
</section>