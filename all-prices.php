<?php
/**
 * Template Name: Все цены
 */
get_header();
?>

<!-- ХЛЕБНЫЕ КРОШКИ -->
  <?php
if (!is_front_page()) {
  get_template_part('templates/nav/breadcrumbs', null, [
    'items' => [
      ['label' => 'Главная', 'url' => home_url('/')]
    ],
    'current' => 'Все цены',
    'height' => 75,
    'align' => 'center'
  ]);
}
?>

<section class="prices-section">
  <div class="page-title">
    <h1>
      Стоимость услуг<br>
      <span>стоматологических клиник YourMed</span>
    </h1>
  </div>

  <div class="accordion-wrapper">
    <?php
    while( have_rows('price', get_the_ID()) ): the_row();
	    $index = get_row_index();
	    $content = strip_tags( get_sub_field( 'content'));
	    $content = '<div>' . preg_replace('#([0-9]{1,8}\s?руб?\.)#msiU', '<b>$1</b></div><div>', $content) . '</div>';
	    ?>
	    <div>
            <div class="accordion-item" data-index="<?php echo $index; ?>">
                <div class="accordion-header">
                    <div class="accordion-title"><?php echo esc_html(the_sub_field( 'title' )); ?></div>
                    <button class="accordion-toggle" aria-label="toggle">
                        <svg class="plus-icon" width="16" height="16" viewBox="0 0 16 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect x="7" width="2" height="16" fill="currentColor"/>
                            <rect y="7" width="16" height="2" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
                <div class="accordion-content">
	                <?=$content?>
                </div>
            </div>
          </div>
        </div>
      <?php
        endwhile;
        wp_reset_postdata();
    ?>
  </div>
</section>

<?php get_footer(); ?>