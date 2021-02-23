<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_align = is_rtl() ? 'right' : 'left';
$address    = $order->get_formatted_billing_address();
$shipping   = $order->get_formatted_shipping_address();

?><table id="addresses" cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top; margin-bottom: 40px; padding:0;" border="0">
	<tr>
		<td style="text-align:<?php echo esc_attr( $text_align ); ?>; font-family: Arial, sans-serif; border:0; padding:0;" valign="top" width="50%">
			<h2><?php esc_html_e( 'Delivery address', 'thegrapes' ); ?></h2>
			<table style="width:100%;">
				<tr>
					<td style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
						<address class="address">
							<p style="margin-bottom: 16px;">
								<div>
									<strong style="color:#121212;"><?php _e( 'Address:', 'thegrapes' ); ?></strong>
								</div>
								<?php echo wp_kses_post( $address ? $address : esc_html__( 'N/A', 'thegrapes' ) ); ?>
							</p>
							<?php if ( $order->get_billing_phone() ) : ?>
								<p style="margin-bottom: 16px;">
									<div>
										<strong style="color:#121212;"><?php _e( 'Phone:', 'thegrapes' ); ?></strong>
									</div>
									<?php echo wc_make_phone_clickable( $order->get_billing_phone() ); ?>
								</p>
							<?php endif; ?>
							<?php if ( $order->get_billing_email() ) : ?>
								<p style="margin-bottom: 16px;">
									<div>
										<strong style="color:#121212;"><?php _e( 'Email:', 'thegrapes' ); ?></strong>
									</div>
									<?php echo esc_html( $order->get_billing_email() ); ?>
								</p>
							<?php endif; ?>
						</address>
					</td>
					<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping ) : ?>
						<td style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;text-align:<?php echo esc_attr( $text_align ); ?>; font-family: Arial, sans-serif; padding:0;" valign="top" width="50%">
							<h2><?php esc_html_e( 'Shipping address', 'thegrapes' ); ?></h2>

							<address class="address"><?php echo wp_kses_post( $shipping ); ?></address>
						</td>
					<?php endif; ?>
					<td style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
						<?php
						$delivery_date = $order->get_meta('deliverydate');
						if ( $delivery_date ) : ?>
							<div style="display:flex;margin-bottom:24px;">
								<div style="margin-right: 16px;width: 48px!important; min-height: 48px; height: auto;">
									<img src="<?php echo ICONS . '/order-date.png'; ?>" style="width: 100%; height: auto;">
								</div>
								<div>
									<div style="color:#414141;"><?php esc_html_e( 'Delivery date:', 'thegrapes' ); ?></div>
									<div style="font-weight:bold;color:#121212"><?php echo date("F j, Y", strtotime($delivery_date)); ?></div>
								</div>
							</div>
						<?php endif; ?>
						<?php
						$delivery_time = $order->get_meta('deliverytime');
						if ( $delivery_time ) : ?>
							<div style="display:flex; margin-bottom: 24px;">
								<div style="margin-right: 16px;width: 48px!important; min-height: 48px; height: auto;">
									<img src="<?php echo ICONS . '/order-time.png'; ?>" style="width: 100%; height: auto;">
								</div>
								<div>
									<div style="color:#414141;"><?php esc_html_e( 'Delivery time:', 'thegrapes' ); ?></div>
									<div style="font-weight:bold;color:#121212"><?php echo $delivery_time; ?></div>
								</div>
							</div>
						<?php endif; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
