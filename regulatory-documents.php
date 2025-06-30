<?php
/* Template Name: Нормативные документы */
get_header();
?>

<div class="container regulatory-documents-container">

  <!-- ХЛЕБНЫЕ КРОШКИ -->
  <?php
if (!is_front_page()) {
  get_template_part('templates/nav/breadcrumbs', null, [
    'items' => [
      ['label' => 'Главная', 'url' => home_url('/')]
    ],
    'current' => 'Нормативные документы',
    'height' => 75,
    'align' => 'center'
  ]);
}
?>

  <!-- Заголовок -->
  <h1 class="regulatory-documents-title">
    <span class="title-normal">Нормативные </span>
    <span class="title-italic">документы</span>
  </h1>

  <!-- Секция карточек документов -->
  <section class="regulatory-documents-cards">
    <?php
    $docs = new WP_Query([
      'post_type'      => 'regulatory_documents',
      'posts_per_page' => -1,
      'orderby'        => 'title',
      'order'          => 'ASC',
    ]);
    if ($docs->have_posts()):
      while ($docs->have_posts()): $docs->the_post();
        $pdf = get_field('reg_doc_pdf');
        $pdf_url = is_array($pdf) && !empty($pdf['url']) ? esc_url($pdf['url'])
                 : (is_string($pdf) ? esc_url($pdf) : '');
    ?>
      <article class="regulatory-document-card">
        <div class="regulatory-document-content">
          <h2 class="document-title"><?php the_title(); ?></h2>
          <button
            class="btn-view-pdf"
            <?php if ($pdf_url): ?>
              data-pdf-url="<?php echo $pdf_url; ?>"
            <?php else: ?>
              disabled
            <?php endif; ?>
          >
            Смотреть
          </button>
        </div>
      </article>
    <?php
      endwhile;
      wp_reset_postdata();
    else:
      echo '<p>Нормативные документы не найдены.</p>';
    endif;
    ?>
  </section>
</div>

<!-- Модальное окно для PDF -->
<div id="pdf-modal" class="pdf-modal" style="display:none;">
  <div class="pdf-modal-content">
    <button id="pdf-modal-close" class="pdf-modal-close" aria-label="Закрыть">×</button>
    <iframe id="pdf-frame" src="" frameborder="0" allowfullscreen></iframe>
  </div>
</div>

<?php get_footer(); ?>