<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

$shop_title = get_theme_mod( 'set_shop_title', '' );
$shop_desc = get_theme_mod( 'set_shop_desc', '' );
$shop_img = get_theme_mod( 'set_shop_img' );

?>
<section id="sec-shop-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php echo esc_html($shop_title); ?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php echo esc_html($shop_title); ?></li>
						</ol>
					</nav>
					<div class="subheader mb-5">
						<p class="lead">
							<?php echo wpautop( esc_html($shop_desc), false ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
				<?php if( isset($shop_img) && $shop_img ): ?>
					<div class="intro-bg-img">
						<?php echo wp_get_attachment_image( $shop_img, 'full', false, array( 'class' => ' wow fadeInUp', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ); ?>
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
	<?php include get_template_directory() . '/woocommerce/shop-filters.php'; ?>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	//do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		/*print_r($wp_query->query_vars['posts_per_page']);
		foreach ($wp_query as $key => $value) {
			print_r('<h2 style="w-100">' . $key . '</h2>');
			print_r($value);
		}*/

		$args['post_status'] = 'publish';
		$args['post_type'] = 'product';
		//$args['posts_per_page'] = $wp_query->query_vars['posts_per_page'];
		$args['posts_per_page'] = -1;
		/*
		switch( $wp_query->query_vars['orderby'] ) {
			case 'price':
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = '_' . $wp_query->query_vars['orderby'];
				$args['order'] = $wp_query->query_vars['order'];
				break;
			case 'date ID' :
				$args['orderby'] = $wp_query->query_vars['orderby'];
				$args['order'] = $wp_query->query_vars['order'];
				break;
			case 'total_sales' :
			case 'thegrapes_product_details_rating' :
			case 'thegrapes_product_details_award' :
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = $wp_query->query_vars['orderby'];
				$args['order'] = $wp_query->query_vars['order'];
				break;
			case 'menu_order' :
				$args['orderby'] = $wp_query->query_vars['orderby'];
				$args['order'] = $wp_query->query_vars['order'];
			default:
				$args['orderby'] = $wp_query->query_vars['orderby'];
				$args['meta_key'] = '';
				$args['order'] = $wp_query->query_vars['order'];
				break;
		}
*/
		// Query only simple and variable products
		$args['tax_query'] = array(
			'relation' => 'OR',
			array(
            'taxonomy' => 'product_type',
            'field'    => 'slug',
            'terms'    => 'simple',
        ),
			array(
            'taxonomy' => 'product_type',
            'field'    => 'slug',
            'terms'    => 'variable',
        ),

			);

			query_posts( $args  );
	//	$shop_query = new WP_Query( $args );
		?>
		<div class="container position-relative">
			<div class="row product-archive pt-6">
				<?php
				//print_r($shop_query->found_posts);
					while ( have_posts() ) {
						the_post();
						/**
						 * Hook: woocommerce_shop_loop.
						 */

						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				?>
			</div> <!-- end row -->
			<div class="section-overlay" style="display:none;"></div> <!-- archive loading overlay -->
		</div> <!-- end container -->
		<?php


	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	 //do_action( 'woocommerce_after_shop_loop' );
	 ?>
	 <div class="container"><div class="row"><div class="col-lg-12 text-center">
		 <?php
	 if (  $wp_query->max_num_pages > 1 && $wp_query->posts_per_page > 0 ) :?>
		 <button class="btn btn-outline-primary btn-line m-100 pt-loadmore"><span><?php _e( 'Load more', 'thegrapes' ) ; ?></span></button>
	 <?php endif; ?>
 </div></div></div>
	 <?php

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
