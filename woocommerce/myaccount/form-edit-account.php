<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account mb-8" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
<div class="row">
	<div class="col-lg-12">
		<h2><?php _e( 'Personal information', 'thegrapes' ); ?></h2>
	</div>
	<p class="woocommerce-form-row woocommerce-form-row--first col-lg-6">
		<label for="account_first_name"><?php esc_html_e( 'First name', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last col-lg-6">
		<label for="account_last_name"><?php esc_html_e( 'Last name', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide col-lg-6">
		<label for="account_display_name"><?php esc_html_e( 'Display name', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" />
		<span class="small"><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'thegrapes' ); ?></span>
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide col-lg-6">
		<label for="account_email"><?php esc_html_e( 'Email address', 'thegrapes' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text input-field" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>
</div>

	<fieldset>
		<legend><?php esc_html_e( 'Password change', 'thegrapes' ); ?></legend>
		<div class="row">
			<p class="woocommerce-form-row woocommerce-form-row--wide col-lg-4">
				<label for="password_current"><?php esc_html_e( 'Current password', 'thegrapes' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text input-field" name="password_current" id="password_current" autocomplete="off" />
				<span class="small"><?php esc_html_e( 'Leave blank to leave unchanged', 'thegrapes' ); ?></span>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide col-lg-4">
				<label for="password_1"><?php esc_html_e( 'New password', 'thegrapes' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text input-field" name="password_1" id="password_1" autocomplete="off" />
			<span class="small"><?php esc_html_e( 'Leave blank to leave unchanged', 'thegrapes' ); ?></span>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide col-lg-4">
				<label for="password_2"><?php esc_html_e( 'Confirm new password', 'thegrapes' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text input-field" name="password_2" id="password_2" autocomplete="off" />
			</p>
		</div>
	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button btn btn-primary btn-line" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'thegrapes' ); ?>"><span><?php esc_html_e( 'Save changes', 'thegrapes' ); ?></span></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
