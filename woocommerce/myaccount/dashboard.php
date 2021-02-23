<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

for ($i=0; $i < 5; $i++) {
  $j = $i + 1;
  $member_benefits[$i]['icon'] = get_theme_mod( 'set_member_benefits_icon_' . $j, '' );
  $member_benefits[$i]['text'] = get_theme_mod( 'set_member_benefits_text_' . $j, '' );
}
?>
<h2><?php _e( 'Your current benifits:', 'thegrapes' ); ?></h2>
<div class="membership-benefits row">
	<?php foreach ($member_benefits as $benefit) : ?>
		<?php if( $benefit['text'] ) : ?>
			<div class="col-12 col-md-6 col-lg-4 mb-3">
				<div class="notify p-3 mb-0 h-100 d-flex align-items-center">
					<?php if( $benefit['icon'] ) : ?>
						<div class="pt-dt-img">
							<img src="<?php echo is_numeric( $benefit['icon'] ) ? wp_get_attachment_url( $benefit['icon'] ) : $benefit['icon']; ?>">
						</div>
					<?php endif; ?>
					<div class="pt-dt-content d-flex flex-column">
						<span class="pt-dt-text"><?php echo $benefit['text']; ?></span>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="col-12 col-md-6 col-lg-4 mb-3">
		<div class="notify p-3 mb-0 h-100 d-flex align-items-center">
			<div class="member-benefit w-100 text-center">
				<div class="text-large mb-2">Ready for shopping?</div>
				<a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" title="<?php _e( 'Our store', 'thegrapes' ); ?>" class="btn btn-primary btn-line"><span><?php _e( 'Our wines', 'thegrapes' ); ?></span></a>
			</div>
		</div>
	</div>
</div>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
