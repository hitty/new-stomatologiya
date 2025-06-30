<?php
/**
 * Template Name: Карточка врача
 */

get_header();

global $doctors_list;

$post_names = array_column($doctors_list, 'post_name');
$found_key = array_search(get_query_var('doctor_slug') ?: 'false', $post_names);
$doctor = $doctors_list[is_int($found_key) ? $found_key : 'false'];
if (empty($doctor) ) {
	echo "<script>window.location='/404/'</script>";
	exit();
}

$post_thumbnail = preg_replace('#new\.yourmed24\.ru|stom-new\.int#', 'yourmed.clinic', $doctor['image']);
$certificates = $doctor['certificates'];
$works_stomatology = $doctor['works_stomatology'];
$ccc = $doctor['v_b'];
$experience = (int)preg_replace('#[^\d]{1,}#msi', '', $doctor['experience'] );
?>

	<section class="doctor">
		<div class="doctor__wrapper">
			<div class="doctor__photo-block">
				<?php if ($post_thumbnail): ?>
					<img src="<?= esc_url($post_thumbnail); ?>" alt="<?= esc_attr($doctor['title']); ?>" class="doctor__photo">
				<?php endif; ?>
			</div>
			<div class="doctor__right">
				<h1 class="doctor__name"><?= esc_html($doctor['title']); ?></h1>

				<div class="doctor__content">
					<div class="doctor__block">
						<p class="doctor__subtitle">Специализация:</p>
						<p class="doctor__text"><?= esc_html($doctor['job']); ?></p>
					</div>

					<div class="doctor__block">
						<p class="doctor__subtitle">Профессиональный стаж:</p>
						<p class="doctor__text">Более <?= esc_html($experience); ?> лет</p>
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
	'профессиональные_навыки' => 'Профессиональные навыки',
	'obrazovanie' => 'Образование',
	'internatura_ordinatura' => 'Интернатура/ординатура',

	'kursy' => 'Курсы повышения квалификации',
	'dostizheniya' => 'Достижения',
	'science' => 'Научная деятельность'
];
?>

	<section class="doctor-accordion">
		<div class="doctor-accordion__wrapper">
			<?php
			$first = true;
			foreach ($accordion_fields as $field => $label):
				$content = $doctor[$field];
				if (!$content) continue;
				$paragraphs = explode("\n", trim($content));
				?>
				<div class="accordion-card <?= $first ? 'active' : '' ?>">
					<div class="accordion-header">
						<span class="accordion-title"><?= esc_html($label); ?></span>
						<span class="accordion-toggle">+</span>
					</div>
					<div class="accordion-body">
						<?=$content?>
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
$video_url = $doctor['v_b'];

if ($video_url):
	?>
	<section class="doctor-vbio-section" id="vbio-section">
		<div class="container">
			<h2 class="vbio-title">Видеобиография врача</h2>
			<div class="video-wrapper">
                <iframe width="100%" height="600" src="<?=$doctor['v_b']?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
	</section>
<?php endif; ?>

	<!-- Сертификаты Врача -->
<?php
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
			<?php foreach ($certificates as $image):
				$url = preg_replace( '#yourmed24\.ru|stom-new\.int#', 'yourmed.clinic', $image['url']  );
				$img = preg_replace( '#yourmed24\.ru|stom-new\.int#', 'yourmed.clinic', $image['sizes']['medium']  );

				?>
				<div class="certificate-item">
					<img src="<?php echo esc_url($img); ?>"
					     alt="<?php echo esc_attr($image['alt']); ?>"
					     loading="lazy"
					     class="certificate-img"
					     data-full="<?php echo esc_url($url); ?>">
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

    <?php if(!empty($works_stomatology)) { ?>
    <div class="row" id="works_stomatology" name="works_stomatology">
        <div class="col-12 mt-5">
            <h2 class="clinics-photos-title text-center mb-2">Работы врача</h2>
            <div class="doctor-works-carousel owl-carousel " id="doctor-works">
                <?php
                foreach($works_stomatology as $g => $works_stomatology_item) {
                $img = false;
                $img_before = preg_replace( '#yourmed24\.ru|stom-new\.int#', 'yourmed.clinic', $works_stomatology_item['img_before']  );
                $img_after = preg_replace( '#yourmed24\.ru|stom-new\.int#', 'yourmed.clinic', $works_stomatology_item['img_after']  );
                if( empty( $img_before) && !empty( $img_after ) ) $img = $img_after;
                else if( !empty( $img_before) && empty( $img_after ) ) $img = $img_before;
                ?>
                <div class="doctor-work row align-items-center <?php if( empty( $img ) ) { ?> with--scroller <?php } ?> ">
                    <div class="col-md-6 position-relative">
                        <div class="wrapper">
                            <?php if( !empty( $img ) ) : ?>
                            <img src="<?= $img?>" class="content-image w-100 d-block" alt="До: <?= $works_stomatology_item['title']?>">
                            <?php else : ?>
                            <div class="before">
                                <img src="<?= $img_before?>" class="content-image" alt="До: <?= $works_stomatology_item['title']?>">
                            </div>
                            <div class="after">
                                <img src="<?= $img_after?>" class="content-image" alt="После: <?= $works_stomatology_item['title']?>">
                            </div>
                            <div class="scroller">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-5 ms-auto col-md-6 col-12">
                        <h4 class="mb-4 mt-4 mt-md-0"><?= $works_stomatology_item['title']?></h4>
                        <div class="doctor-work__text"><?= $works_stomatology_item['text']?></div>
                        <span>Врач: <b><?= $doctor['title']?></b></span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

<?php
get_footer();