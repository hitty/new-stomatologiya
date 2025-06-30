<?php
// templates/sections/reviews.php
$yandex_clinics = [
    ['title' => 'Красногорск, Авангардная ул., 3', 'widget_id' => '138202695057'],
    ['title' => 'Химки, Совхозная ул., 4, стр. 1', 'widget_id' => '114493740265'],
    ['title' => 'Подрезково, Центральная ул., 4, корп. 1', 'widget_id' => '1730047121'],
    ['title' => 'Путилково, Новотушинская ул., 3', 'widget_id' => '222256206414'],
    ['title' => 'Химки, ул. 9 Мая, 8А', 'widget_id' => '240268386971'],
    ['title' => 'Химки, ул. Германа Титова, 10', 'widget_id' => '191962775693'],
    ['title' => 'Химки, Молодёжная ул., 7, корп. 1', 'widget_id' => '66640378758'],
    ['title' => 'Химки, Совхозная ул., 4, стр. 1', 'widget_id' => '1181466827'],
    ['title' => 'Химки, Совхозная ул., 9', 'widget_id' => '6672472897'],
    ['title' => 'Москва, Долгопрудненское шоссе, 6А', 'widget_id' => '60110217538']
];
?>

<section class="yandex-reviews-section">
    <div class="container">
        <div class="reviews-header">
            <h2 class="reviews-title">Отзывы</h2>
            <div class="reviews-controls">
                <button class="arrow-button prev-arrow" aria-label="Предыдущий">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 1L1 6L6 11" stroke="#E8E6D4" stroke-width="2"/>
                    </svg>
                </button>
                <button class="arrow-button next-arrow" aria-label="Следующий">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L6 6L1 11" stroke="#E8E6D4" stroke-width="2"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="yandex-reviews-container">
            <?php foreach ($yandex_clinics as $clinic): ?>
                <div class="yandex-review-item">
                    <h3 class="clinic-title"><?= esc_html($clinic['title']) ?></h3>
                    <iframe src="https://yandex.ru/maps-reviews-widget/<?= esc_attr($clinic['widget_id']) ?>?comments" 
                            loading="lazy" width="100%" height="400" 
                            frameborder="0" allowfullscreen></iframe>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>