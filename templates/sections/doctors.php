<?php
global $wpdb, $clinics_list, $services_categories, $doctors_list, $stomatology_categories, $yourmed_clinics ;
?>

<section class="doctors-section">
    <div class="doctors-container">

        <div class="doctors-header">
            <div class="doctors-text">
                <h2 class="doctors-title">
                    <span class="doctors-title-main">Ведущие</span>
                    <span class="doctors-title-sub">врачи стоматологи</span>
                </h2>
                <p class="doctors-description">
                    Более 30 опытных стоматологов одной сети клиник уделяют внимание каждой детали, чтобы каждый пациент чувствовал себя комфортно и особенным.
                </p>
            </div>

            <div class="doctors-nav">
                <button class="doctors-nav-btn prev" aria-label="Предыдущий"></button>
                <button class="doctors-nav-btn next" aria-label="Следующий"></button>
            </div>
        </div>

        <div class="doctors-cards-wrapper">
            <div class="doctors-cards-track">
				<?php foreach ($doctors_list as $doctor) :
					$image = preg_replace('#new\.yourmed24\.ru|stom-new\.int#', 'yourmed.clinic', $doctor['image']);
					$experience = (int)preg_replace('#[^\d]{1,}#msi', '', $doctor['experience'] );

					?>
                    <a href="<?= esc_url($doctor['permalink']); ?>" class="doctor-card">
						<?php if ($image) : ?>
                            <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($doctor['title']); ?>" class="doctor-photo">
						<?php endif; ?>
                        <div class="doctor-info">
                            <div class="doctor-name"><?= esc_html($doctor['title']); ?></div>
                            <div class="doctor-description"><?= esc_html($doctor['job']); ?></div>
                            <div class="doctor-experience">Стаж более <?= esc_html($experience); ?> лет</div>
                        </div>
                    </a>
				<?php endforeach; ?>
            </div>
        </div>

        <div class="doctors-button-wrapper">
            <a href="/doctors" class="doctors-view-all">Смотреть всех врачей клиник</a>
        </div>

    </div>
</section>