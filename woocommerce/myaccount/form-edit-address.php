<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Delivery address', 'thegrapes' ) : esc_html__( 'Shipping address', 'thegrapes' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

	<form method="post">

		<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h3><?php // @codingStandardsIgnoreLine ?>

		<div class="woocommerce-address-fields">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

			<div class="woocommerce-address-fields__field-wrapper">
				<div class="row mb-4">
					<?php
					foreach ( $address as $key => $field ) {
						array_push( $field['class'], 'col-12' );
						$field['input_class'] = array( 'input-field' );
						if(
							'billing_first_name' == $key ||
							'billing_last_name' == $key ||
							'billing_phone' == $key ||
							'billing_email' == $key ||
							'billing_address_1' == $key ||
							'billing_postcode' == $key
							) array_push( $field['class'], 'col-lg-4' );
						if( 'billing_address_1' == $key ) {
							$field['label'] = 'Address';
							$field['placeholder'] = 'Apartment, house number and street name';
						}
						woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
					}
					?>
				</div>
			</div>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

			<p>
				<button type="submit" class="button btn btn-primary btn-line" name="save_address" value="<?php esc_attr_e( 'Save address', 'thegrapes' ); ?>"><span><?php esc_html_e( 'Save address', 'thegrapes' ); ?></span></button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>
		</div>

	</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
