<?php
/**
 * Template Name: Услуги
 * Description: Шаблон Услуг.
 * 
 * @package yourdent
 */

get_header();

// $current_filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : '';
?>

<section class="services-page">

  <!-- Навигационные хлебные крошки -->
  <?php
if (!is_front_page()) {
  get_template_part('templates/nav/breadcrumbs', null, [
    'items' => [
      ['label' => 'Главная', 'url' => home_url('/')],
      ['label' => 'Услуги', 'url' => get_permalink()]
    ],
    'current' => 'Все услуги клиники',
    'height' => 105,
    'align' => 'center'
  ]);
}
?>

  <!-- Фильтрация -->
  <section class="service-filters">
    <div class="services-filter-wrapper">
      <div class="services-filter">
        <?php
        $services = get_posts([
          'post_type' => 'services',
          'posts_per_page' => -1,
          'post_status' => 'publish',
        ]);

        $groups = [];

        foreach ($services as $service) {
          $group = get_field('service_group_title', $service->ID);
          if ($group && !in_array($group, $groups)) {
            $groups[] = $group;
          }
        }

        /*if ($current_filter && in_array($current_filter, $groups)) {
          $groups = array_diff($groups, [$current_filter]);
          array_unshift($groups, $current_filter);
        }*/

        foreach ($groups as $group) :
          $is_active = false;
          $url = $is_active ? get_permalink() : add_query_arg('filter', urlencode($group), get_permalink());
        ?>
        <a
  class="filter-button"
  href="#"
  data-group="<?php echo esc_attr($group); ?>"
>
  <?php echo esc_html($group); ?>
</a>
        <?php endforeach; ?>
      </div>
    </div>
    
  </section>
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
    <section class="service-category" data-group="<?php echo esc_attr($group_title); ?>">
      <div class="service-category-title">
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
</section>
<?php get_template_part('templates/sections/doctors'); ?>
<?php get_template_part('templates/sections/stocks'); ?>
<?php get_template_part('templates/sections/rating'); ?>
<?php get_template_part('templates/sections/certificates'); ?>
<?php get_footer(); ?>