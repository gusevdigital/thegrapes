<?php
/**
 * Checkout terms and conditions area.
 *
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( apply_filters( 'woocommerce_checkout_show_terms', true ) && function_exists( 'wc_terms_and_conditions_checkbox_enabled' ) ) {
	do_action( 'woocommerce_checkout_before_terms_and_conditions' );

	?>
	<div class="woocommerce-terms-and-conditions-wrapper">
		<?php
		/**
		 * Terms and conditions hook used to inject content.
		 *
		 * @since 3.4.0.
		 * @hooked wc_checkout_privacy_policy_text() Shows custom privacy policy text. Priority 20.
		 * @hooked wc_terms_and_conditions_page_content() Shows t&c page content. Priority 30.
		 */
		do_action( 'woocommerce_checkout_terms_and_conditions' );
		?>

		<?php if ( wc_terms_and_conditions_checkbox_enabled() ) : ?>
			<div class="form-row validate-required input-group">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox input-checkbox">
					<span class="woocommerce-terms-and-conditions-checkbox-text"><?php wc_terms_and_conditions_checkbox_text(); ?></span>&nbsp;<span class="required">*</span>
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="terms" type="checkbox" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); // WPCS: input var ok, csrf ok. ?> id="terms" />
					<span class="checkmark"></span>
				</label>
			</div>
		<?php endif; ?>
		<div class="form-row form-row-wide mailchimp-newsletter woocommerce-validated input-group">
			<label for="mailchimp_woocommerce_newsletter" class="woocommerce-form__label woocommerce-form__label-for-checkbox inline input-checkbox">
				<input class="woocommerce-form__input woocommerce-form__input-checkbox" id="mailchimp_woocommerce_newsletter" type="checkbox" name="mailchimp_woocommerce_newsletter" value="1" checked="checked" />
				<span class="no-letter-spacing"><?php _e( 'Subscribe to our newsletter', 'thegrapes' ); ?></span>
				<span class="checkmark"></span>
			</label>
		</div>
	</div>
	<?php

	do_action( 'woocommerce_checkout_after_terms_and_conditions' );
}
