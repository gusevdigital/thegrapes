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

				<div class="d-flex flex-column flex-lg-row justify-content-between align-items-center woocommerce-message notify mb-6 p-3"<?php echo wc_get_notice_data_attr( $notice ); ?> role="alert">
					<?php
					$_notice = $notice['notice'];
					$notice_link = str_replace( 'class="', 'class="btn btn-primary mr-lg-1 mt-3 my-lg-0 m-100 ', getStringpart($_notice, '<a ', '</a>' ) );
					$notice_link = strpos($notice_link, '</a>') !== false ? $notice_link : '';
					$checkout_link = '<a class="btn btn-outline-primary mt-3 my-lg-0 m-100" href="' . wc_get_checkout_url() . '">' . __( 'Checkout', 'thegrapes' ) . '</a>';
					$_notice = strip_tags(preg_replace('#(<a.*?>).*?(</a>)#', '$1$2', wc_kses_notice( $_notice )));
					echo $_notice . '<div>' . $notice_link . $checkout_link . '</div>';
					?>
				</div>

			<?php endforeach; ?>
		</div>
	</div>
</div>
