<?php
/**
 * Template Name: Все цены
 */

get_header();
?>

<!-- ХЛЕБНЫЕ КРОШКИ -->
  <?php
if (!is_front_page()) {
  get_template_part('templates/nav/breadcrumbs', null, [
    'items' => [
      ['label' => 'Главная', 'url' => home_url('/')]
    ],
    'current' => 'Все цены',
    'height' => 75,
    'align' => 'center'
  ]);
}
?>

<section class="prices-section">
  <div class="page-title">
    <h1>
      Стоимость услуг<br>
      <span>стоматологических клиник YourMed</span>
    </h1>
  </div>

  <div class="accordion-wrapper">
    <?php
    $args = [
      'post_type' => 'prices',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC'
    ];
    $categories = new WP_Query($args);
    if ($categories->have_posts()) :
      $index = 0;
      while ($categories->have_posts()) : $categories->the_post();
        $category_title = get_the_title();
        $prices = get_field('all_prices');
        if ($prices):
          ?>
          <div class="accordion-item" data-index="<?php echo $index; ?>">
            <div class="accordion-header">
              <div class="category-title"><?php echo esc_html($category_title); ?></div>
              <button class="accordion-toggle" aria-label="toggle">
                <svg class="plus-icon" width="16" height="16" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                  <rect x="7" width="2" height="16" fill="currentColor"/>
                  <rect y="7" width="16" height="2" fill="currentColor"/>
                </svg>
              </button>
            </div>
            <div class="accordion-content">
              <?php foreach ($prices as $i => $row): ?>
                <div class="service-row <?php echo $i % 2 === 0 ? 'even' : 'odd'; ?>">
                  <div class="service-names"><?php echo esc_html($row['service_name']); ?></div>
                  <div class="service-price"><?php echo esc_html($row['service_price']); ?> руб.</div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php
          $index++;
        endif;
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
</section>

<?php get_footer(); ?>