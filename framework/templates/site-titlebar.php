<?php

/**
 * Site Titlebar
 *
 */

$background_color = get_field('title_bar_bg_color', 'options');
$fill_color = !empty($background_color) ? $background_color : '#F1F5FB';

?>
<section class="bt-site-titlebar bubble-container">
  <div class="bt-background-img">
    <svg class="" xmlns="http://www.w3.org/2000/svg" width="1920" height="320" viewBox="0 0 1920 320" fill="<?php echo $fill_color; ?>">
      <path d="M1421.29 308.029C1732.57 281.747 1931.17 289.155 1999 299.527L2018.56 0.160217L-86.0606 0.16031L-86.0605 299.527C-7.1156 278.066 278.692 227.963 638.226 279.502C918.527 319.682 1139.16 331.849 1421.29 308.029Z" fill="<?php echo $fill_color; ?>"/>
    </svg>
  </div>
  <div class="bt-container">
    <div class="bt-page-titlebar">
      <div class="bt-page-titlebar--infor">
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
  </div>
  <!-- Small, medium, and large bubbles -->
  <?php 
    for ($i = 1; $i <= 6; $i++): 
      switch ($i) {
        case 1:
        case 4:
          $bubble_size = 'small';
          break;
        case 3:
        case 5:
          $bubble_size = 'large';
          break;
        default:
          $bubble_size = 'medium';
          break;
      }
    ?>
    <img class="bubble <?php echo $bubble_size ?>" src="<?php echo CLEANIRA_IMG_DIR . 'img-bubble-white.png'; ?>" alt="">
  <?php endfor; ?>
</section>