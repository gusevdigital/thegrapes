<?php
/**
 * The template for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Woos
 */
?>

<section id="sec-intro">
  <div class="container">
    <div class="row d-flex align-items-center position-relative">
      <div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
        <?php $intro_text_style = has_post_thumbnail() ? 'class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.2s"' : 'class="intro-text"'; ?>
        <div <?php echo $intro_text_style; ?>>
          <h1><?php the_title(); ?></h1>
          <?php the_breadcrumb(); ?>
          <?php if( has_excerpt() && has_post_thumbnail() ) : ?>
          <div class="subheader mb-5 lead">
            <?php the_excerpt(); ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php if( has_post_thumbnail() ) : ?>
      <div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
        <div class="intro-bg-img">
          <?php echo the_post_thumbnail( 'full', array( 'class' => ' wow fadeInUp', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ) ?>
        </div>
			</div>
      <?php endif; ?>
    </div>
  </div>
</section>
<arcticle id="page-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</arcticle>
<section id="page-commets">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php
        if ( comments_open() || get_comments_number() ):
        comments_template();
        endif;
        ?>
      </div>
    </div>
  </div>
</section>
