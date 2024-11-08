<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');
?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php echo cleanira_post_cover_featured_render($args['image-size']); ?>
    <div class="bt-post--content">
      <?php echo cleanira_post_title_render(); ?>
      <?php if (has_excerpt($post_id)) { ?>
        <div class="bt-post--excerpt">
          <?php
          echo get_the_excerpt($post_id);
          ?>
        </div>
      <?php } ?>
    </div>
  </div>
</article>