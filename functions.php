<?php
// === Основные настройки темы ===
function yourdent_theme_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'yourdent_theme_setup');

// === Подключение стилей ===
function yourdent_enqueue_styles() {
  wp_enqueue_style('inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
  wp_enqueue_style('yourdent-style', get_stylesheet_uri());

  $styles = [
    'header'                => '/assets/css/header.css',
    'footer'                => '/assets/css/footer.css',
    'main-style'            => '/assets/css/main-style.css',
    'services-section'      => '/assets/css/sections/services.css',
    'services-page'         => '/assets/css/pages/services.css',
    'certificates-section'  => '/assets/css/sections/certificates.css',
    'rating-section'        => '/assets/css/sections/rating.css',
    'all-doctors'           => '/assets/css/pages/all-doctors.css',
    'all-prices'            => '/assets/css/pages/all-prices.css',
    'all-articles'          => '/assets/css/pages/all-articles.css',
    'regulatory-documents'  => '/assets/css/pages/regulatory-documents.css',
    'single-doctors'        => '/assets/css/pages/single-doctors.css',
    'privacy-policy'        => '/assets/css/pages/privacy-policy.css',
    'about-clinic'          => '/assets/css/sections/aboutclinic.css',
    'recordreception'       => '/assets/css/sections/recordreception.css',
    'equip-tech'            => '/assets/css/sections/equip-tech.css',
    'reviews-section'       => '/assets/css/sections/reviews.css',
    'select2-vendor'        => '/assets/css/vendor/select2.min.css',
    'form'                  => '/assets/css/widgets/form.css',
    'branch-addresses'      => '/assets/css/sections/branch-addresses.css',
  ];

  foreach ($styles as $handle => $path) {
    $full_path = get_template_directory() . $path;
    if (file_exists($full_path)) {
      wp_enqueue_style("yourdent-{$handle}", get_template_directory_uri() . $path, [], filemtime($full_path));
    }
  }

  $sections = ['preview', 'specoffers', 'videos', 'doctors', 'stocks', 'aboutclinic', 'recordreception', 'equip-tech', 'reviews', 'branch-addresses' ];
  foreach ($sections as $section) {
    $path = "/assets/css/sections/{$section}.css";
    if (file_exists(get_template_directory() . $path)) {
      wp_enqueue_style("yourdent-{$section}", get_template_directory_uri() . $path, [], filemtime(get_template_directory() . $path));
    }
  }
}
add_action('wp_enqueue_scripts', 'yourdent_enqueue_styles');

// === Подключение скриптов ===
function yourdent_enqueue_scripts() {
  $scripts = [
    'header'                => '/assets/js/header.js',
    'videos'                => '/assets/js/videos.js',
    'doctors'               => '/assets/js/doctors.js',
    'carousel'              => '/assets/js/carousel.js',
    'certificates-carousel' => '/assets/js/certificates-carousel.js',
    'branch-addresses'      => '/assets/js/branch-addresses.js', // подключаем твой JS
  ];

  foreach ($scripts as $handle => $path) {
    $full_path = get_template_directory() . $path;
    $ver = file_exists($full_path) ? filemtime($full_path) : null;
    wp_enqueue_script("yourdent-{$handle}", get_template_directory_uri() . $path, ['jquery'], $ver, true);
  }

  if (is_page_template('page-all-doctors.php')) {
    wp_enqueue_script('yourdent-all-doctors-js', get_template_directory_uri() . '/assets/js/page-all-doctors.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/page-all-doctors.js'), true);
    wp_localize_script('yourdent-all-doctors-js', 'doctors_filter_params', [
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce'    => wp_create_nonce('filter_doctors_nonce'),
    ]);
  }

  if (get_query_var('doctor_slug')) {
    $doctor_scripts = ['single-doctors', 'single-doctors-certificates'];
    foreach ($doctor_scripts as $script) {
      wp_enqueue_script("yourdent-{$script}", get_template_directory_uri() . "/assets/js/{$script}.js", ['jquery'], filemtime(get_template_directory() . "/assets/js/{$script}.js"), true);
    }
  }

  if (is_page_template('all-prices.php')) {
    wp_enqueue_script('yourdent-all-prices-js', get_template_directory_uri() . '/assets/js/all-prices.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/all-prices.js'), true);
  }

  if (is_page_template('all-articles.php')) {
    wp_enqueue_script('yourdent-all-articles-js', get_template_directory_uri() . '/assets/js/all-articles.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/all-articles.js'), true);
    wp_localize_script('yourdent-all-articles-js', 'articles_filter_params', [
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce'    => wp_create_nonce('filter_articles_nonce'),
    ]);
  }

  if (is_page_template('regulatory-documents.php')) {
    wp_enqueue_script('yourdent-regulatory-documents-js', get_template_directory_uri() . '/assets/js/regulatory-documents.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/regulatory-documents.js'), true);
  }

  if (is_page_template('services.php')) {
    wp_enqueue_script('yourdent-services-js', get_template_directory_uri() . '/assets/js/services.js', [], filemtime(get_template_directory() . '/assets/js/services.js'), true);
  }

  // Отзывы с Яндекс Карт
  wp_enqueue_script('yourdent-reviews', get_template_directory_uri() . '/assets/js/reviews.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/reviews.js'), true);

  //Select2
  wp_enqueue_script('yourdent-select2', get_template_directory_uri() . '/assets/js/vendor/select2.min.js', ['jquery'], filemtime( get_template_directory() . '/assets/js/vendor/select2.min.js' ), true);
  wp_enqueue_script('yourdent-form', get_template_directory_uri() . '/assets/js/form.js', ['yourdent-select2'], filemtime( get_template_directory() . '/assets/js/form.js' ), true);

  // Карусель сертификатов
  if (is_page_template('templates/sections/certificates.php')) {
    wp_enqueue_script('yourdent-certificates-carousel', get_template_directory_uri() . '/assets/js/certificates-carousel.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/certificates-carousel.js'), true);
  }
}
add_action('wp_enqueue_scripts', 'yourdent_enqueue_scripts');

