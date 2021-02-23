<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<div class="woocommerce-customer-details col-lg-3 mb-6">

	<?php if ( $order->get_payment_method_title() ) : ?>
		<div class="order-payment-method mb-4">
			<h3 class="woocommerce-column__title text-large mb-3"><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></h3>
			<div class="text-decor mb-3"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></div>
			<?php
			  switch( $order->get_payment_method() ) {
					case 'cheque':
						$paynow_notify = get_theme_mod( 'set_checkout_paynow_notify', '' );
						$paynow_code = get_theme_mod( 'set_checkout_paynow_code', '' );
						if( $paynow_notify != '' && $paynow_code != '' ) {
							$paynow_notify = str_replace( '[ordernumber]', $order->get_order_number() , $paynow_notify );
							$paynow_notify = str_replace( '[paynowcode]', $paynow_code , $paynow_notify );
							echo '<div class="payment-highlight mb-3">' . $paynow_notify . '</div>';
						}
						break;
					default :
						echo '<div class="payment-notification">';
						do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
						echo '</div>';
				}
			?>
		</div>
	<?php endif; ?>

	<?php if ( $show_shipping ) : ?>

	<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
		<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">

	<?php endif; ?>

	<h3 class="woocommerce-column__title text-large"><?php esc_html_e( 'Delivery information', 'woocommerce' ); ?></h3>

	<address>
		<p>
			<div>
				<strong><?php _e( 'Address:', 'thegrapes' ); ?></strong>
			</div>
			<?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
		</p>
		<?php if ( $order->get_billing_phone() ) : ?>
			<p>
				<div>
					<strong><?php _e( 'Phone:', 'thegrapes' ); ?></strong>
				</div>
				<span class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></span>
			</p>
		<?php endif; ?>

		<?php if ( $order->get_billing_email() ) : ?>
			<p>
				<div>
					<strong><?php _e( 'Email:', 'thegrapes' ); ?></strong>
				</div>
				<span class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></span>
			</p>
		<?php endif; ?>
	</address>



	<?php if ( $show_shipping ) : ?>

		</div><!-- /.col-1 -->

		<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Delivery address', 'woocommerce' ); ?></h2>
			<address>
				<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
			</address>
		</div><!-- /.col-2 -->

	</section><!-- /.col2-set -->

	<?php endif; ?>

	<?php if ( $order->get_customer_note() ) : ?>
		<div>
			<strong><?php esc_html_e( 'Note:', 'woocommerce' ); ?></strong>
		</div>
		<p>
			<?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?>
		</p>
	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</div>
