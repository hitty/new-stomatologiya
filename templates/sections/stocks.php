<?php
$stocks = get_posts([
  'post_type' => 'stocks',
  'posts_per_page' => -1
]);
?>

<section class="stocks-section">
    <div class="container">
  <div class="stocks-container">
    <?php foreach ($stocks as $stock) :
      $title = get_field('stocks_name', $stock->ID);
      $conditions = get_field('stocks_conditions', $stock->ID);
      $photo = get_field('stocks_photo', $stock->ID);
    ?>
      <div class="stock-card">
        <div class="stock-info">
          <h3 class="stock-title"><?= esc_html($title); ?></h3>
          <p class="stock-conditions"><?= esc_html($conditions); ?></p>
            <button class="main-button special-card__button" data-popup-target="#popup-promotion" data-title="Оформить лечение без переплат">Оформить лечение без переплат</button>
        </div>
        <?php if ($photo) : ?>
          <div class="stock-image-wrapper">
            <img src="<?= esc_url($photo['url']); ?>" alt="<?= esc_attr($title); ?>" class="stock-image">
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  </div>
</section>