// === Регистрация кастомных типов ===
function yourdent_register_custom_post_types() {
  $types = [
    'clinics'              => ['Клиники', 'dashicons-building'],
    'services'             => ['Услуги', 'dashicons-heart'],
    'doctors'              => ['Врачи', 'dashicons-admin-users'],
    'reviews'              => ['Отзывы', 'dashicons-format-status'],
    'news'                 => ['Новости', 'dashicons-megaphone'],
    'preview'              => ['Превью', 'dashicons-text'],
    'specialoffers'        => ['Специальные предложения', 'dashicons-embed-photo'],
    'videos'               => ['Видео', 'dashicons-video-alt3'],
    'stocks'               => ['Акции', 'dashicons-tickets-alt'],
    'prices'               => ['Цены', 'dashicons-money-alt'],
    'ratings'              => ['Рейтинг', 'dashicons-star-filled'],
    'certificates'         => ['Сертификаты', 'dashicons-awards'],
    'regulatory_documents' => ['Нормативные документы', 'dashicons-media-document'],
    'articles'             => ['Статьи', 'dashicons-format-aside'],
  ];

  foreach ($types as $slug => [$name, $icon]) {
    register_post_type($slug, [
      'labels'      => [
        'name'               => $name,
        'singular_name'      => $name,
        'add_new'            => "Добавить " . mb_strtolower($name),
        'add_new_item'       => "Добавить новое " . mb_strtolower($name),
        'edit_item'          => "Редактировать " . mb_strtolower($name),
        'new_item'           => "Новое " . mb_strtolower($name),
        'view_item'          => "Просмотреть " . mb_strtolower($name),
        'search_items'       => "Поиск " . mb_strtolower($name),
        'not_found'          => "$name не найдены",
      ],
      'public'      => true,
      'has_archive' => false,
      'menu_icon'   => $icon,
      'supports'    => ['title', 'editor', 'thumbnail'],
      'rewrite'     => ['slug' => $slug],
    ]);
  }
}
add_action('init', 'yourdent_register_custom_post_types');

// === AJAX-фильтр врачей ===
add_action('wp_ajax_filter_doctors', 'yourdent_filter_doctors');
add_action('wp_ajax_nopriv_filter_doctors', 'yourdent_filter_doctors');

function yourdent_filter_doctors() {
  check_ajax_referer('filter_doctors_nonce', 'nonce');

  $category = sanitize_text_field($_GET['doc_category'] ?? '');
  $clinic   = sanitize_text_field($_GET['clinic_address'] ?? '');

  $meta_query = ['relation' => 'AND'];
  if ($category) $meta_query[] = ['key' => 'doc_category', 'value' => $category, 'compare' => 'LIKE'];
  if ($clinic)   $meta_query[] = ['key' => 'doc_clinic',   'value' => $clinic,   'compare' => 'LIKE'];

  $query = new WP_Query([
    'post_type'      => 'doctors',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
    'meta_query'     => $meta_query,
  ]);

  ob_start();
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $photo       = get_field('doc_photo');
      $name        = get_field('doc_name');
      $description = get_field('doc_description');
      $experience  = get_field('doc_experience');
      ?>
      <a href="<?php the_permalink(); ?>" class="all-doctor-card">
        <?php if ($photo) : ?>
          <img src="<?= esc_url($photo['url']); ?>" alt="<?= esc_attr($name); ?>" class="all-doctor-photo">
        <?php endif; ?>
        <div class="all-doctor-info">
          <div class="all-doctor-name"><?= esc_html($name); ?></div>
          <div class="all-doctor-description"><?= esc_html($description); ?></div>
          <div class="all-doctor-experience"><?= esc_html($experience); ?></div>
        </div>
      </a>
      <?php
    }
  } else {
    echo '<p class="all-no-doctors-message">Врачи по заданным параметрам не найдены.</p>';
  }
  wp_reset_postdata();
  echo ob_get_clean();
  wp_die();
}

