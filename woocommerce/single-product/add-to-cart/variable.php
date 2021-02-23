<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

if( $product->get_stock_quantity()>0 || $product->is_in_stock() ) :

	$attribute_keys  = array_keys( $attributes );
	$variations_json = wp_json_encode( $available_variations );
	$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

	/*foreach ($available_variations as $key => $value) {
		print_r('<h2>'. $key . '</h2>');
		print_r($value);
	}*/

	do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
		<?php do_action( 'woocommerce_before_variations_form' ); ?>
		<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>

			<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'thegrapes' ) ) ); ?></p>
		<?php else : ?>
			<?php foreach ( $attributes as $attribute_name => $options ) :
			$vintage_qty = 0;
			?>
				<div class="pt-<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?> mb-2">
					<div class="text-large text-dark mb-2">
						<?php echo __( 'Choose ', 'thegrapes' ) . '<span class="pt-' . esc_attr( sanitize_title( $attribute_name ) ) . '-attr">' . $attribute_name . '</span>'; ?>
					</div>
					<div class="radios variation-radios d-flex flex-wrap">
						<?php foreach ($options as $i => $option):
						$vintage_qty++;
						?>

							<?php if( isset($available_variations[$i]['display_price']) && $available_variations[$i]['display_price'] > 0 ) : ?>
								<?php
								$_variation = wc_get_product( $available_variations[$i]['variation_id'] );
								$display_price = wc_get_price_to_display($_variation) ;
								$display_regular_price = $available_variations[$i]['display_regular_price'];

								?>
								<label for="<?php echo array_keys($available_variations[$i]['attributes'])[0]; ?>" class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
									<input type="radio" data-price="<?php echo $display_regular_price; ?>" data-sale-price="<?php echo $display_regular_price > $display_price ? round($display_price) : '0'; ?>" name="<?php echo array_keys($available_variations[$i]['attributes'])[0]; ?>" value="<?php echo $option; ?>" />
									<span class="checkbox-text">
										<span class="checkbox-vintage"><?php echo $option; ?></span>
										<?php if ( isset( $available_variations[$i]['display_price'] ) && $available_variations[$i]['display_price'] ) : ?>
											<span class="checkbox-price"><?php echo get_woocommerce_currency_symbol() . round( $display_price ); ?>/bottle</span>
										<?php endif; ?>
										<?php if ( isset( $available_variations[$i]['the_grapes_variation_rating'] ) && $available_variations[$i]['the_grapes_variation_rating'] ) : ?>
											<span class="checkbox-rating"><?php echo $available_variations[$i]['the_grapes_variation_rating']; ?>/100</span>
										<?php endif; ?>
									</span>
									<span class="checkmark-radio">
										<span class="checkmark-radio-checked"></span>
									</span>
								</label>
								<input type="hidden" name="restock-text-<?php echo $available_variations[$i]['variation_id']; ?>" id="restock-text-<?php echo $available_variations[$i]['variation_id']; ?>" value="<?php echo $available_variations[$i]['the_grapes_variation_restock']; ?>" />
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
				<table class="variations d-none" cellspacing="0">
					<tbody>
						<?php foreach ( $attributes as $attribute_name => $options ) : ?>
							<tr>
								<td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></td>
								<td class="value">
									<?php
										wc_dropdown_variation_attribute_options(
											array(
												'options'   => $options,
												'attribute' => $attribute_name,
												'product'   => $product,
											)
										);
										echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endforeach; ?>
			<div class="single_variation_wrap pt-final-price">
				<?php
					/**
					 * Hook: woocommerce_before_single_variation.
					 */
					do_action( 'woocommerce_before_single_variation' );

					/**
					 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
					 *
					 * @since 2.4.0
					 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
					 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
					 */
					do_action( 'woocommerce_single_variation' );

					/**
					 * Hook: woocommerce_after_single_variation.
					 */
					do_action( 'woocommerce_after_single_variation' );
				?>
			</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php else : ?>
	<div class="bundle_availability mb-4"><?php

		_e( 'Out of stock', 'thegrapes' );

	?></div>
<?php endif;
