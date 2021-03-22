<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$pt_stock_status = $product->get_stock_status();
?>
<section id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-single', $product ); ?>>
	<div class="container">
		<div class="row equal">
			<?php
			$product_gallery = array();

			$product_thumbnail_id = $product->get_image_id();

			array_push( $product_gallery, $product_thumbnail_id );

			$attachment_ids = $product->get_gallery_image_ids();

			$product_gallery = array_merge( $product_gallery, $attachment_ids );

			$pt_img_shadow = ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) && USER_BROWSER != 'Safari' && USER_BROWSER != 'Internet Explorer'  ? ' pt-img-shadow' : '';

			if ( $product_thumbnail_id && !empty( $product_gallery )  ) :
			$gallery_length = count( $product_gallery );
			?>
			<div class="col-lg-7">
				<div class="pt-gallery sticky-top pb-8 pb-lg-0">
					<?php if ( $gallery_length > 1 ): ?>
						<div id="product-gallery" class="carousel slide" data-ride="carousel" data-interval="4000">
							<ol class="carousel-indicators">
								<?php
								  for ($i=0; $i < $gallery_length; $i++) :
								  	?>
										<li data-target="#product-gallery" data-slide-to="<?php echo $i; ?>" class="<?php echo !$i ? 'active' : ''; ?>"></li>
										<?php
								  endfor;
								?>
							</ol>
							<div class="carousel-inner">
								<?php foreach ($product_gallery as $i => $id): ?>
									<div class="carousel-item<?php echo !$i ? ' active' : ''; ?>">
										<?php echo wp_get_attachment_image( $id, 'thegrapes-product-img', false, array( 'class' => $pt_img_shadow ) ); ?>
									</div>
								<?php endforeach; ?>
							</div>
							<a class="carousel-control-prev" href="#product-gallery" role="button" data-slide="prev">
								<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M32 14.7507H4.78288L15.5269 4.00662L13.7601 2.23987L0 16L13.7601 29.7601L15.5269 27.9934L4.78288 17.2493H32V14.7507Z" fill="#717171" />
								</svg>
								<span class="sr-only"><?php _e( 'Previous', 'thegrapes' ); ?></span>
							</a>
							<a class="carousel-control-next" href="#product-gallery" role="button" data-slide="next">
								<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M18.2399 2.23987L16.4731 4.00662L27.2171 14.7507H0V17.2493H27.2171L16.4731 27.9934L18.2399 29.7601L32 16L18.2399 2.23987Z" fill="#717171" />
								</svg>

								<span class="sr-only"><?php _e( 'Next', 'thegrapes' ); ?></span>
							</a>
							<?php
							$pt_award = get_post_meta( $product->get_id(), 'thegrapes_product_details_award', true );
							$pt_award_text = get_post_meta( $product->get_id(), 'thegrapes_product_details_award_text', true );
							$pt_award_tooltip =
								isset($pt_award_text) && esc_html($pt_award_text) != '' ?
								'data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="' . esc_html($pt_award_text) . '"' :
								'';
							if ( $pt_award && $pt_award > 0 ): ?>
							<div class="pt-awards">
								<div class="pt-award<?php if( $pt_award_tooltip != '' ) echo ' tooltip-trigger'; ?>" <?php if( $pt_award_tooltip != '' ) echo $pt_award_tooltip; ?>>
									<span class="golden"><?php echo $pt_award; ?></span>
								</div>
							</div>
							<?php endif; ?>
						</div>
					<?php else : ?>
						<div id="product-gallery">
							<?php echo get_the_post_thumbnail( $product->get_id(), 'thegrapes-product-img', array( 'class' => 'img-fluid' . $pt_img_shadow) ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php else : ?>
				<div class="col-lg-7">
					<div class="pt-gallery sticky-top pb-8 pb-lg-0">
						<h2><?php _e( 'No images', 'thegrapes' ); ?></h2>
					</div>
				</div>
			<?php endif;
			?>

			<div class="summary entry-summary col-lg-5">
				<div class="pt-info-wrapper mb-0">
						<?php if( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) : ?>
							<div class="pr-header mb-2">
						<?php else : ?>
							<div class="pr-header">
						<?php endif; ?>
							<?php the_title( '<h1 class="product_title entry-title mb-1">', '</h1>' ); ?>
							<?php if( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) : ?>

									<?php
									$estates_taxonomy = 'product-estates';

									$term_ids = wp_get_post_terms( $product->get_id(), $estates_taxonomy, array('fields' => 'ids') );

									if ( ! empty($term_ids) ) :?>
											<div class="pt-vy mb-1 d-flex align-items-center">
												<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path
														d="M7.99999 3.43945C6.36212 3.43945 5.02959 4.77198 5.02959 6.40986C5.02959 8.04773 6.36212 9.38026 7.99999 9.38026C9.63786 9.38026 10.9704 8.04773 10.9704 6.40986C10.9704 4.77198 9.63789 3.43945 7.99999 3.43945ZM7.99999 8.12957C7.05174 8.12957 6.28027 7.3581 6.28027 6.40986C6.28027 5.46161 7.05174 4.69014 7.99999 4.69014C8.94824 4.69014 9.71971 5.46161 9.71971 6.40986C9.71971 7.3581 8.94824 8.12957 7.99999 8.12957Z"
														fill="#0B223B" />
													<path
														d="M7.99999 0C4.46559 0 1.59015 2.87547 1.59015 6.40984V6.58703C1.59015 8.37453 2.61496 10.4575 4.63621 12.7781C6.10146 14.4603 7.54624 15.6333 7.60699 15.6824L7.99999 16L8.39299 15.6825C8.45377 15.6333 9.89855 14.4603 11.3638 12.7781C13.385 10.4575 14.4098 8.37456 14.4098 6.58706V6.40987C14.4098 2.87547 11.5344 0 7.99999 0ZM13.1591 6.58706C13.1591 9.60784 9.26693 13.2646 7.99999 14.3746C6.73271 13.2642 2.84084 9.60763 2.84084 6.58706V6.40987C2.84084 3.56512 5.15524 1.25072 7.99999 1.25072C10.8447 1.25072 13.1591 3.56512 13.1591 6.40987V6.58706Z"
														fill="#0B223B" />
												</svg>
												<?php echo get_the_term_list( $product->get_id(), $estates_taxonomy, '<span class="pl-1 pr-location">', ', ', '</span>'); ?>
											</div>
											<?php
									endif;
									?>
							<?php endif; ?>
							<?php if( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) : ?>
								<div class="pt-price__wrapper">
									<div class="pt-price <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
										<?php echo $product->get_price_html(); ?>
									</div>
									<?php echo display_product_discount( $product ); ?>
								</div>
							<?php endif; ?>
						</div>
						<?php
						// disable stock

							if( null !== $product->get_stock_status() && $product->get_stock_status() ) :
								if( $pt_stock_status === "instock" && ! $product->is_type( 'bundle' ) &&  ! $product->is_type( 'variable' )) :
									?>
									<div class="pt-stock mb-1">
										<?php
										_e( 'In stock', 'thegrapes' );
										$stock_limit = true;

										if( $product->is_type( 'simple' ) || $product->is_type( 'bundle' ) ) {
											if( $product->get_manage_stock() && $product->get_stock_quantity() ) {
												echo ': ' . $product->get_stock_quantity() . __( ' left', 'thegrapes' );
											}
										} elseif( $product->is_type( 'variable' ) ) {
											$stock_limit = true;
											$variation_ids = $product->get_children(); // Get product variation IDs
											$pt_max_qty = 0;
									    foreach( $variation_ids as $variation_id ){
									        $variation = wc_get_product($variation_id);
													if( $variation->get_manage_stock() != "1" ) {
														$stock_limit = false;
														break;
													}
													if($variation->is_in_stock())
													$pt_max_qty += $variation->get_max_purchase_quantity();
									    }
											if( $stock_limit && $pt_max_qty ) {
												echo ': ' . $pt_max_qty . __( ' left', 'thegrapes' );
											}
										}
										?>
									</div>
									<?php
								elseif ( $pt_stock_status === "outofstock" && ! $product->is_type( 'bundle' ) && ! $product->is_type( 'variable' ) ) :
									$restock_text = get_post_meta( $product->get_id(), 'thegrapes_product_restock_text', true );
									?>
									<div class="pt-stock pt-stock__outofstock mb-1">
										<?php _e( 'Out of stock.', 'thegrapes' ); ?>
									</div>
									<?php if( $restock_text ) : ?>
										<div class="pt-stock mb-1">
											<?php echo '<strong>' . $restock_text . '</strong>'; ?>
										</div>
									<?php endif; ?>
									<?php
								else :
									?>
									<div class=""></div>
									<?php
								endif;
							endif;

						?>
						<?php if( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) : ?>
							<div class="mb-5"></div>
						<?php else : ?>
							<div class="pt-price__wrapper mb-4">
								<div class="pt-price <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
									<?php echo $product->get_price_html(); ?>
								</div>
								<?php echo display_product_discount( $product ); ?>
							</div>
						<?php endif; ?>
						<div class="pt-add-to-cart-wrapper">
							<?php if( $pt_stock_status === "instock" ) : ?>
								<p>
									<?php _e( ' With bundle deals you have 20% discount from the average prices', 'thegrapes' ); ?>
								</p>
							<?php endif; ?>
							<?php do_action( 'woocommerce_single_product_summary' ); ?>
						</div>
						<?php
						if( $pt_stock_status === "instock" ) :
							?>
							<?php $pt_secure_checkout = get_theme_mod( 'set_secure_checkout_img' ); ?>
							<?php if( isset( $pt_secure_checkout ) && $pt_secure_checkout ) : ?>
								<div class="pt-secure-checkout">
								<?php if( is_numeric( $pt_secure_checkout ) ) : ?>
									<?php echo wp_get_attachment_image( $pt_secure_checkout, 'full', false, array( 'class' => 'h-auto w-auto secure-checkout' ) ); ?>
								<?php else: ?>
									<img src="<?php echo $pt_secure_checkout; ?>" class="h-auto w-auto secure-checkout" />
								<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						<div class="pt-info mb-2">
							<?php if( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) : ?>
								<div class="pt-dts row pt-8">
									<?php
									$pt_rating_text = get_theme_mod( 'set_shop_points_text' );
									$pt_rating_tooltip =
										isset($pt_rating_text) && esc_html($pt_rating_text) != '' ?
										'data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="' . esc_html($pt_rating_text) . '"' :
										'';
									?>
									<div class="pt-dt-item col-md-6 mb-4 d-flex flex-row">
										<img class="pt-dt-img" src="<?php echo ICONS . '/details-rating.png'; ?>" />
										<div class="pt-dt-content d-flex flex-column<?php if( $pt_rating_tooltip != '' ) echo ' tooltip-trigger'; ?>" <?php if( $pt_rating_tooltip != '' ) echo $pt_rating_tooltip; ?>>
											<span class="pt-dt-header"><?php _e( 'Rating', 'thegrapes' ); ?>
												<?php if( $pt_rating_tooltip != '' ) : ?>
													<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path
															d="M9.696 12.592C10.848 12.592 11.664 11.952 12.016 10.944L10.608 10.416C10.448 10.864 10.144 11.152 9.696 11.152C9.376 11.152 9.12 10.944 9.12 10.592C9.12 10.16 9.424 9.952 10.48 9.536C11.872 8.992 12.688 8.48 12.688 7.2C12.688 5.664 11.52 4.672 9.728 4.672C7.984 4.672 6.912 5.776 6.672 7.12L8.416 7.408C8.624 6.72 9.104 6.336 9.776 6.336C10.352 6.336 10.816 6.576 10.816 7.136C10.816 7.664 10.464 7.984 9.216 8.464C8.208 8.848 7.488 9.456 7.488 10.544C7.488 11.776 8.416 12.592 9.696 12.592ZM9.696 16.096C10.432 16.096 11.024 15.52 11.024 14.784C11.024 14.048 10.432 13.44 9.696 13.44C8.96 13.44 8.368 14.048 8.368 14.784C8.368 15.52 8.96 16.096 9.696 16.096Z"
															fill="#414141" />
														<rect x="1" y="1" width="18" height="18" rx="9" stroke="#414141" stroke-width="2" />
													</svg>
												<?php endif; ?>
											</span>
											<span class="pt-dt-text"><?php echo get_post_meta( $product->get_id(), 'thegrapes_product_details_rating', true ); ?>/100</span>
										</div>
									</div>
									<div class="pt-dt-item col-md-6 mb-4 d-flex flex-row">
										<div class="pt-dt-img">
											<img src="<?php echo ICONS . '/details-color.png'; ?>" />
										</div>
										<div class="pt-dt-content d-flex flex-column">
											<span class="pt-dt-header"><?php _e( 'Color', 'thegrapes' ); ?></span>
											<span class="pt-dt-text"><?php echo get_post_meta( $product->get_id(), 'thegrapes_product_details_color', true ); ?></span>
										</div>
									</div>
									<div class="pt-dt-item col-md-6 mb-4 d-flex flex-row">
										<div class="pt-dt-img">
											<img src="<?php echo ICONS . '/details-pairing.png'; ?>" />
										</div>
										<div class="pt-dt-content d-flex flex-column">
											<span class="pt-dt-header"><?php _e( 'Food pairing', 'thegrapes' ); ?></span>
											<span class="pt-dt-text"><?php echo get_post_meta( $product->get_id(), 'thegrapes_product_details_food_pairing', true ); ?></span>
										</div>
									</div>
									<div class="pt-dt-item col-md-6 mb-4 d-flex flex-row">
										<div class="pt-dt-img">
											<img src="<?php echo ICONS . '/details-volume.png'; ?>" />
										</div>
										<div class="pt-dt-content d-flex flex-column">
											<span class="pt-dt-header"><?php _e( 'Volume', 'thegrapes' ); ?></span>
											<span class="pt-dt-text"><?php echo get_post_meta( $product->get_id(), 'thegrapes_product_details_volume', true ); ?></span>
										</div>
									</div>
									<div class="pt-dt-item col-md-12 mb-4 d-flex flex-row">
										<div class="pt-dt-img">
											<img class="pt-dt-img" src="<?php echo ICONS . '/details-grapes.png'; ?>" />
										</div>
										<div class="pt-dt-content d-flex flex-column">
											<span class="pt-dt-header"><?php _e( 'Grapes', 'thegrapes' ); ?></span>
											<span class="pt-dt-text"><?php echo get_post_meta( $product->get_id(), 'thegrapes_product_details_grapes', true ); ?></span>
										</div>
									</div>
								</div>
							<?php elseif( $product->is_type( 'bundle' )  ) : ?>
								<div class="pt-dts row">
									<?php if( $bundle_volume = get_post_meta( $product->get_id(), 'thegrapes_product_bundle_volume', true ) ) : ?>
										<div class="pt-dt-item col-md-6 mb-4 d-flex flex-row">
											<div class="pt-dt-img">
												<img src="<?php echo ICONS . '/details-volume.png'; ?>" />
											</div>
											<div class="pt-dt-content d-flex flex-column">
												<span class="pt-dt-header"><?php _e( 'Volume', 'thegrapes' ); ?></span>
												<span class="pt-dt-text"><?php echo $bundle_volume; ?></span>
											</div>
										</div>
									<?php endif; ?>
									<?php if( $bundle_setup = get_post_meta( $product->get_id(), 'thegrapes_product_bundle_setup', true ) ) : ?>
										<div class="pt-dt-item col-md-6 mb-4 d-flex flex-row">
											<div class="pt-dt-img">
												<img src="<?php echo ICONS . '/details-bag.png'; ?>" />
											</div>
											<div class="pt-dt-content d-flex flex-column">
												<span class="pt-dt-header"><?php _e( 'Setup', 'thegrapes' ); ?></span>
												<span class="pt-dt-text"><?php echo $bundle_setup; ?></span>
											</div>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php
						  $product_video_link = get_post_meta( $product->get_id(), 'thegrapes_product_add_youtube', true );
						  $product_video_text = get_post_meta( $product->get_id(), 'thegrapes_product_add_youtube_text', true );
							if( $product_video_link && $product_video_text ) :
								parse_str( parse_url( $product_video_link, PHP_URL_QUERY ), $product_video_ID );
								?>
								<a href="#" class="pt-video d-flex align-items-center video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $product_video_ID['v']; ?>" data-target="#videoModal">
									<div class="pt-video-btn">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path
												d="M21.1629 9.58241L4.97562 0.369568C3.25854 -0.610709 1.50793 0.461369 1.50793 2.38919V21.6219C1.50793 23.2552 2.57123 24 3.55949 24C4.02488 24 4.49905 23.8531 4.97003 23.5665L21.23 13.6137C22.0474 13.1116 22.5064 12.3684 22.4921 11.5741C22.4785 10.779 21.9947 10.0526 21.1629 9.58241ZM20.1404 11.8359L3.88119 21.7864C3.77183 21.8534 3.68562 21.8869 3.62654 21.9037C3.61058 21.8446 3.59461 21.7536 3.59461 21.6219V2.38999C3.59461 2.19202 3.63054 2.09224 3.63054 2.06749C3.6944 2.07148 3.80615 2.10421 3.94665 2.18404L20.1316 11.3969C20.3312 11.511 20.3902 11.61 20.4094 11.5885C20.399 11.6156 20.3311 11.717 20.1404 11.8359Z"
												fill="white" />
										</svg>
									</div>
									<div class="pt-video-text">
										<?php echo $product_video_text; ?>
									</div>
								</a>
							<?php endif;

							?>
						</div>

					</div>

					<div class="pt-info-bundle pt-4">
						<?php
						$bundle_exists = false;
						$bundle_items_html = '';

						$args = array(
							'tax_query'=> array(
							    array(
							        'taxonomy' => 'product_type',
							        'field'    => 'slug',
							        'terms'    => 'bundle',
							    ),
							),
							'posts_per_page' => 4
							);

						$bundled_products = new WP_Query( $args );

						if ( $bundled_products->have_posts() ) {

							while ( $bundled_products->have_posts() ) : $bundled_products->the_post();
								$bundle_id = get_the_ID();
								$pt_ids_db = $wpdb->get_results ( "SELECT product_id FROM wp_woocommerce_bundled_items WHERE bundle_id = {$bundle_id}" );
								$pt_ids = array();
								foreach ($pt_ids_db as  $id) {
									array_push( $pt_ids, $id->product_id);
								}
								if ( in_array( $product->get_id(), $pt_ids ) ) :
									$bundle_exists = true;
									$bundle_product = wc_get_product($bundle_id);

									$bundle_items_html .= '<div class="pt-bundle-item mb-4 d-table w-100">';
										if ( has_post_thumbnail( get_the_ID() ) ) {

											$image_post_id = get_post_thumbnail_id( get_the_ID() );
											$image         = get_the_post_thumbnail( get_the_ID(), 'thegrapes-product-img-bundle');
											$bundle_items_html .= '<div class="pt-bundle-item-img d-table-cell"><a href="' . get_post_permalink( get_the_ID() ) . '" class="btn btn-simple-primary btn-line" title="' . get_the_title( get_the_ID() ) . '">' . $image . '</a></div>';
										}
										$bundle_items_html .= '<div class="pt-bundle-item-desc d-table-cell  pl-3"><div class="pt-bundle-item-desc-info mb-2"><div class="pt-bundle-item-title">';
											$bundle_items_html .= '<a href="' . get_post_permalink( get_the_ID() ) . '" class="link-decoration-none" title="' . get_the_title( get_the_ID() ) . '">' . get_the_title( get_the_ID() ) . '</a>';
											$bundle_items_html .= '</div>';
											$bundle_items_html .= '<div class="pt-bundle-item-price">' . __( 'Price: ', 'thegrapes' ) . $bundle_product->get_price_html() . '</div>';
										$bundle_items_html .= '</div>';
										$bundle_items_html .= '<a href="' . get_post_permalink( get_the_ID() ) . '" class="btn btn-simple-primary btn-line" title="' . get_the_title( get_the_ID() ) . '"><span>' . __( 'View bundle', 'thegrapes' ) . '</span></a>';
										$bundle_items_html .= '</div></div>';
								endif;
							endwhile;
						}
						wp_reset_postdata();
						if($bundle_exists) {
							echo '<h2>' . __( 'See in bundles', 'thegrapes' ) . '</h2>';
							echo $bundle_items_html;
							echo '<div class="bundle-margin-bottom"></div>';
						}

						?>
					</div>
				<?php if ( $product->is_type( 'bundle' ) ) : ?>
					<div class="pt-desc mb-4">
						<?php the_content(); ?>
					</div>
					<?php
					$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
					if ( $short_description && ! $product->is_type( 'bundle' ) ) : ?>
					<div class="text-large mb-2">
						<?php _e( 'Additional', 'thegrapes' ); ?>
					</div>
						<div class="notify desc-add p-2 mb-4">
							<?php echo $short_description; ?>
						</div>
					<?php endif;?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if ( ! $product->is_type( 'bundle' ) ) : ?>
	<div class="container pb-8">
		<div class="row">
			<div class="col-lg-6">
				<?php
					$pt_tasting_notes = get_post_meta( $product->get_id(), 'thegrapes_product_details_tasting_notes', true );
					$pt_soil_composition = get_post_meta( $product->get_id(), 'thegrapes_product_details_soil_composition', true );
					$pt_estate_altitude = get_post_meta( $product->get_id(), 'thegrapes_product_details_estate_altitude', true );
					$pt_aging = get_post_meta( $product->get_id(), 'thegrapes_product_details_aging', true );
					$pt_alcohol = get_post_meta( $product->get_id(), 'thegrapes_product_details_alcohol', true );
					$pt_acidity = get_post_meta( $product->get_id(), 'thegrapes_product_details_acidity', true );
					$pt_extract = get_post_meta( $product->get_id(), 'thegrapes_product_details_extract', true );

					if ( $pt_tasting_notes || $pt_soil_composition || $pt_estate_altitude || $pt_aging || $pt_alcohol || $pt_acidity || $pt_extract ) :
						?>

						<div class="pt-add-info">
							<?php if ( $pt_tasting_notes ) : ?>
							<div class="text-large mb-2">
								<?php _e( 'Tasting notes', 'thegrapes' ); ?>
							</div>
							<p><?php echo $pt_tasting_notes; ?></p>
							<?php endif; ?>
							<?php if ( $pt_soil_composition || $pt_estate_altitude || $pt_aging || $pt_alcohol || $pt_acidity || $pt_extract ) : ?>
							<div class="text-large mb-2">
								<?php _e( 'Details', 'thegrapes' ); ?>
							</div>
							<table class="mb-4">
								<?php if ( $pt_soil_composition ) : ?>
								<tr>
									<th><?php _e( 'Soil composition', 'thegrapes' ); ?></th>
									<td><?php echo $pt_soil_composition; ?></td>
								</tr>
								<?php endif; ?>
								<?php if ( $pt_estate_altitude ) : ?>
								<tr>
									<th><?php _e( 'Estate altitude', 'thegrapes' ); ?></th>
									<td><?php echo $pt_estate_altitude; ?></td>
								</tr>
								<?php endif; ?>
								<?php if ( $pt_aging ) : ?>
								<tr>
									<th><?php _e( 'Aging', 'thegrapes' ); ?></th>
									<td><?php echo $pt_aging; ?></td>
								</tr>
								<?php endif; ?>
								<?php if ( $pt_alcohol ) : ?>
								<tr>
									<th><?php _e( 'Alcohol', 'thegrapes' ); ?></th>
									<td><?php echo $pt_alcohol; ?></td>
								</tr>
								<?php endif; ?>
								<?php if ( $pt_acidity ) : ?>
								<tr>
									<th><?php _e( 'Acidity', 'thegrapes' ); ?></th>
									<td><?php echo $pt_acidity; ?></td>
								</tr>
								<?php endif; ?>
								<?php if ( $pt_extract ) : ?>
								<tr>
									<th><?php _e( 'Dry extract', 'thegrapes' ); ?></th>
									<td><?php echo $pt_extract; ?></td>
								</tr>
								<?php endif; ?>
							</table>
							<?php endif; ?>
						</div>
					<?php endif; ?>
			</div>
			<div class="col-lg-6">
				<div class="text-large mb-2">
					<?php _e( 'Description', 'thegrapes' ); ?>
				</div>
				<div class="pt-desc mb-4">
					<?php the_content(); ?>
				</div>
				<?php
				$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
				if ( $short_description ) : ?>
				<div class="text-large mb-2">
					<?php _e( 'Additional', 'thegrapes' ); ?>
				</div>
					<div class="notify desc-add p-2 mb-4">
						<?php echo $short_description; ?>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>
	<?php elseif ($GLOBALS['bundled_items_list']) : ?>

		<div class="container mb-6">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="mb-4 pt-6 pb-4"><?php _e( 'Wines in the bundle', 'thegrapes' ); ?></h2>
				</div>
			</div>
			<div class="row pt-bundle">
				<?php foreach ( $GLOBALS['bundled_items_list'] as $bundled_item ) :?>
					<div class="pt-bundle-item mb-6 d-table col-lg-4 col-md-6">
						<?php

						$product_id = $bundled_item->item_data['product_id'];

						$product_price = $bundled_item->product->get_price_html();

						$variation_exist = false;

						$pt_bundle_qty = $bundled_item->item_data['quantity_min'];

						if ($bundled_item->product->is_type( 'variable' )) {

							if( isset($bundled_item->item_data['allowed_variations'][0]) && isset( $bundled_item->item_data['default_variation_attributes'] ) ) {
								$variation_id = $bundled_item->item_data['allowed_variations'][0];
								$variations_data = $bundled_item->item_data['default_variation_attributes'];

								$variable_product = wc_get_product($variation_id);
								//$regular_price = $variable_product->get_regular_price();
								//$sale_price = $variable_product->get_sale_price();
								$product_price = $variable_product->get_price_html();

								$variation_exist = true;
							}
						}

						if ( has_post_thumbnail( $product_id ) ) :

								$image_post_id = get_post_thumbnail_id( $product_id );
								$image         = get_the_post_thumbnail( $product_id, 'thegrapes-product-img-bundle img-shadow');
							?>
							<div class="pt-bundle-item-img d-table-cell">
								<a href="<?php echo get_post_permalink( $product_id ); ?>" class="link-decoration-none" title="<?php echo get_the_title( $product_id ); ?>">
									<?php echo $image; ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="pt-bundle-item-desc d-table-cell  pl-3">
							<div class="pt-bundle-item-desc-info mb-2">
								<div class="pt-bundle-item-title">
									<a href="<?php echo get_post_permalink( $product_id ); ?>" class="link-decoration-none" title="<?php echo get_the_title( $product_id ); ?>">
										<?php echo get_the_title( $product_id ); ?>
										<?php
										  if( $pt_bundle_qty > 1 ) {
												echo ' x' . $pt_bundle_qty;
											}
										?>
									</a>
								</div>
								<?php if( $bundled_item->product->is_type( 'variable' ) && $variation_exist ) : ?>
									<div class="pt-bundle-item-vint">
										<?php
										foreach ($variations_data as $key => $value) {
											echo '<div>' . $key . ': ' . $value . '</div>';
										}
										?>
									</div>
								<?php endif; ?>
								<div class="pt-bundle-item-price">
									<?php echo __( 'Price: ', 'thegrapes' ) . $product_price; ?>
								</div>
							</div>
								<a href="<?php echo get_post_permalink( $product_id ); ?>" class="btn btn-simple-primary btn-line" title="<?php echo get_the_title( $product_id ); ?>"><span><?php _e( 'View product', 'thegrapes' ); ?></span></a>
						</div>
					</div>
				<?php
				$attr = false;
				endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</section>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>


<?php do_action( 'woocommerce_after_single_product' ); ?>
