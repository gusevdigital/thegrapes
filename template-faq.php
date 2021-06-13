<?php
/*
# ===================================================
# template-faq.php
#
# Template name: FAQ
# ===================================================
*/

defined( 'ABSPATH' ) || exit;

get_header();

$faq_header_desc = get_theme_mod( 'set_faq_header_desc', '' );
$faq_header_img = get_theme_mod( 'set_faq_header_img' );

?>
<section id="sec-shop-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php _e( 'Frequently asked questions', 'thegrapes' ); ?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
						</ol>
					</nav>
					<div class="subheader mb-5">
						<p class="lead">
							<?php echo wpautop( esc_html($faq_header_desc), false ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
        <?php if( isset($faq_header_img) && $faq_header_img ): ?>
					<div class="intro-bg-img">
            <?php echo wp_get_attachment_image( $faq_header_img, 'full', false, array( 'class' => ' wow fadeInUp nolazyload', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ); ?>
          </div>

				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section id="faq">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php
          $faq = new WP_Query( array(
            'post_type' => 'faq',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
          ));

          if( $faq->have_posts() ) {
            while( $faq->have_posts() ) {
              $faq->the_post();
              get_template_part( 'template-parts/content', get_post_type() );
            }
          }
        ?>
			</div>
		</div>
	</div>
</section>

 <?php

get_footer();
