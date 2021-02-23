<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>
	<div class="row mb-4">
		<div class="col-lg-12">
			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>
		</div>
		<div class="col-md-6">
			<div class="input-group">
				<label for="username"><?php esc_html_e( 'Username or email', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
				<div class="input-wrap">
					<input type="text" name="username" class="input-text input-field" id="username" autocomplete="username" />
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="input-group">
				<label for="password"><?php esc_html_e( 'Password', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
				<div class="input-wrap">
					<input type="password" name="password" class="input-text input-field" id="password" autocomplete="current-password" />
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<?php do_action( 'woocommerce_login_form' ); ?>
		</div>
		<div class="col-lg-12">
			<div class="input-group">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme input-checkbox">
					<span><?php esc_html_e( 'Remember me', 'thegrapes' ); ?></span>
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
					<span class="checkmark"></span>
				</label>
			</div>
			<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
			<button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn btn-primary btn-line mb-4" name="login" value="<?php esc_attr_e( 'Login', 'thegrapes' ); ?>"><span><?php esc_html_e( 'Login', 'thegrapes' ); ?></span></button>
			<p class="lost_password">
				<a class="link-decor" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'thegrapes' ); ?></a>
			</p>
			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</div>
	</div>
</form>
