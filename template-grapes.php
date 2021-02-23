<?php
/*
# ===================================================
# template-grapes.php
#
# Template name: Grapes
# ===================================================
*/

defined( 'ABSPATH' ) || exit;

get_header();

$grapes_title = get_theme_mod( 'set_grapes_title', '' );
$grapes_desc = get_theme_mod( 'set_grapes_desc', '' );
$grapes_img = get_theme_mod( 'set_grapes_img' );

?>
<section id="sec-shop-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php echo $grapes_title != ''? esc_html($grapes_title) : get_the_title(); ?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $grapes_title != ''? esc_html($grapes_title) : get_the_title(); ?></li>
						</ol>
					</nav>
					<div class="subheader mb-5">
						<p class="lead">
							<?php echo wpautop( esc_html($grapes_desc), false ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
        <?php if( isset($grapes_img) && $grapes_img ): ?>
					<div class="home-intro-bg-img">
						<?php echo wp_get_attachment_image( $grapes_img, 'full', false, array( 'class' => ' wow fadeInUp', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section id="products-grouping">
	<div class="container">
		<?php
		$taxonomy = 'product-grapes';
		$terms = get_terms([
				'taxonomy' => $taxonomy,
				'hide_empty' => false,
		]);
		foreach ($terms as $term) :
			?>
			<div class="row pt-group mb-6">
				<?php if ( $tax_img = get_term_meta($term->term_id, 'term_image', true) ) : ?>
					<div class="col-lg-4 mb-6">
						<img src="<?php echo $tax_img; ?>" alt="<?php echo $term->name; ?>" class="pt-group-img img-fluid"/>
					</div>
        <?php endif; ?>
				<div class="col-lg-4 mb-4">
					<h2><?php echo $term->name; ?></h2>
					<?php echo wpautop($term->description); ?>
				</div>
				<div class="col-lg-4 mb-6">
					<div class="text-large text-dark mb-2 pt-group-pt-title">
						<?php _e( 'Chosen wines:', 'thegrapes' ); ?>
					</div>
					<?php
					if( class_exists( 'WooCommerce' ) ):
						$args['post_status'] = 'publish';
						$args['post_type'] = 'product';
						$args['posts_per_page'] = -1;
						$args['orderby'] = 'menu_order';
						$args['order'] = 'asc';
						$args['tax_query'] = array(
							array(
								'taxonomy'      => $term->taxonomy,
								'field'         => 'slug',
								'terms'         => $term->slug
							),
						);
						$pt_group = new WP_Query($args);

						while ( $pt_group->have_posts() ) {
  						$pt_group->the_post();
							?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="list-link"><span></span><?php the_title(); ?></a>
							<?php
  					}
          endif;
					?>
				</div>
			</div>
			<?php
		endforeach;
		?>

	</div>
</section>

 <?php

get_footer();
