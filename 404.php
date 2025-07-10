<?php
get_header();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/pages/thank-you.css">

<section class="thank-you">
    <div class="container">
        <div class="popup dent-form">
            <div class="dent-form__image">
                <img src="<?=get_template_directory_uri()?>/assets/img/page-404.jpg" width="400" height="300" alt="Заявка отправлена" loading="lazy">
            </div>
            <div class="dent-form__content">
                <h2>404</h2>
                <p class="dent-form__subtitle">Кажется этой страницы не существует. Пожалуйста вернитесь на главную.</p>
                <a href="/" aria-label="Главная" class="main-button">Вернуться на главную</a>
            </div>
        </div>
    </div>
</section>
