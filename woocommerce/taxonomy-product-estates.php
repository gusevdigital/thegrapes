<?php
/**
 * The Template for displaying products in a estate.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<section id="sec-shop-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php single_term_title(); ?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php single_term_title(); ?></li>
						</ol>
					</nav>
					<div class="subheader mb-5">
						<p class="lead">
							<?php echo term_description(); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
        <?php if ( $tax_img = attachment_url_to_postid( get_term_meta(get_queried_object()->term_id, 'term_image', true) ) ) : ?>
		      <div class="home-intro-bg-img">
		      	<?php echo wp_get_attachment_image( $tax_img, 'full', false, array( 'class' => ' wow fadeInUp', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ); ?>
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

		$args['post_status'] = 'publish';
		$args['posts_per_page'] = -1;
		$args['post_type'] = 'product';
    $args['tax_query'] = array(
			'relation' => 'AND',
			array(
        'taxonomy'      => get_queried_object()->taxonomy,
        'field'         => 'slug',
        'terms'         => get_queried_object()->slug
	    ),
			array(
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
			),
		);
		//$args['posts_per_page'] = $wp_query->query_vars['posts_per_page'];
		$args['posts_per_page'] = -1;
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
			default:
				$args['orderby'] = $wp_query->query_vars['orderby'];
				$args['meta_key'] = '';
				$args['order'] = $wp_query->query_vars['order'];
				break;
		}

		$shop_query = new WP_Query( $args );
    ?>
		<div class="container position-relative">
			<div class="row product-archive pt-6"  data-ajax='<?php echo json_encode( $shop_query->query_vars ) ; ?>' data-taxonomy="<?php echo get_queried_object()->taxonomy; ?>" data-slug="<?php echo get_queried_object()->slug; ?>">
				<?php
					while ( $shop_query->have_posts() ) {
						$shop_query->the_post();
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
	 if (  $wp_query->max_num_pages > 1  && $wp_query->posts_per_page > 0 ) :?>
		 <button class="btn btn-outline-primary btn-line m-100 pt-loadmore"><span><?php _e( 'Load more', 'thegrapes' ) ; ?></span></button>
	 <?php endif; ?>
 </div></div></div>
</section>
	 <?php

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	?>
	<section id="no-products" class=" mb-2 mb-lg-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2><?php _e( 'No products found', 'thegrapes' ); ?></h2>
				</div>
			</div>
		</div>
	</section>

	<?php
}

?>
<!-- Other estates -->
<section id="other-estates">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="mb-3"><?php _e( 'Other estates', 'thegrapes' ); ?></h2>
			</div>
		</div>
		<div class="row mb-4">
      <?php
      $taxonomy = 'product-estates';
  		$terms = get_terms([
  				'taxonomy' => $taxonomy,
  				'hide_empty' => false,
  		]);
  		foreach ($terms as $term) :
				if ( get_queried_object()->slug !== $term->slug ) :

	        $vy_url = get_term_link( $term->slug, $term->taxonomy );
	        $vy_name = $term->name;
	        $vy_img = get_term_meta($term->term_id, 'term_image', true);
	        $vy_title= get_term_meta($term->term_id, 'term_preview_title', true);
	        $vy_subtitle= get_term_meta($term->term_id, 'term_preview_subtitle', true);
		      ?>
		      <div class="col-lg-6 mb-6">
		        <div class="vy-pr d-flex flex-row justify-content-start align-items-center">
		          <?php //$vy_link = get_term_link( 'renieri-brunello-di-montalcino', 'product-estates' ); ?>
		          <?php if ( $vy_img ) :
		            $vy_img_m = wp_get_attachment_image_src( thegrapes_get_attachment_id_by_url($vy_img), 'medium');
		            ?>
		          <div class="vy-pr-img mr-4 mb-0">
		            <a href="<?php echo $vy_url; ?>" title="<?php echo $vy_name; ?>" >
		              <img src="<?php echo $vy_img_m[0] ? $vy_img_m[0] : $vy_img; ?>" alt="<?php echo $vy_name; ?>" />
		            </a>
		          </div>
		          <?php endif; ?>
		          <div class="estate-pr-content d-flex flex-column align-items-start">
		            <a href="<?php echo $vy_url; ?>" title="<?php echo $vy_name; ?>" class="link-decoration-none">
		              <h4 class="d-inline-block mb-1"><?php echo $vy_title; ?></h4>
		            </a>
		            <p class="d-inline-block mb-1">
		              <?php echo $vy_subtitle; ?>
		            </p>

		            <a href="<?php echo $vy_url; ?>" title="<?php echo $vy_name; ?>" class="btn btn-simple-primary btn-line"><span><?php _e( 'View Estate', 'thegrapes' ); ?></span></a>
		          </div>
		        </div>
		      </div>
		      <?php
				endif;
      endforeach;
      ?>
    </div>
		<div class="row">
			<div class="col-lg-12 mb-6 text-center">
				<label class="d-block d-lg-inline-block mr-0 mr-lg-2 mb-4 mb-lg-0 text-center text-lg-left"><?php _e( 'Want to see all wines from every estate?', 'thegrapes' ); ?></label>
				<a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="btn btn-primary btn-line text-center"><span><?php _e( 'Main shop page', 'thegrapes' ); ?></span></a>
			</div>
		</div>
	</div>
</section>

<?php

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
