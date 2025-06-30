<?php
/* ==== Универсальный шаблон хлебных крошек ==== */

$items = $args['items'] ?? [];
$current = $args['current'] ?? '';
$height = $args['height'] ?? 105;
$align = $args['align'] ?? 'center';

$alignClass = 'align-center';
if ($align === 'top') $alignClass = 'align-top';
elseif ($align === 'bottom') $alignClass = 'align-bottom';
?>

<section class="breadcrumb-nav <?php echo esc_attr($alignClass); ?>" style="min-height: <?php echo intval($height); ?>px;">
  <div class="breadcrumb-container">
    <?php foreach ($items as $item): ?>
      <a class="breadcrumb-item" href="<?php echo esc_url($item['url']); ?>">
        <?php echo esc_html($item['label']); ?>
      </a>
      <span class="breadcrumb-separator">/</span>
    <?php endforeach; ?>

    <?php if ($current): ?>
      <span class="breadcrumb-item current"><?php echo esc_html($current); ?></span>
    <?php endif; ?>
  </div>
</section>