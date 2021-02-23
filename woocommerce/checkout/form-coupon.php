<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<span class="woocommerce-form-coupon-toggle checkout-toggle-notice">
	<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M7.06334 10.9886C6.98698 11.0654 6.88279 11.1082 6.77456 11.1082C6.66634 11.1082 6.56215 11.0654 6.48578 10.9886L4.17951 8.68192C3.94016 8.44258 3.94016 8.05447 4.17951 7.81558L4.46829 7.52672C4.7077 7.28738 5.09536 7.28738 5.3347 7.52672L6.77456 8.96666L10.6653 5.07587C10.9047 4.83653 11.2927 4.83653 11.5317 5.07587L11.8205 5.36472C12.0598 5.60406 12.0598 5.9921 11.8205 6.23106L7.06334 10.9886Z" fill="#121212"/>
		<rect x="1" y="1" width="14" height="14" rx="7" stroke="#121212" stroke-width="2"/>
	</svg>
	<span><?php echo esc_html__( 'Have a coupon?', 'woocommerce' ); ?> <a href="#" class="showcoupon link-decor"><?php echo esc_html__( 'Click here to enter your code', 'thegrapes' ); ?></a></span>

</span>
<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
	<div class="row pb-6">
		<div class="col-lg-12">
			<p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'thegrapes' ); ?></p>
			<div class="input-wrap d-lg-inline-block d-block mr-0 mr-lg-2 mb-2 mb-lg-0">
				<input type="text" name="coupon_code" class="input-text input-field" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'thegrapes' ); ?>" />
			</div>
			<button type="submit" class="button btn btn-primary btn-line m-100" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'thegrapes' ); ?>"><span><?php esc_attr_e( 'Apply coupon', 'thegrapes' ); ?></span></button>
			<div class="clear"></div>
		</div>
	</div>
</form>
