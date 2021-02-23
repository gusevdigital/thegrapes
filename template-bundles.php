<?php
/*
# ===================================================
# template-bundles.php
#
# Template name: Bundles
# ===================================================
*/

defined( 'ABSPATH' ) || exit;

get_header();

$bundles_title = get_theme_mod( 'set_bundles_title', '' );
$bundles_desc = get_theme_mod( 'set_bundles_desc', '' );
$bundles_img = get_theme_mod( 'set_bundles_img' );

?>
<section id="sec-shop-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php echo $bundles_title != ''? esc_html($bundles_title) : get_the_title(); ?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $bundles_title != ''? esc_html($bundles_title) : get_the_title(); ?></li>
						</ol>
					</nav>
					<div class="subheader mb-5">
						<p class="lead">
							<?php echo wpautop( esc_html($bundles_desc), false ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
        <?php if( isset($bundles_img) && $bundles_img ): ?>
					<div class="home-intro-bg-img">
						<?php echo wp_get_attachment_image( $bundles_img, 'full', false, array( 'class' => ' wow fadeInUp', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section id="shop">
	<div class="shop-notices container mb-2 mb-lg-4">
		<div class="row">
			<div class="col-12">
			</div>
		</div>
	</div>

		<div class="container position-relative">
			<div class="row archive-bundles pt-6">

        <?php
          if( class_exists( 'WooCommerce' ) ):

            $_args = array(
              'post_type' => 'product',
              'orderby'   => 'menu_order',
							'posts_per_page' => -1,
              'order'     => 'asc',
              'tax_query' => array(
                array(
                  'taxonomy' => 'product_type',
        					'field'    => 'slug',
        					'terms'    => 'bundle',
                )
            	)
            );

            $bundles = new WP_Query($_args);
          ?>
  				<?php
  				//print_r($shop_query->found_posts);
  					while ( $bundles->have_posts() ) {
  						$bundles->the_post();
  						/**
  						 * Hook: woocommerce_shop_loop.
  						 */

  						do_action( 'woocommerce_shop_loop' );

  						wc_get_template_part( 'content', 'product' );
  					}
          endif;
				?>
			</div> <!-- end row -->
			<div class="section-overlay" style="display:none;"></div> <!-- archive loading overlay -->
		</div> <!-- end container -->
  </section>

 <?php

get_footer();
