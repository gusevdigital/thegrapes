<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>
<div class="container mb-4">
	<div class="row">
		<div class="col-12">
			<?php foreach ( $notices as $notice ) : ?>

				<div class="d-flex flex-column flex-lg-row justify-content-between align-items-center woocommerce-message notify mb-0 p-3"<?php echo wc_get_notice_data_attr( $notice ); ?> role="alert">
						<?php
							$_notice = $notice['notice'];
							echo strip_tags(preg_replace('#(<a.*?>).*?(</a>)#', '$1$2', wc_kses_notice( $_notice )));
						?>
						<?php if (strip_tags($_notice)) : ?>
							<div class="notice-btn wm-100">
								<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Go to Cart page', 'thegrapes' ); ?>" class="btn btn-outline-primary mr-lg-1 my-3 my-lg-0 btn-line m-100"><span><?php _e( 'View cart', 'thegrapes' ); ?></span></a>
								<a href="<?php echo wc_get_checkout_url(); ?>" title="<?php _e( 'Go to Checkout page', 'thegrapes' ); ?>" class="btn btn-primary btn-line m-100"><span><?php _e( 'Checkout', 'thegrapes' ); ?></span></a>
							</div>
						<?php endif; ?>
				</div>

			<?php endforeach; ?>
		</div>
	</div>
</div>
