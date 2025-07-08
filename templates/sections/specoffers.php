<section class="special-offers">
    <div class="container">
  <div class="special-offers__header">
    <h2 class="special-offers__title">
      <span class="special-offers__title-light">Специальные</span>
      <span class="special-offers__title-colored">предложения</span>
    </h2>

    <div class="special-offers__controls">
      <button class="main-button special-offers__arrow left" aria-label="Предыдущая акция">
        <svg width="6.99" height="12" viewBox="0 0 6.99 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M6 1L1 6L6 11" stroke="#E8E6D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
      <button class="main-button special-offers__arrow right" aria-label="Следующая акция">
        <svg width="6.99" height="12" viewBox="0 0 6.99 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1L6 6L1 11" stroke="#E8E6D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  </div>

  <div class="special-offers__cards-wrapper">
    <div class="special-offers__cards">
      <?php
        $special_query = new WP_Query([
          'post_type' => 'specialoffers',
          'posts_per_page' => -1,
        ]);

        if ($special_query->have_posts()) :
          while ($special_query->have_posts()) : $special_query->the_post();
            $name = get_field('special_name');
            $description = get_field('special_description');
            $price = get_field('special_price');
            $photo = get_field('special_photo');
      ?>
        <div class="special-card">
          <div class="special-card__content">
            <div class="special-card__name-wrapper">
              <div class="special-card__name"><?= esc_html($name); ?></div>
              <button class="special-card__info">i</button>
            </div>

            <div class="special-card__description"><?= esc_html($description); ?></div>
            <div class="special-card__price"><?= esc_html($price); ?> руб</div>

            <button class="main-button special-card__button" data-popup-target="#popup-promotion" data-title="Записаться по акции: <?= esc_html($name); ?>, <?= esc_html($price); ?> руб">Записаться по акции</button>

          </div>

          <?php if ($photo): ?>
            <div class="special-card__photo">
              <img src="<?= esc_url($photo['url']); ?>" alt="<?= esc_attr($photo['alt']); ?>" />
            </div>
          <?php endif; ?>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>

  <div class="special-offers__more">
  <button class="main-button special-offers__more-btn">Смотреть все акции клиники</button>
</div>
</div>
</section>