<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header">
  <div class="header-inner">
    <!-- Левый блок -->
    <div class="left-block">
      <!-- Логотип -->
      <div class="logo-block">
        <a href="<?php echo esc_url(home_url()); ?>" title="Главная">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/yourdentlogo.svg" alt="Логотип" class="logo">
        </a>
      </div>

      <!-- Адрес -->
      <div class="address-block">
        <div class="address-top">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/marker.svg" alt="Маркер" class="marker-icon">
          <span class="address-text">г. Химки, ул. Совхозная, 9</span>
        </div>

        <div class="branch-selector">
          <button class="branch-toggle">
            Смотреть все филиалы
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-down.svg" alt="Стрелка" class="arrow-icon">
          </button>

          <div class="branches-dropdown">
            <div class="branch-item1">Химки, ул. Совхозная, 9</div>
            <div class="branch-item1">Химки, ул. Совхозная, 4стр1</div>
            <div class="branch-item1">КТ и МРТ центр, Химки, ул. Совхозная, 4стр1</div>
            <div class="branch-item1">Химки, ул. Совхозная, 2</div>
            <div class="branch-item1">Химки, ул. Молодежная, 7к1</div>
            <div class="branch-item1">Химки, ул. Германа Титова, 10</div>
            <div class="branch-item1">Химки, ул. 9 Мая, 8А</div>
            <div class="branch-item">Химки, мкр. Подрезково, ул. Центральная, 4к1</div>
            <div class="branch-item">Путилково, ул. Новотушинская, 3</div>
            <div class="branch-item">Москва, Долгопрудненское шоссе, 6А</div>
            <div class="branch-item">Красногорск, ул. Авангардная, 3</div>
            <div class="branch-item">Дербент, ул. Пушкина, 46е</div>
          </div>
        </div>
      </div>

      <!-- Телефон -->
      <div class="phone-block">
        <div class="phone-top">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone.svg" alt="Телефон" class="phone-icon">
          <a href="tel:+74951900303" class="phone-number">+7 (495) 190 03 03</a>
        </div>
        <div class="phone-bottom">Ежедневно, 09:00–21:00</div>
      </div>
    </div>

    <!-- Правый блок -->
    <div class="icons-block">
      <div class="social-icons">
        <a href="https://web.telegram.org/k/" target="_blank" class="icon-link tg-link">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/tg.svg" alt="Telegram" class="tg-icon swap-icon">
        </a>
        <a href="https://ok.ru" target="_blank" class="icon-link ok-link">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/ok.svg" alt="OK" class="ok-icon swap-icon">
        </a>
        <a href="https://vk.com/feed" target="_blank" class="icon-link vk-link">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vk.svg" alt="VK" class="vk-icon swap-icon">
        </a>
        <a href="https://www.youtube.com" target="_blank" class="icon-link yt-link">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/youtube.svg" alt="YouTube" class="yt-icon swap-icon">
        </a>
      </div>

      <div class="accessibility-icon">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/versionvi.svg" alt="Версия для слабовидящих">
      </div>

      <div class="callback-button">
        <button>Заказать звонок</button>
      </div>
    </div>
  </div>
</header>

<div class="navbar-wrapper">
  <section class="navbar-section">
    <div class="nav-links">
      <a class="nav-link" href="https://new.yourmed24.ru/services/">Услуги <span class="triangle-down"></span></a>
      <a class="nav-link" href="https://new.yourmed24.ru/doctors/">Врачи</a>
      <a class="nav-link" href="https://new.yourmed24.ru/stocks/">Акции 🎁</a>
      <a class="nav-link" href="https://new.yourmed24.ru/prices/">Цены</a>
      <a class="nav-link" href="#">Кейсы</a>
      <a class="nav-link" href="#">О клинике</a>
      <a class="nav-link" href="https://new.yourmed24.ru/articles/">Статьи</a>
      <a class="nav-link" href="https://new.yourmed24.ru/regulatory-documents/">Контакты</a>
    </div>

    <div class="nav-actions">
      <a class="nav-action-button" href="#">Все зубы в рассрочку +</a>
      <button class="circle-button">
        <div class="burger-lines">
          <div class="burger-line"></div>
          <div class="burger-line"></div>
          <div class="burger-line"></div>
        </div>
      </button>
    </div>
  </section>
</div>

<?php wp_footer(); ?>
</body>
</html>