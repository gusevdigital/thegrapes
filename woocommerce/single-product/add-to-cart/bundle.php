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

$GLOBALS['bundled_items_list'] = $bundled_items;
?>

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
