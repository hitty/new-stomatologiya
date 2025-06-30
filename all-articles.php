<?php
/**
 * Template Name: Все статьи
 */
get_header();
?>

<main class="all-articles-page">

  <!-- хлебные крошки -->
  <?php
  if (!is_front_page()) {
    get_template_part('templates/nav/breadcrumbs', null, [
      'items' => [
        ['label' => 'Главная', 'url' => home_url('/')],
        ['label' => 'Статьи', 'url' => get_permalink()]
      ],
      'current' => 'Все статьи',
      'height' => 75,
      'align' => 'center'
    ]);
  }
  ?>

  <section class="articles-header">
    <div class="container">
      <h1 class="articles-title">
        <span class="title-part-1">Статьи и</span>
        <span class="title-part-2">рекомендации</span>
      </h1>

      <div class="articles-filters">
        <?php
        $articles = get_posts([
          'post_type' => 'articles',
          'posts_per_page' => -1,
          'meta_key' => 'articles_category',
        ]);

        $unique_categories = [];

        foreach ($articles as $article) {
          $categories_field = get_field('articles_category', $article->ID);
          if (is_array($categories_field)) {
            foreach ($categories_field as $cat) {
              if ($cat && !in_array($cat, $unique_categories)) {
                $unique_categories[] = $cat;
              }
            }
          } elseif ($categories_field && !in_array($categories_field, $unique_categories)) {
            $unique_categories[] = $categories_field;
          }
        }

        foreach ($unique_categories as $category) :
        ?>
          <button class="filter-button" data-filter="<?php echo esc_attr(sanitize_title($category)); ?>">
            <?php echo esc_html($category); ?>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="articles-grid">
    <div class="container">
      <div class="articles-list">
        <?php
        $args = [
          'post_type' => 'articles',
          'posts_per_page' => -1,
          'orderby' => 'date',
          'order' => 'DESC'
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
            $photo = get_field('articles_photos');
            $title = get_field('articles_name');
            $desc = get_field('articles_description');
            $category = get_field('articles_category');
            $filter_class = '';

            if (is_array($category)) {
              $filter_class = implode(' ', array_map('sanitize_title', $category));
            } else {
              $filter_class = sanitize_title($category);
            }
        ?>
          <article class="article-card" data-category="<?php echo esc_attr($filter_class); ?>">
            <?php if ($photo) : ?>
              <div class="article-photo">
                <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>">
              </div>
            <?php endif; ?>

            <div class="article-content">
              <?php if ($title) : ?>
                <h3 class="article-title"><?php echo esc_html($title); ?></h3>
              <?php endif; ?>

              <?php if ($desc) : ?>
                <div class="article-desc"><?php echo esc_html($desc); ?></div>
              <?php endif; ?>

              <div class="article-footer">
                <a href="<?php the_permalink(); ?>" class="read-more">
                  <span>Читать статью</span>
                  <svg width="17" height="5" viewBox="0 0 17 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.3536 2.85355C16.5488 2.65829 16.5488 2.34171 16.3536 2.14645L13.1716 -1.03553C12.9763 -1.2308 12.6597 -1.2308 12.4645 -1.03553C12.2692 -0.840271 12.2692 -0.523689 12.4645 -0.328427L15.2929 2.5L12.4645 5.32843C12.2692 5.52369 12.2692 5.84027 12.4645 6.03553C12.6597 6.2308 12.9763 6.2308 13.1716 6.03553L16.3536 2.85355ZM0 3H16V2H0V3Z" fill="#76824A"/>
                  </svg>
                </a>
              </div>
            </div>
          </article>
        <?php
          endwhile;
          wp_reset_postdata();
        else :
          echo '<p class="no-articles">Статьи не найдены</p>';
        endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_template_part('templates/sections/rating'); ?>
<?php get_template_part('templates/sections/certificates'); ?>
<?php get_footer(); ?>