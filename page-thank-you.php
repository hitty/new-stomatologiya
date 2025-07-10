<?php
/**
 * Template Name: Спасибо
 * Description: Шаблон страницы успешной отправки формы
 */
get_header();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/pages/thank-you.css">

<section class="thank-you">
    <div class="container">
            <div class="popup dent-form">
                <div class="dent-form__image">
                    <img src="<?=get_template_directory_uri()?>/assets/img/thank-you.jpg" width="400" height="300" alt="Заявка отправлена" loading="lazy">
                </div>
                <div class="dent-form__content">
                    <h2 class="dent-form__title">Спасибо!</h2>
                    <p class="dent-form__subtitle">Ваша заявка успешно отправлена!<br>Мы свяжемся с вами в ближайшее время.</p>
                    <a href="/" aria-label="Главная" class="main-button">Вернуться на главную</a>
                </div>
            </div>
    </div>
</section>
