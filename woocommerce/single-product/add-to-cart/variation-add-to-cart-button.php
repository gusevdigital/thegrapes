<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

?>

<div class="pt-add-to-cart d-flex flex-column flex-lg-row align-items-lg-center woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	<?php do_action( 'woocommerce_before_add_to_cart_quantity' );?>
	<!-- Change the `data-field` of buttons and `name` of input field's for multiple plus minus buttons-->
	<?php if ( ! $product->is_sold_individually() ) : ?>
		<div class="input-group input-quantity d-flex mb-4 mr-4 w-auto align-items-center">
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
	<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button btn btn-primary mb-4" id="buy_now_button">
	<?php echo esc_html('Buy Now'); ?>
	</button>
	<input type="hidden" name="is_buy_now" id="is_buy_now" value="0" />
	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
