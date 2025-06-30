<?php
/**
 * The template for displaying the footer
 *
 * @package frymstom
 */
?>

<footer class="site-footer">
  <div class="footer-card">
    <!-- 1. Логотип, WhatsApp, Google Play -->
    <div class="footer-section logo-block">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/ymlogofooter.svg" alt="Логотип" class="footer-logo">
  
  <a href="https://wa.me/74993991311" class="whatsapp-button">
    <span class="whatsapp-text">Написать в WhatsApp</span>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/whatsappfooter.svg" alt="WhatsApp" class="whatsapp-icon">
  </a>
  
  <div class="download-app-group">
    <div class="download-text">Скачать приложение</div>
    <a href="#" class="google-play-button">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/googleplayfooter.svg" alt="Google Play" class="google-play-icon">
      <span class="google-play-text">Загрузить в Google play</span>
    </a>
  </div>
</div>

    <!-- 2. Навигация и Контакты -->
    <div class="footer-section nav-contacts">
      <div class="nav-group">
        <div class="section-title">[ НАВИГАЦИЯ ]</div>
        <ul>
          <li><a href="#">Услуги и цены</a></li>
          <li><a href="#">Акции</a></li>
          <li><a href="#">О клинике</a></li>
          <li><a href="#">Врачи</a></li>
          <li><a href="#">Статьи</a></li>
          <li><a href="#">Контакты</a></li>
        </ul>
      </div>
      
      <div class="contacts-group">
        <div class="section-title">[ КОНТАКТЫ ]</div>
        <div class="phone-number">+7 499 399-13-11</div>
        <a href="#" class="callback-btn">Заказать обратный звонок</a>
      </div>
    </div>

    <!-- 3. Адреса -->
    <div class="footer-section address-section">
      <div class="section-title">[ АДРЕСА ]</div>
      <ul class="address-list">
        <li>г. Химки, ул. Совхозная, 9</li>
        <li>г. Химки, ул. Совхозная, 2</li>
        <li>г. Химки, ул. 9 мая, 8</li>
        <li>г. Химки, ул. 9 мая, 8</li>
        <li>г. Химки, ул. 9 мая, 8</li>
        <li class="view-all">Смотреть все адреса</li>
      </ul>
      
      <div class="section-title social-title">[ СОЦ.СЕТИ ]</div>
      <div class="social-icons">
        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/tg.svg" alt="Telegram"></a>
        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/ok.svg" alt="OK"></a>
        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/vk.svg" alt="VK"></a>
        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/youtube.svg" alt="YouTube"></a>
      </div>
    </div>

    <!-- 4. Документация и подписка -->
    <div class="footer-section docs-subscribe">
  <div class="docs-group">
    <div class="section-title">[ ДОКУМЕНТАЦИЯ ]</div>
    <ul>
      <li><a href="#">Лицензии</a></li>
      <li><a href="#">Реквизиты</a></li>
      <li><a href="#">Нормативные документы</a></li>
      <li><a href="#">Политика конфиденциальности</a></li>
    </ul>
  </div>
      
      <div class="subscribe-group">
  <div class="subscribe-text">Уведомления о наших акциях и скидках</div>
  <form class="subscribe-form">
    <input type="email" placeholder="Ваша почта" class="email-input">
    <button type="submit" class="subscribe-btn">Подписаться</button>
  </form>
</div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>Все материалы данного сайта являются объектами авторского права (в том числе дизайн). Запрещается копирование, распространение (в том числе путем копирования на другие сайты и ресурсы в Интернете) или любое иное использование информации и объектов без предварительного письменного согласия правообладателя. Указание ссылки на источник информации является обязательным.</p>
    
    <p>Лицензия № Л035-01255-50/01459624</p>
    
    <p>Материалы, размещенные на данной странице, носят информационный характер и предназначены для образовательных целей. Посетители сайта не должны использовать их в качестве медицинских рекомендаций. Определение диагноза и выбор методики лечения остается исключительной прерогативой вашего лечащего врача! ООО «медицинский центр"Гиппократ» не несёт ответственности за возможные негативные последствия, возникшие в результате использования информации, размещенной на сайте yourmed24.ru</p>
    
    <p>Администрация клиники принимает все меры по своевременному обновлению размещенного на сайте прайс-листа, однако во избежание возможных недоразумений, советуем уточнять стоимость услуг в регистратуре или в контакт-центре по телефону +7 (495) 190-03-03. Размещенный прайс не является офертой. Медицинские услуги оказываются на основании договора. Имеются противопоказания. Необходима консультация врача. 0+.</p>
  </div>
</footer>