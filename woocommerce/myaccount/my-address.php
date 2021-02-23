<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'thegrapes' ),
			'shipping' => __( 'Shipping address', 'thegrapes' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Delivery address', 'thegrapes' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>
<h2><?php _e( 'Delivery address', 'thegrapes' ); ?></h2>
<p>
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'thegrapes' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>
<div class="row">
<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="u-columns woocommerce-Addresses col2-set addresses">
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php
		$address = wc_get_account_formatted_address( $name );
		$col     = $col * -1;
		$oldcol  = $oldcol * -1;
	?>

	<div class="col-lg-6 woocommerce-Address mb-6">
		<div class="woocommerce-Address-title title">
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit link-decor mb-1 d-inline-block"><?php echo $address ? esc_html__( 'Edit', 'thegrapes' ) : esc_html__( 'Add', 'thegrapes' ); ?></a>
		</div>
		<address>
			<?php
				echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'thegrapes' );
			?>
		</address>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
	<?php
endif;?>
</div>
