<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) :

$related_title = get_theme_mod( 'set_product_related_title', __( 'You may also like…', 'thegrapes' ) );


?>

<!-- Similar products -->
<section id="similar-products">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="mb-3"><?php echo $related_title; ?></h2>
			</div>
		</div>

		<?php woocommerce_product_loop_start(); ?>
		<div id="similar-gallery" class="carousel slide carousel-adaptive" data-ride="carousel" data-interval="4000" data-state="mobile">
			<?php if ( count($upsells) > 1 ) : ?>
				<ol class="carousel-indicators">
					<?php foreach ( $upsells as $i => $upsell ) : ?>
						<li data-target="#similar-gallery" data-slide-to="<?php echo $i; ?>" class="<?php echo !$i ? 'active' : ''; ?>"></li>
					<?php endforeach; ?>
				</ol>
			<?php endif; ?>
			<div class="carousel-inner mx-auto row py-5" role="listbox">
				<?php foreach ( $upsells as $i => $upsell ) : ?>

					<?php
					if( $i >= 3 ) {
						break;
					}
					$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
					set_query_var( 'current_pt_count', $i );
					wc_get_template_part( 'content', 'product-related' );
					?>

				<?php endforeach; ?>
			</div>

		</div>
		<?php woocommerce_product_loop_end(); ?>
	</div>
</section>

	<?php
endif;

wp_reset_postdata();
