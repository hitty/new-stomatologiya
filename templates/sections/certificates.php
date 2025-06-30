<?php
$certs = get_posts([
  'post_type' => 'certificates',
  'posts_per_page' => -1,
]);

if ($certs):
  $has_carousel = count($certs) > 4;
?>
<section class="certificates-section">
  <div class="certificates-container <?php echo $has_carousel ? 'has-carousel' : ''; ?>">
    <?php foreach ($certs as $cert):
      $img = get_field('cert_img', $cert->ID);
      if ($img): ?>
        <div class="cert-item">
          <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($cert->post_title); ?>" class="cert-img">
        </div>
      <?php endif;
    endforeach; ?>
  </div>

  <?php if ($has_carousel): ?>
    <div class="certificates-controls">
      <button class="arrow-button prev-arrow">
        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M6 1L1 6L6 11" stroke="#E8E6D4" stroke-width="2"/>
        </svg>
      </button>
      <button class="arrow-button next-arrow">
        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1L6 6L1 11" stroke="#E8E6D4" stroke-width="2"/>
        </svg>
      </button>
    </div>
  <?php endif; ?>
</section>
<?php endif; ?>