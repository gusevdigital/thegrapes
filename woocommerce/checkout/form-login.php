<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>
<span class="woocommerce-form-login-toggle checkout-toggle-notice">
	<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M7.06334 10.9886C6.98698 11.0654 6.88279 11.1082 6.77456 11.1082C6.66634 11.1082 6.56215 11.0654 6.48578 10.9886L4.17951 8.68192C3.94016 8.44258 3.94016 8.05447 4.17951 7.81558L4.46829 7.52672C4.7077 7.28738 5.09536 7.28738 5.3347 7.52672L6.77456 8.96666L10.6653 5.07587C10.9047 4.83653 11.2927 4.83653 11.5317 5.07587L11.8205 5.36472C12.0598 5.60406 12.0598 5.9921 11.8205 6.23106L7.06334 10.9886Z" fill="#121212"/>
		<rect x="1" y="1" width="14" height="14" rx="7" stroke="#121212" stroke-width="2"/>
	</svg>
	<span><?php echo esc_html__( 'Are you a member?', 'thegrapes' ) ?> <a href="#" class="showlogin link-decor"><?php echo esc_html__( 'Click here to login', 'thegrapes' ); ?></a></span>
</span>
<?php

woocommerce_login_form(
	array(
		'message'  => esc_html__( 'If you have a member account, please enter your login details below.', 'thegrapes' ),
		'redirect' => wc_get_checkout_url(),
		'hidden'   => true,
	)
);
