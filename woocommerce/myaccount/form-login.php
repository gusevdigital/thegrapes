<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<?php endif; ?>

<div class="row" id="customer_login">

	<div class="col-lg-5 mb-5 mb-lg-0">
		<div class="notify p-4 h-100 mb-0">

			<h2><?php esc_html_e( 'Login', 'thegrapes' ); ?></h2>

			<form class="woocommerce-form woocommerce-form-login login" method="post">
				<div class="row">
					<div class="col-lg-12">
						<?php do_action( 'woocommerce_login_form_start' ); ?>
					</div>

					<div class="col-lg-12">
						<div class="input-group">
							<label for="username"><?php esc_html_e( 'Username or email address', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="input-group">
							<label for="password"><?php esc_html_e( 'Password', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
							<input class="woocommerce-Input woocommerce-Input--text input-text input-field" type="password" name="password" id="password" autocomplete="current-password" />
						</div>
					</div>


					<div class="col-lg-12">
						<?php do_action( 'woocommerce_login_form' ); ?>
					</div>

					<div class="col-lg-12">
						<div class="input-group">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme input-checkbox">
								<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
								<span><?php esc_html_e( 'Remember me', 'thegrapes' ); ?></span>
								<span class="checkmark"></span>
							</label>
						</div>
					</div>

					<div class="col-lg-12">
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn btn-primary btn-line mb-3" name="login" value="<?php esc_attr_e( 'Log in', 'thegrapes' ); ?>"><span><?php esc_html_e( 'Log in', 'thegrapes' ); ?></span></button>
					</div>
					<div class="woocommerce-LostPassword lost_password col-lg-12">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'thegrapes' ); ?></a>
					</div>
					<div class="col-lg-12">
						<?php do_action( 'woocommerce_login_form_end' ); ?>
					</div>
				</div>
			</form>
		</div>
	</div>

	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>


	<div class="col-lg-7">
		<div class="notify p-4 h-100 mb-0">
			<h2><?php esc_html_e( 'Become a member', 'thegrapes' ); ?></h2>

			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
				<div class="row">
						<?php do_action( 'woocommerce_register_form_start' ); ?>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
						<div class="col-lg-12">
							<div class="input-group">
									<label for="reg_username"><?php esc_html_e( 'Username', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="col-lg-6">
						<div class="input-group">
							<label for="reg_email"><?php esc_html_e( 'Email address', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</div>
					</div>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
						<div class="col-lg-6">
							<div class="input-group">
								<label for="reg_password"><?php esc_html_e( 'Password', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="password" id="reg_password" autocomplete="new-password" />
							</div>
						</div>
					<?php else : ?>
						<div class="col-lg-12">
							<p><?php esc_html_e( 'A password will be sent to your email address.', 'thegrapes' ); ?></p>
						</div>
					<?php endif; ?>

					<div class="col-lg-12">
						<div class="form-row form-row-wide mailchimp-newsletter woocommerce-validated input-group">
							<label for="mailchimp_woocommerce_newsletter" class="woocommerce-form__label woocommerce-form__label-for-checkbox inline input-checkbox">
								<input class="woocommerce-form__input woocommerce-form__input-checkbox" id="mailchimp_woocommerce_newsletter" type="checkbox" name="mailchimp_woocommerce_newsletter" value="1" checked="checked" />
								<span class="no-letter-spacing"><?php _e( 'Subscribe to our newsletter', 'thegrapes' ); ?></span>
								<span class="checkmark"></span>
							</label>
						</div>
						<?php //do_action( 'woocommerce_register_form' ); ?>
					</div>

					<div class="col-lg-12">
						<input type="hidden" name="register_source" value="Membership page" />
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit btn btn-primary btn-line" name="register" value="<?php esc_attr_e( 'Register', 'thegrapes' ); ?>"><span><?php esc_html_e( 'Register', 'thegrapes' ); ?></span></button>
					</div>

					<div class="col-lg-12">
						<?php do_action( 'woocommerce_register_form_end' ); ?>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
