<?php
/**
 * Product Bundle single-product template
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/add-to-cart/bundle.php'.
 *
 * On occasion, this template file may need to be updated and you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * We try to do this as little as possible, but it does happen.
 * When this occurs the version of the template file will be bumped and the readme will list any important changes.
 *
 * @version 5.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="pt-bundle pb-2">
	<h2 class="mb-4"><?php _e( 'Wines in the bundle', 'thegrapes' ); ?></h2>
	<?php foreach ( $bundled_items as $bundled_item ) :?>
		<div class="pt-bundle-item mb-4 d-table w-100">
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
<?php

/** WC Core action. */
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart cart_group <?php echo esc_attr( $classes ); ?>" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
<?php

	/**
	 * 'woocommerce_bundles_add_to_cart_wrap' action.
	 *
	 * @since  5.5.0
	 *
	 * @param  WC_Product_Bundle  $product
	 */
	do_action( 'woocommerce_bundles_add_to_cart_wrap', $product );
	?>
</form><?php
	/** WC Core action. */
	do_action( 'woocommerce_after_add_to_cart_form' );
?>
