<?php
/**
 * The template for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thegrapes
 */
?>
<?php if( has_post_thumbnail() ) : ?>

  <div class="carousel-item col-lg-4 <?php echo ! $args['post_i'] ? 'active' : ''; ?>">
    <?php
    $post_with_video = false;
    $video_post = get_post_meta( get_the_ID(), 'video_post_class', true );
    if( $video_post && $video_post == 'yes' &&  $video_preview =  get_post_meta( get_the_ID(), 'video_preview_post_class', true ) )
      $post_with_video = true;
    ?>
    <figure <?php $post_with_video? post_class('pr-container pr-with-video') : post_class('pr-container'); ?>>
      <a href="<?php the_permalink(); ?>">
        <div class="pr-img" style="background-image: url('<?php the_post_thumbnail_url('thegrapes-edu-preview'); ?>');">
          <?php if( $post_with_video ) : ?>
            <video autoplay muted loop preload="none">
              <data-src src="<?php echo esc_url( $video_preview ); ?>" type="video/mp4">
            </video>
          <?php endif; ?>
        </div>
        <div class="pr-overlay"></div>
        <?php if( $post_with_video ) : ?>
          <div class="pr-video d-flex">
            <span class="pr-video-icon"></span>
          </div>
        <?php endif; ?>
        <?php
        $read_time = get_post_meta( get_the_ID(), 'post_read_time', true );
        $custom_read_time = get_post_meta( get_the_ID(), 'read_time_post_class', true );
        if( $read_time || ( $custom_read_time && $custom_read_time > 0 ) ) :
        ?>
          <div class="pr-time d-flex">
            <span class="pr-time-icon"></span>
            <span class="pr-time-amount"><?php echo $custom_read_time ? $custom_read_time : $read_time; ?> min.</span>
          </div>
        <?php endif; ?>
        <div class="pr-content d-flex align-items-end">
          <h4 class="pr-title"><?php the_title(); ?></h4>
        </div>
      </a>
    </figure>
  </div>
<?php endif; ?>
