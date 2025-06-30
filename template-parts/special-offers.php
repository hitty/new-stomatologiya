<section class="special-offers">
  <div class="special-offers__container">
    <h2 class="special-offers__title">
      <span class="special-offers__title--light">Специальные </span>
      <span class="special-offers__title--accent">предложения</span>
    </h2>

    <div class="special-offers__cards">
      <?php
      $args = array(
        'post_type' => 'specialoffers',
        'posts_per_page' => -1
      );
      $query = new WP_Query($args);

      if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
          $name = get_field('special_name');
          $description = get_field('special_description');
          $price = get_field('special_price');
          $photo = get_field('special_photo');
      ?>
          <div class="special-card">
            <div class="special-card__content">
              <div class="special-card__title-row">
                <div class="special-card__title"><?php echo esc_html($name); ?></div>
                <div class="special-card__icon">i</div>
              </div>
              <div class="special-card__desc"><?php echo esc_html($description); ?></div>
              <div class="special-card__price"><?php echo esc_html($price); ?> ₽</div>
              <a href="#appointment" class="special-card__button">Записаться по акции</a>
            </div>
            <?php if ($photo): ?>
              <div class="special-card__image">
                <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>" />
              </div>
            <?php endif; ?>
          </div>
      <?php
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>

    <div class="special-offers__footer">
      <a href="/specialoffers" class="main-button">Смотреть все акции клиники</a>
    </div>
  </div>
</section>