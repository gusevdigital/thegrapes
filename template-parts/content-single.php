<?php
/**
 * The template for displaying post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thegrapes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if( has_post_thumbnail() ) : ?>
    <?php
    $video_post = get_post_meta( get_the_ID(), 'video_post_class', true );
    if( $video_post && $video_post == 'yes' &&  $video_header =  get_post_meta( get_the_ID(), 'video_header_post_class', true ) ) : ?>
      <section id="sec-intro" class="post-intro pr-with-video" style="background-image:url('<?php the_post_thumbnail_url('full'); ?>');">
        <div class="sec-video-wrap">
          <video autoplay muted loop preload="none">
            <data-src src="<?php echo esc_url( $video_header ); ?>" type="video/mp4">
          </video>
        </div>
        <div class="sec-overlay"></div>
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="intro-text col-12">
              <h1><?php the_title(); ?></h1>
              <?php the_breadcrumb(); ?>
            </div>
          </div>
        </div>
      </section>
    <?php else: ?>
      <section id="sec-intro" class="post-intro" style="background-image:url('<?php the_post_thumbnail_url(get_the_ID()); ?>');">
        <div class="section-overlay"></div>
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="intro-text col-12">
              <h1><?php the_title(); ?></h1>
              <?php the_breadcrumb(); ?>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>
  <?php else : ?>
    <section id="sec-intro">
      <div class="container">
        <div class="row d-flex align-items-center">
          <div class="intro-text col-12">
            <h1><?php the_title(); ?></h1>
            <?php the_breadcrumb(); ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <div class="content container">
    <div class="row">
      <div class="col-lg-12">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
  <?php
    wp_link_pages( array(
      'before'    => '<p class="inner-pagination">' . 'Pages',
      'after'     => '</p>'
    ));
  ?>
</article>
