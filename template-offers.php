<?php
/*
# ===================================================
# template-offers.php
#
# Template name: Offers
# ===================================================
*/

defined( 'ABSPATH' ) || exit;

get_header();

$offers_title = get_theme_mod( 'set_offers_title', __( 'Offers', 'thegrapes' ) );
$offers_desc = get_theme_mod( 'set_offers_desc', '' );
$offers_img = get_theme_mod( 'set_offers_img' );

?>
<section id="sec-shop-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php echo $offers_title != ''? esc_html($offers_title) : get_the_title(); ?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $offers_title != ''? esc_html($offers_title) : get_the_title(); ?></li>
						</ol>
					</nav>
					<div class="subheader mb-5">
						<p class="lead">
							<?php echo wpautop( esc_html($offers_desc), false ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
        <?php if( isset($offers_img) && $offers_img ): ?>
					<div class="intro-bg-img">
						<?php echo wp_get_attachment_image( $offers_img, 'full', false, array( 'class' => ' wow fadeInUp nolazyload', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
/*
* DISPLAY WOOCOMMRECE NOTICES
*/

wc_print_notices();

/*
* DISPLAY OFFERS
*/
?>
<section id="offers">
	<div class="container">
		<?php
		  $args = array(
				'post_type' => 'product',
				'posts_per_page' => -1,
				'post_status' => 'publish'
			);
			$args['tax_query'] = array(
				array(
	            'taxonomy' => 'product_type',
	            'field'    => 'slug',
	            'terms'    => 'offer',
	        ),
				);

				$offers = new WP_Query( $args );

				if( $offers->have_posts() ) :
					?>
					<div class="offers mb-6">
					<?php
					while( $offers->have_posts() ) :
						$offers->the_post();

						get_template_part( 'template-parts/content', 'offer' );
					endwhile;
					?>
					</div>
					<?php
				endif;

				wp_reset_postdata();
		?>
	</div>
</section>

 <?php

get_footer();
