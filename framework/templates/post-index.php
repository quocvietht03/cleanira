<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');
?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <div class="bt-post--wrap-image">
      <?php echo cleanira_post_cover_featured_render($args['image-size']); ?>
      <div class="bt-post--publish">
          <span><?php echo get_the_date('d'); ?></span>
          <?php echo get_the_date('M'); ?>
      </div>
    </div>
    <div class="bt-post--content">
      <?php echo cleanira_post_title_render(); ?>
      <?php if (has_excerpt($post_id)) { ?>
        <div class="bt-post--infor">
          <?php
          echo cleanira_author_w_avatar();
          echo cleanira_reading_time_render();
          ?>
        </div>
      <?php } ?>
    </div>
  </div>
</article>