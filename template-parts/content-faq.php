<?php
/**
 * The template for displaying FAQ itme
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thegrapes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('faq-item')); ?>>
  <h3 class="faq-item__title"><?php the_title(); ?></h3>
  <p class="faq-item__content">
    <?php the_content(); ?>
  </p>
</article>
