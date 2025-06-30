<?php
get_header();

if (have_posts()) : while (have_posts()) : the_post();
  $name = get_field('doc_name');
  $description = get_field('doc_description');
  $experience = get_field('doc_experience');
  $photo = get_field('doc_photo');
?>
  <!-- ХЛЕБНЫЕ КРОШКИ -->
  <?php
  if (!is_front_page()) {
    get_template_part('templates/nav/breadcrumbs', null, [
      'items' => [
        ['label' => 'Главная', 'url' => home_url('/')],
        ['label' => 'Врачи', 'url' => 'https://new.yourmed24.ru/doctors/']
      ],
      'current' => $name,
      'height' => 75,
      'align' => 'center'
    ]);
  }
  ?>

  <!-- СЕКЦИЯ ВРАЧА -->
  <section class="doctor">
    <div class="doctor__wrapper">
      <div class="doctor__photo-block">
        <?php if ($photo): ?>
          <img src="<?= esc_url($photo['url']); ?>" alt="<?= esc_attr($name); ?>" class="doctor__photo">
        <?php endif; ?>
      </div>
      <div class="doctor__right">
        <h1 class="doctor__name"><?= esc_html($name); ?></h1>

        <div class="doctor__content">
          <div class="doctor__block">
            <p class="doctor__subtitle">Специализация:</p>
            <p class="doctor__text"><?= esc_html($description); ?></p>
          </div>

          <div class="doctor__block">
            <p class="doctor__subtitle">Профессиональный стаж:</p>
            <p class="doctor__text">Более <?= esc_html($experience); ?></p>
          </div>

          <div class="doctor__block">
            <p class="doctor__subtitle">Образование:</p>
            <a href="#certificates" class="doctor__link">Смотреть сертификаты</a>
          </div>

          <div class="doctor__buttons">
            <a href="#works" class="doctor__btn">Работы врача</a>
            <a href="#video" class="doctor__btn">Видеобиография</a>
            <a href="#review" class="doctor__btn">Оставить отзыв</a>
          </div>

          <div class="doctor__appointment">
            <a href="#appointment" class="main-button main-button--wide">Записаться на прием</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- АККОРДЕОН -->
  <?php
  $accordion_fields = [
    'doc_skills' => 'Профессиональные навыки',
    'doc_education' => 'Образование',
    'doc_courses' => 'Курсы повышения квалификации',
    'doc_internship' => 'Интернатура/ординатура',
    'doc_achievements' => 'Достижения',
    'doc_science' => 'Научная деятельность'
  ];
  ?>

  <section class="doctor-accordion">
    <div class="doctor-accordion__wrapper">
      <?php
      $first = true;
      foreach ($accordion_fields as $field => $label):
        $content = get_field($field);
        if (!$content) continue;
        $paragraphs = explode("\n", trim($content));
      ?>
        <div class="accordion-card <?= $first ? 'active' : '' ?>">
          <div class="accordion-header">
            <span class="accordion-title"><?= esc_html($label); ?></span>
            <span class="accordion-toggle">+</span>
          </div>
          <div class="accordion-body">
            <?php foreach ($paragraphs as $paragraph): ?>
              <p><span class="dot">•</span> <?= esc_html(trim($paragraph)); ?></p>
            <?php endforeach; ?>
          </div>
        </div>
      <?php
        $first = false;
      endforeach;
      ?>
    </div>
  </section>

  <!-- ВИДЕОБИОГРАФИЯ -->
<?php
$video_url = get_field('doc_vbio');

if ($video_url):
  // Преобразуем ссылку YouTube для встраивания
  $video_url = str_replace('watch?v=', 'embed/', $video_url);
  $video_url = strtok($video_url, '&');
?>
<section class="doctor-vbio-section" id="vbio-section">
  <div class="container">
    <h2 class="vbio-title">Видеобиография врача</h2>

    <div class="video-wrapper">
      <iframe 
        id="vbio-iframe"
        src="<?php echo esc_url($video_url); ?>?autoplay=0&mute=0&enablejsapi=1" 
        frameborder="0"
        allow="autoplay; encrypted-media"
        allowfullscreen
        loading="lazy">
      </iframe>
    </div>
  </div>
</section>
<?php endif; ?>

  <!-- Сертификаты Врача -->
<?php
$certificates = get_field('doc_certificates');
if ($certificates):
  $has_carousel = count($certificates) > 2;
?>
<section class="doctor-certificates">
  <div class="certificates-header<?php echo $has_carousel ? ' has-controls' : ''; ?>">
    <div class="certificates-title">Сертификаты врача</div>
    <?php if ($has_carousel): ?>
      <div class="certificates-controls">
        <button class="arrow-button prev-arrow" aria-label="Previous certificate">
          <svg viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 1L1 6L6 11" stroke="#E8E6D4" stroke-width="2"/>
          </svg>
        </button>
        <button class="arrow-button next-arrow" aria-label="Next certificate">
          <svg viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 1L6 6L1 11" stroke="#E8E6D4" stroke-width="2"/>
          </svg>
        </button>
      </div>
    <?php endif; ?>
  </div>

  <div class="certificates-wrapper<?php echo $has_carousel ? ' has-carousel' : ''; ?>">
    <?php foreach ($certificates as $image): ?>
      <div class="certificate-item">
        <img src="<?php echo esc_url($image['sizes']['large']); ?>" 
             alt="<?php echo esc_attr($image['alt']); ?>" 
             loading="lazy"
             class="certificate-img"
             data-full="<?php echo esc_url($image['url']); ?>">
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Fullscreen modal -->
<div class="certificates-modal" id="certModal">
  <span class="cert-modal-close">&times;</span>
  <div class="cert-modal-content" id="certModalContent"></div>
</div>
<?php endif; ?>

<?php
endwhile; endif;
get_footer();
?>