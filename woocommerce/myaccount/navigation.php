<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );

$current_url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>

<nav class="woocommerce-MyAccount-navigation d-none d-lg-block mb-5">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php if( $endpoint == 'customer-logout' ) : ?>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> btn m-100 mr-0 mr-lg-3 mb-3 btn-simple-primary btn-line"><span><?php echo esc_html( $label ); ?></span></a>
			<?php else : ?>
				<?php $is_active = preg_replace( "#^[^:/.]*[:/]+#i", "", esc_url( wc_get_account_endpoint_url( $endpoint ) ) ) == $current_url ? true : false; ?>
				<a <?php echo !$is_active ? 'href="' . esc_url( wc_get_account_endpoint_url( $endpoint ) ) . '"' : ''; ?> class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> btn m-100 mr-0 mr-lg-3 mb-3 btn-line <?php echo $is_active?'btn-primary disabled':'btn-outline-primary'; ?>"><span><?php echo esc_html( $label ); ?></span></a>
			<?php endif; ?>
			<?php endforeach; ?>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