// === AJAX-фильтр статей ===
add_action('wp_ajax_filter_articles', 'yourdent_filter_articles');
add_action('wp_ajax_nopriv_filter_articles', 'yourdent_filter_articles');

function yourdent_filter_articles() {
  check_ajax_referer('filter_articles_nonce', 'nonce');

  $category = sanitize_text_field($_GET['category'] ?? '');

  $meta_query = [];
  if ($category && $category !== 'all') {
    $meta_query[] = [
      'key'     => 'articles_category',
      'value'   => $category,
      'compare' => 'LIKE'
    ];
  }

  $query = new WP_Query([
    'post_type'      => 'articles',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => $meta_query
  ]);

  ob_start();

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $title       = get_field('articles_name');
      $short_desc  = get_field('articles_shortdes');
      $photo       = get_field('articles_photo');
      ?>
      <a href="<?php the_permalink(); ?>" class="articles-card">
        <?php if ($photo): ?>
          <div class="articles-card-image">
            <img src="<?= esc_url($photo['url']); ?>" alt="<?= esc_attr($title); ?>">
          </div>
        <?php endif; ?>
        <div class="articles-card-content">
          <div class="articles-card-title"><?= esc_html($title); ?></div>
          <div class="articles-card-desc"><?= esc_html($short_desc); ?></div>
        </div>
      </a>
      <?php
    }
  } else {
    echo '<p class="all-no-articles-message">Статьи по выбранной категории не найдены.</p>';
  }

  wp_reset_postdata();
  echo ob_get_clean();
  wp_die();
}

// === Вспомогательные функции ===
function get_post_by_field($field, $value, $post_type = '', $output = OBJECT, $orderby = '', $limit = '') {
  global $wpdb;
  $sql = "SELECT ID FROM $wpdb->posts WHERE post_status = 'publish' AND $field = %s";
  if ($post_type) $sql .= $wpdb->prepare(" AND post_type = %s", $post_type);
  if ($orderby)   $sql .= " ORDER BY $orderby";
  if ($limit)     $sql .= " $limit";

  $post_id = $wpdb->get_var($wpdb->prepare($sql, $value));
  return $post_id ? get_post($post_id, $output) : null;
}

function getVideoLink($link) {
  if (preg_match('#youtube|youtu.be#i', $link)) {
    preg_match('%(?:v=|youtu\.be/)([^"&?/ ]{11})%i', $link, $match);
    return 'https://www.youtube.com/embed/' . ($match[1] ?? '');
  }
  if (preg_match('#rutube\.ru#i', $link)) {
    return str_replace('/video/', '/play/embed/', $link);
  }
  if (preg_match('#vk\.com|vkvideo\.ru#i', $link)) {
    return preg_replace('#https://(?:vk\.com|vkvideo\.ru)/video-([0-9]+)_([0-9]+)#i', 'https://vk.com/video_ext.php?oid=-$1&id=$2&hd=2', $link);
  }

  return $link;
}

// === Дополнительные файлы ===
if (file_exists(__DIR__ . '/yourmed-data.php')) {
  require_once __DIR__ . '/yourmed-data.php';
}

// === Поддержка ЧПУ для single-doctors ===
function doctor_rewrite_rule() {
  add_rewrite_rule('^doctors/([^/]+)/?$', 'index.php?doctor_slug=$matches[1]', 'top');
}
add_action('init', 'doctor_rewrite_rule');

function doctor_query_vars($vars) {
  $vars[] = 'doctor_slug';
  return $vars;
}
add_filter('query_vars', 'doctor_query_vars');

function doctor_template_redirect() {
  $slug = get_query_var('doctor_slug');
  if ($slug) {
    include get_template_directory() . '/single-doctor-json.php';
    exit;
  }
}
add_action('template_redirect', 'doctor_template_redirect');