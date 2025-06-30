<section class="services-clinic-block">
  <div class="services-clinic-inner">
    <div class="services-clinic-title">
      <span class="title-part1">Услуги</span>
      <span class="title-part2">клиник</span>
    </div>

    <div class="services-groups-wrapper">
      <?php
      $query = new WP_Query([
        'post_type' => 'services',
        'posts_per_page' => -1,
      ]);

      $groups = [];

      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          $group_title = get_field('service_group_title');
          $service_name = get_field('service_name');
          $group_icon = get_field('service_group_icon'); // Получаем иконку для группы
          $service_icon = get_field('service_icon'); // Получаем иконку для услуги

          if (!$group_title || !$service_name) continue;

          $groups[$group_title][] = [
            'service_name' => $service_name,
            'group_icon' => $group_icon,
            'service_icon' => $service_icon
          ];
        }
        wp_reset_postdata();
      }

      $groups = array_slice($groups, 0, 6); // максимум 6 групп

      foreach ($groups as $group_name => $services):
      ?>
        <div class="service-group">
          <div class="service-group__header">
            <h3 class="service-group__title"><?php echo esc_html($group_name); ?></h3>
            <?php if (!empty($services[0]['group_icon'])): // Выводим иконку группы, если она задана ?>
              <div class="service-group__icon">
  <img src="<?php echo esc_url($services[0]['group_icon']); ?>" alt="icon">
</div>
            <?php endif; ?>
          </div>
          <div class="service-group__services">
            <?php
              $chunks = array_chunk($services, 5); // не больше 5 в колонке
              foreach ($chunks as $column):
            ?>
              <div class="service-column">
                <?php foreach ($column as $service):
                  $service_icon = $service['service_icon']; // Иконка для услуги
                ?>
                  <div class="service-item">
                    <?php if (!empty($service_icon)): // Выводим иконку услуги, если она задана ?>
                      <img src="<?php echo esc_url($service_icon); ?>" alt="icon" class="service-item__icon">
                    <?php endif; ?>
                    <span class="service-item__text"><?php echo esc_html($service['service_name']); ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="services-button-wrapper">
  <a href="/services" class="main-button services-more-btn">Смотреть все услуги клиник</a>
</div>
  </div>
</section>