<?php
/**
 * Template Name: Все Врачи
 * Description: Шаблон страницы со всеми врачами с фильтрацией.
 */
get_header();
?>

<div class="all-doctors-page">

  <!-- ХЛЕБНЫЕ КРОШКИ -->
  <?php
if (!is_front_page()) {
  get_template_part('templates/nav/breadcrumbs', null, [
    'items' => [
      ['label' => 'Главная', 'url' => home_url('/')],
      ['label' => 'Врачи', 'url' => get_permalink()]
    ],
    'current' => 'Все врачи',
    'height' => 75,
    'align' => 'center'
  ]);
}

global $wpdb, $clinics_list, $services_categories, $doctors_list, $stomatology_categories, $yourmed_clinics;

  if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
	  $qry = explode( '&', $_SERVER['QUERY_STRING'] );
	  foreach ( $qry as $q ) {
		  list( $key, $val ) = explode( '=', $q );
		  $gets[ $key ] = $val;
	  }
  }
  $clinic  = get_query_var( 'item' ) ?? '';
  $service = $gets['service_q'] ?? '';
  $fio     = urldecode( $gets['fio_q'] ?? '' );
  $aged    = $gets['aged_q' ]  ?? '' ;

?>

  <!-- СЕКЦИЯ ФИЛЬТРОВ -->
  <section class="all-doctors-filter-section">
    <div class="all-doctors-filter-wrapper">
      <div class="all-doctors-filter-inner">
        <div class="all-doctors-filter-heading">
          <span class="all-heading-main">Стоматологи клиники</span>
          <span class="all-heading-sub">YourMed</span>
        </div>


          <form class="all-doctor-filter-form" id="allDoctorFilterForm" method="get" action="/doctors/">
              <div class="all-doctors-filter-controls">
                  <!-- Категория -->
                  <div class="all-filter-wrapper" data-filter="doc_category">
                      <select class="form-control select2-enable" name="aged_q">
                          <option value="">Возрастная категория</option>
                          <option value="1092" <?php if($aged == 1092) : ?>selected="selected"<?php endif;?>>Для детей</option>
                          <option value="1091" <?php if($aged == 1091) : ?>selected="selected"<?php endif?>>Для взрослых и подростков</option>
                      </select>
                  </div>

                  <!-- Клиника -->
                  <div class="all-filter-wrapper" data-filter="clinic_address">
                      <select class="form-control select2-enable" name="clinic_q">
                          <option value="">Все клиники</option>
		                  <?php foreach($clinics_list as $clinics_item) : ?>
                              <option value="<?=$clinics_item['slug']?>" <?php if($clinic == $clinics_item['slug']) : ?> selected="selected"<?php endif?>><?=$clinics_item['title']?></option>
		                  <?php endforeach; ?>
                      </select>
                  </div>
                  <button type="submit" class="main-button all-find-doctor-button">Найти врача</button>
              </div>
          </form>
          
        
          
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ КАРТОЧЕК -->
  <section class="all-doctors-cards-section">
    <div class="all-doctors-cards-wrapper">
      <div class="all-doctors-cards-track">

          <?php $empty_results = true;
          foreach($doctors_list as $d => $doctor) {
	          $ages = [];
	          foreach ( $doctor['aged'] as $a => $aa ) {
		          $ages[] = $aa->ID;
	          }
	          $show = true;
	          if ( ! empty( $service ) && ! multi_array_search( $service, $doctor['categories'] ) ) {
		          $show = false;
	          }
	          if ( ! empty( $aged ) && ! in_array( $aged, $ages ) ) {
		          $show = false;
	          }
	          if ( ! empty( $clinic ) && ! multi_array_search( $clinic, $doctor['clinics'] ) ) {
		          $show = false;
	          }
	          if ( ! empty( $fio ) && ! preg_match( "#" . $fio . "#ui", $doctor['title'] ) ) {
		          $show = false;
	          }
	          if ( ! empty( $show ) ) {
		          $empty_results = false;

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
                  <?php
	          }
          }
          if( $empty_results ) : ?>
            <p class="all-no-doctors-message">Врачи по заданным параметрам не найдены.</p>
          <?php endif; ?>

      </div>
    </div>
  </section>

</div>


<?php get_template_part('templates/sections/stocks'); ?>
<?php get_template_part('templates/sections/rating'); ?>
<?php get_template_part('templates/sections/certificates'); ?>
<?php get_footer(); ?>