<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thegrapes
 */

get_header();
?>

<main id="post-content">
  <?php

    while( have_posts() ): the_post();

      get_template_part( 'template-parts/content', 'single' );

      if ( comments_open() || get_comments_number() ):
        ?>
        <div class="container comments">
          <div class="row">
            <div class="col-lg-12">
              <?php
              //comments_template();
              ?>
            </div>
          </div>
        </div>
        <?php
      endif;
    endwhile;
  ?>
</main>
<section id="similar-posts">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $related_title = get_theme_mod( 'set_edu_related_title', __( 'More interesting articles', 'thegrapes' ) ); ?>
        <h2 class="mb-3"><?php echo $related_title; ?></h2>
      </div>
    </div>
    <?php
      $related_count = 3;
      the_similar_posts( $related_count );
    ?>
  </div>
</section>

<?php get_footer(); ?>
