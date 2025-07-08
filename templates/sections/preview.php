<?php
$args = array(
  'post_type'      => 'preview',
  'posts_per_page' => 1,
);
$preview_query = new WP_Query($args);

if ($preview_query->have_posts()) :
  while ($preview_query->have_posts()) : $preview_query->the_post();

    $preview_name = get_field('preview_name');
    $preview_description = get_field('preview_description');
    $preview_photo = get_field('preview_photo');

  endwhile;
  wp_reset_postdata();
endif;

// Подсветка текста между слешами
function highlight_slash_text($text) {
  $escaped = esc_html($text);
  $highlighted = preg_replace_callback('/\/(.*?)\//', function($matches) {
    return '<span class="highlighted">' . $matches[1] . '</span>';
  }, $escaped);

  return $highlighted;
}
?>

<section class="preview-block">
    <div class="container">
  <div class="preview-inner">
    <div class="preview-text">
      <div class="preview-title">
        <?php echo highlight_slash_text($preview_name); ?>
      </div>

      <div class="preview-description">
        <?php echo esc_html($preview_description); ?>
      </div>
      <button data-popup-target="#appointment" class="main-button">Записаться на прием</button>
    </div>

    <?php if (!empty($preview_photo)): ?>
      <div class="preview-image">
        <img src="<?php echo esc_url($preview_photo['url']); ?>" alt="<?php echo esc_attr($preview_photo['alt']); ?>">
      </div>
    <?php endif; ?>
  </div>
  </div>
</section>