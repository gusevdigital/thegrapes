<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.5.0
 */

defined( 'ABSPATH' ) || exit;

?>
<script type="text/template" id="tmpl-variation-template">
	<div class="woocommerce-variation-description mb-4">{{{ data.variation.variation_description }}}</div>
	<div class="woocommerce-variation-availability mb-4 pt-stock"><span class="stock-availavility">{{{ data.variation.availability_html }}}</span><span class="stock-left"></span></div>
	<div class="pt-price mb-4 woocommerce-variation-price price">
		<?php _e( 'Total:', 'thegrapes'); ?> <span class="variations-price">{{{ data.variation.price_html }}}</span>
	</div>
	<script>

		if({{{ data.variation.is_in_stock }}} && "{{{ data.variation.max_qty}}}" !== "") {
			jQuery('.woocommerce-variation-availability .stock-left').html( ": {{{ data.variation.max_qty}}} <?php _e( 'left', 'thegrapes' ); ?> " );
		} else if ({{{ data.variation.is_in_stock }}} && "{{{ data.variation.max_qty}}}" === "") {
			jQuery('.woocommerce-variation-availability .stock-availavility').html( "In stock" );
		} else {
			var restock_input = jQuery('#restock-text-' + {{{ data.variation.variation_id}}});
			if( restock_input ) {
				var restock_text = restock_input.val();
				if( restock_text !== '' ) {
					jQuery('.woocommerce-variation-availability .stock-left').html( '.<span> ' + restock_text + '</span>' );
				}
			}
		}

		/*if( {{{ data.variation.display_price }}} != {{{ data.variation.display_regular_price }}} ) {
			var discount_price = {{{ data.variation.display_price }}};
			var discount_price = Math.round(discount_price);
			jQuery('.variations-price').html( '<del><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{{ data.variation.display_regular_price }}}</bdi></span></del> <ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>' + discount_price + '</bdi></span></ins>' );
		} else {
			jQuery('.variations-price').html( '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{{ data.variation.display_regular_price }}}</bdi></span>' );
		}*/
	</script>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p><?php esc_html_e( 'Sorry, this product is unavailable.', 'thegrapes' ); ?></p>
</script>
