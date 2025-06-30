<?php
/**
 * Template Name: Политика конфиденциальности
 */
get_header();
?>

<main class="privacy-policy-page">
  <div class="container">
    <!-- Заголовок страницы -->
    <div class="policy-header">
      <h1 class="policy-title">
        <span class="title-part-1">Политика в отношении</span>
        <span class="title-part-2">обработки персональных данных</span>
      </h1>
    </div>

    <!-- Контент политики -->
    <div class="policy-content">
      <?php 
      // Используем the_content() чтобы контент можно было редактировать через админку
      if (have_posts()) :
        while (have_posts()) : the_post();
          the_content();
        endwhile;
      endif;
      ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>