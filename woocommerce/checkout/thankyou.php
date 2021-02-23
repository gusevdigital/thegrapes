<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'thegrapes' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay btn btn-primary btn-line"><span><?php esc_html_e( 'Pay', 'thegrapes' ); ?></span></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay btn btn-outline-primary btn-line"><span><?php esc_html_e( 'My account', 'thegrapes' ); ?></span></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

	<h2 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received mb-8"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you! Your order has been received.', 'thegrapes' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
	<div class="row">
		<div class="col-lg-4 mb-6">
			<div class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<div class="pt-dt-item d-flex align-items-center flex-row mb-3 woocommerce-order-overview__order order">
					<div class="pt-dt-img">
						<img src="<?php echo ICONS . '/order-number.png'; ?>">
					</div>
					<div class="pt-dt-content d-flex flex-column">
						<span class="dt-header"><?php esc_html_e( 'Order number', 'thegrapes' ); ?></span>
						<span class="dt-text"><?php echo $order->get_order_number(); ?></span>
					</div>
				</div>

				<div class="pt-dt-item d-flex align-items-center flex-row mb-3 woocommerce-order-overview__date date">
					<div class="pt-dt-img">
						<img src="<?php echo ICONS . '/order-date.png'; ?>">
					</div>
					<div class="pt-dt-content d-flex flex-column">
						<span class="dt-header"><?php esc_html_e( 'Date', 'thegrapes' ); ?></span>
						<span class="dt-text"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
					</div>
				</div>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<div class="pt-dt-item d-flex align-items-center flex-row mb-3 woocommerce-order-overview__email email">
						<div class="pt-dt-img">
							<img src="<?php echo ICONS . '/order-email.png'; ?>">
						</div>
						<div class="pt-dt-content d-flex flex-column">
							<span class="dt-header"><?php esc_html_e( 'Email', 'thegrapes' ); ?></span>
							<span class="dt-text"><?php echo $order->get_billing_email(); ?></span>
						</div>
					</div>
				<?php endif; ?>

				<div class="pt-dt-item d-flex align-items-center flex-row mb-3 woocommerce-order-overview__total total">
					<div class="pt-dt-img">
						<img src="<?php echo ICONS . '/order-total.png'; ?>">
					</div>
					<div class="pt-dt-content d-flex flex-column">
						<span class="dt-header"><?php esc_html_e( 'Total', 'thegrapes' ); ?></span>
						<span class="dt-text"><?php echo $order->get_formatted_order_total();?></span>
					</div>
				</div>

				<?php
				$delivery_date = get_post_meta(  $order->get_id(), 'deliverydate', true );
				if ( $delivery_date ) : ?>
					<div class="pt-dt-item d-flex align-items-center flex-row mb-3 woocommerce-order-overview__payment-method method">
						<div class="pt-dt-img">
							<img src="<?php echo ICONS . '/order-date.png'; ?>">
						</div>
						<div class="pt-dt-content d-flex flex-column">
							<span class="dt-header"><?php esc_html_e( 'Delivery date', 'thegrapes' ); ?></span>
							<span class="dt-text"><?php echo date("F j, Y", strtotime($delivery_date)); ?></span>
						</div>
					</div>
				<?php endif; ?>

				<?php
				$delivery_time = get_post_meta(  $order->get_id(), 'deliverytime', true );
				if ( $delivery_time ) : ?>
					<div class="pt-dt-item d-flex align-items-center flex-row mb-3 woocommerce-order-overview__payment-method method">
						<div class="pt-dt-img">
							<img src="<?php echo ICONS . '/order-time.png'; ?>">
						</div>
						<div class="pt-dt-content d-flex flex-column">
							<span class="dt-header"><?php esc_html_e( 'Delivery date', 'thegrapes' ); ?></span>
							<span class="dt-text"><?php echo $delivery_time; ?></span>
						</div>
					</div>
				<?php endif; ?>

			</div>

		<?php endif; ?>
	</div>

		<?php  ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
</div>

	<?php else : ?>

		<h3 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you! Your order has been received.', 'thegrapes' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>

	<?php endif; ?>

</div>
