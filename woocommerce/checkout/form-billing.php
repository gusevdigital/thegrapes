<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h2><?php esc_html_e( 'Delivery address', 'thegrapes' ); ?></h2>

	<?php else : ?>

		<h2><?php esc_html_e( 'Delivery address', 'thegrapes' ); ?></h2>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper row">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) :
			array_push( $field['class'], 'col-12' );
			$field['input_class'] = array( 'input-field' );
			if(
				'billing_first_name' == $key ||
				'billing_last_name' == $key ||
				'billing_phone' == $key ||
				'billing_email' == $key ||
				'billing_address_1' == $key ||
				'billing_postcode' == $key
				) array_push( $field['class'], 'col-lg-6' );
			if( 'billing_address_1' == $key ) {
				$field['label'] = 'Address';
				$field['placeholder'] = 'Apartment, house number and street name';
			}
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		endforeach;
		?>
	</div>
	<div class="row">
		<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
	</div>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account input-group">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox input-checkbox">
					<span><?php esc_html_e( 'Become a member', 'thegrapes' ); ?></span>
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" />
					<span class="checkmark"></span>
				</label>
				<span class="small d-inline-block w-100">
					<?php
					  echo '<a target="_blank" href="' . home_url( '/membership' ) . '" title="' . __( 'Membership', 'thegrapes' ) . '">' . __( 'Click here', 'thegrapes' ) . '</a>';
						_e( ' to read about membership benefits', 'thegrapes' );
					?>
				</span>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<input type="hidden" name="register_source" value="Checkout page" />
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) :
					$field['input_class'] = array( 'input-field' );
					$field['label'] = __( 'Create member account password', 'thegrapes' );
					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
				<div class="pt-4"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
