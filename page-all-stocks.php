<?php
/**
 * Template Name: Все Акции
 * Description: Шаблон страницы со всеми акция.
 */
get_header();
?>

 <!-- ХЛЕБНЫЕ КРОШКИ -->
  <?php
get_template_part('templates/nav/breadcrumbs', null, [
  'items' => [
    ['label' => 'Главная', 'url' => home_url('/')],
    ['label' => 'Акции', 'url' => get_permalink()]
  ],
  'current' => 'Все акции',
  'height' => 55,
  'align' => 'bottom'
]);
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/pages/all-stocks.css">

<section class="all-stocks-section">
	
	<div class="special-offers__intro">
  <h2 class="special-offers__intro-text">
    <span class="special-offers__intro-light">Делаем услуги цифровой стоматологии</span>
    <span class="special-offers__intro-colored">еще более доступными!</span>
  </h2>
</div>
	
  <div class="all-stocks-cards">
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
</section>

<?php get_template_part('templates/sections/rating'); ?>
<?php get_template_part('templates/sections/certificates'); ?>
<?php get_footer(); ?>