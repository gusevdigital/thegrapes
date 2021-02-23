<?php
/**
 * Product Bundle add-to-cart buttons wrapper template
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/add-to-cart/bundle-add-to-cart.php'.
 *
 * On occasion, this template file may need to be updated and you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * We try to do this as little as possible, but it does happen.
 * When this occurs the version of the template file will be bumped and the readme will list any important changes.
 *
 * @version 6.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if( $product->get_stock_quantity()>0 || $product->is_in_stock() ) :

?>
<div class="cart bundle_data bundle_data_<?php echo $product_id; ?>" data-bundle_price_data="<?php echo esc_attr( json_encode( $bundle_price_data ) ); ?>" data-bundle_id="<?php echo $product_id; ?>">
	<?php if ( $is_purchasable ) :
		/**
		 * 'woocommerce_before_add_to_cart_button' action.
		 */
		do_action( 'woocommerce_before_add_to_cart_button' );
		?>
		<div class="pt-price pt-final-price mb-4 <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
			<?php
				echo __( 'Total: ', 'thegrapes' );
				if ( wc_get_price_to_display( $product ) && $product->get_regular_price() > wc_get_price_to_display( $product ) ) {
					echo '<del><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span>' . $product->get_regular_price() . '</bdi></span></del> ';
					echo '<ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span>' . round( wc_get_price_to_display( $product ) ) . '</bdi></span></ins>';
				} else {
					$product->get_price_html();
				}
			?>
		</div>

		<div class="pt-add-to-cart d-flex flex-column flex-lg-row align-items-lg-center">
			<?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>
			<!-- Change the `data-field` of buttons and `name` of input field's for multiple plus minus buttons-->
			<?php if ( ! $product->is_sold_individually() ) : ?>
				<div class="input-group input-quantity d-flex mb-4 mr-4 align-items-center">
					<div class="input-group-button">
						<span data-quantity="minus" data-field="quantity">
							-
						</span>
					</div>
					<?php
						$qty_min = apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product );
						$qty_max = apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product );
						$qty_value = isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity();
					?>
					<input type="number" data-qty="quantity" data-price="<?php echo $product->get_regular_price(); ?>" data-price-sale="<?php echo wc_get_price_to_display( $product ) && $product->get_regular_price() > wc_get_price_to_display( $product ) ? round( wc_get_price_to_display( $product ) ) : '0'; ?>" data-price-currency="<?php echo get_woocommerce_currency_symbol(); ?>" id="product_qty" class="input-text qty text input-group-field" step="1"
					min="<?php echo $qty_min; ?>" max="<?php echo $qty_max != -1 ? $qty_max : '99'; ?>"
					name="quantity" value="<?php echo $qty_value; ?>" title="<?php _e( 'Product Quantity', 'thegrapes' ); ?>" placeholder="" inputmode="numeric">
					<!--<input class="input-group-field" type="number" name="quantity" value="1" min="1" max="10">-->
					<div class="input-group-button">
						<span data-quantity="plus" data-field="quantity">
							+
						</span>
					</div>
				</div>
			<?php endif; ?>
			<?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button btn btn-outline-primary mb-4 mr-lg-4"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
			<input type="hidden" name="add-to-cart" value="<?php echo $product_id; ?>" />
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button btn btn-primary mb-4" id="buy_now_button">
			<?php echo esc_html('Buy Now'); ?>
			</button>
			<input type="hidden" name="is_buy_now" id="is_buy_now" value="0" />
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php else : ?>
		<div class="bundle_unavailable woocommerce-info pt-stock">
			<?php echo $purchasable_notice;?>
		 </div>
	<?php endif; ?>
</div>
<?php
else :
	?>
	<div class="bundle_availability pt-stock mb-4"><?php

		// Availability html.
		echo $availability_html;

	?></div>
<?php endif;
