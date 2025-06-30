<section class="rating-section">
  <div class="rating-container">
    <div class="rating-text">
      <div class="rating-text-part rating-text-part-left">Независимые</div>
      <div class="rating-text-part rating-text-part-right">рейтинги и отзывы пациентов</div>
    </div>

    <div class="rating-cards-container">
      <div class="rating-cards">
        <?php
        $args = [
          'post_type' => 'ratings',
          'posts_per_page' => -1
        ];
        $ratings_query = new WP_Query($args);

        if ($ratings_query->have_posts()) :
          while ($ratings_query->have_posts()) : $ratings_query->the_post();
            $rating_logo = get_post_meta(get_the_ID(), 'rating_logo', true);
            $rating_name = get_post_meta(get_the_ID(), 'rating_name', true);
            ?>
            <div class="rating-card">
              <div class="rating-logo">
                <img src="<?php echo esc_url($rating_logo); ?>" alt="<?php echo esc_attr($rating_name); ?>">
              </div>
              <div class="rating-name"><?php echo esc_html($rating_name); ?></div>
              <div class="rating-stars">
                <img src="/wp-content/themes/frymstom/assets/img/stars.svg" alt="Rating Stars" />
              </div>
              <div class="rating-btn">
                <a href="<?php the_permalink(); ?>">Читать отзывы</a>
              </div>
            </div>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php else: ?>
          <p>Нет рейтингов для отображения.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>