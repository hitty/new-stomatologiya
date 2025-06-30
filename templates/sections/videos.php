<?php
$video_post = get_posts([
  'post_type'      => 'videos',
  'posts_per_page' => 1,
]);

if ($video_post):
  $video = $video_post[0];
  $title = get_field('video_title', $video->ID);
  $video_url_raw = get_field('video_url', $video->ID);
  $video_url = getVideoLink($video_url_raw);
  $formatted_title = preg_replace('/\/(.*?)\//', '<span class="highlight">$1</span>', $title);
  $is_youtube = strpos($video_url, 'youtube.com') !== false;

  $delimiter = (strpos($video_url, '?') === false) ? '?' : '&';
  $params = $is_youtube ? 'enablejsapi=1&autoplay=0&mute=1' : 'autoplay=0';
?>
<section class="videos-section" id="video-section">
  <div class="container">
    <h2 class="video-title"><?php echo $formatted_title; ?></h2>
    <?php if ($video_url): ?>
      <div class="video-wrapper">
        <iframe
          id="video-iframe"
          src="<?php echo esc_url($video_url . $delimiter . $params); ?>"
          frameborder="0"
          allow="autoplay; encrypted-media"
          allowfullscreen
          loading="lazy"
        ></iframe>
      </div>
    <?php endif; ?>
  </div>
  <?php if ($is_youtube): ?>
    <script src="https://www.youtube.com/iframe_api"></script>
  <?php endif; ?>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/videos.js" defer></script>
</section>
<?php endif; ?>