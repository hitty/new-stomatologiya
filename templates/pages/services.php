<div class="services-wrapper">
  <?php
    // Получаем все записи services
    $services = get_posts([
      'post_type' => 'services',
      'numberposts' => -1,
      'orderby' => 'title',
      'order' => 'ASC'
    ]);

    // Группировка по service_group_title
    $grouped_services = [];

    foreach ($services as $post) {
      setup_postdata($post);
      $group_title = get_field('service_group_title', $post->ID);
      $group_icon = get_field('service_group_icon', $post->ID);

      $grouped_services[$group_title]['icon'] = $group_icon;
      $grouped_services[$group_title]['items'][] = $post;
    }
    wp_reset_postdata();

    // Вывод по группам
    foreach ($grouped_services as $group_title => $group_data):
  ?>
    <section class="service-category">
      <div class="service-category-title">
        <?php if ($group_data['icon']): ?>
          <img src="<?= esc_url($group_data['icon']) ?>" alt="" class="group-icon" />
        <?php endif; ?>
        <h2><?= esc_html($group_title) ?></h2>
      </div>

      <div class="service-cards-row">
        <?php foreach ($group_data['items'] as $post): setup_postdata($post); ?>
          <?php
            $name = get_field('service_name');
            $icon = get_field('service_icon');
            $price = get_field('service_price');
          ?>
          <div class="service-card">
  <div class="service-info">
    <div class="top">
      <img src="<?= esc_url($icon) ?>" alt="" class="service-icon" />
      <span class="service-name"><?= esc_html($name) ?></span>
    </div>
    <div class="price">от <?= esc_html($price) ?> руб</div>
  </div>
  <a href="#" class="service-btn">Подробнее о процедуре</a>
</div>
        <?php endforeach; wp_reset_postdata(); ?>
      </div>
    </section>
  <?php endforeach; ?>
</div>