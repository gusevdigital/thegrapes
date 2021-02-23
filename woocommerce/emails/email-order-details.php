<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<h2>
	<?php
	if ( $sent_to_admin ) {
		$before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '">';
		$after  = '</a>';
	} else {
		$before = '';
		$after  = '';
	}
	/* translators: %s: Order ID. */
	echo wp_kses_post( $before . sprintf( __( '[Order #%s]', 'thegrapes' ) . $after . ' (<time datetime="%s">%s</time>)', $order->get_order_number(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) ) );
	?>
</h2>

<div style="margin-bottom: 40px;" class="thegrapes-order-details">
	<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: Arial, sans-serif;margin-bottom: 48px;">
		<thead>
			<tr>
				<th class="td" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>;"><?php esc_html_e( 'Product', 'thegrapes' ); ?></th>
				<th class="td" scope="col" style="text-align: center;"><?php esc_html_e( 'Price', 'thegrapes' ); ?></th>
				<th class="td" scope="col" style="text-align: center;"><?php esc_html_e( 'Quantity', 'thegrapes' ); ?></th>
				<th class="td" scope="col" style="text-align: right;"><?php esc_html_e( 'Subtotal', 'thegrapes' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => false,
					'image_size'    => 'thegrapes-product-img-thumb',
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
		</tbody>
		<tfoot>
			<?php
			$item_totals = $order->get_order_item_totals();

			if ( $item_totals ) {
				$i = 0;
				foreach ( $item_totals as $total ) {
					if( $total['label'] == 'Shipping:' ) $total['label'] = 'Delivery:';
					$i++;
					if( wp_kses_post( $total['label'] ) != 'Payment method:' ) :
						?>
						<tr>
							<th class="td" scope="row" style="text-align:<?php echo esc_attr( $text_align ); ?>; <?php echo ( 1 === $i ) ? 'border-top-width: 2px;border-top-color:#121212' : ''; ?>"><?php echo wp_kses_post( $total['label'] ); ?></th>
							<td class="td" colspan="3" style="text-align:right; <?php echo ( 1 === $i ) ? 'border-top-width: 2px;border-top-color:#121212;' : ''; ?>"><?php echo wp_kses_post( $total['value'] ); ?></td>
						</tr>
						<?php
					endif;
				}
			}?>
		</tfoot>
	</table>
	<?php
	if ( $order->get_customer_note() ) {
		?>
		<h2><?php esc_html_e( 'Note:', 'thegrapes' ); ?></h2>
		<p style="margin-bottom: 48px;">
			<?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?>
		</p>
		<?php
	}
	?>
	<?php if ( $order->get_payment_method_title() ) : ?>
		<div style="margin-bottom:32px;">
			<h2 style="margin-bottom:24px;"><?php esc_html_e( 'Payment method:', 'thegrapes' ); ?></h2>
			<div style="margin-bottom:24px;font-weight:bold;"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></div>
			<?php
			  switch( $order->get_payment_method() ) {
					case 'cheque':
						$paynow_notify = get_theme_mod( 'set_checkout_paynow_notify', '' );
						$paynow_code = get_theme_mod( 'set_checkout_paynow_code', '' );
						if( $paynow_notify != '' && $paynow_code != '' ) {
							$paynow_notify = str_replace( '[ordernumber]', $order->get_order_number() , $paynow_notify );
							$paynow_notify = str_replace( '[paynowcode]', $paynow_code , $paynow_notify );
							$paynow_notify = str_replace( '<strong>', '<strong style="background-color: #0B223B;display:inline-block;padding:0 4px;">', $paynow_notify );
							$paynow_notify = str_replace( '<a ', '<a style="color:#ffffff!important;" ', $paynow_notify );
							echo '<div style="margin-bottom:24px;background-color:#ED1C2A;color:#ffffff;padding:8px;border-radius:4px;">' . $paynow_notify . '</div>';
						}
						break;
					default :
						echo '<div class="payment-method-notification" style="margin-bottom:24px;background-color:#0B223B;color:#ffffff;padding:8px;border-radius:4px;">';
						do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
						echo '</div>';
				}
			?>
		</div>
	<?php endif; ?>


</div>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
