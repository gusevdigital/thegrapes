<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
	exit;
}

?>



	<label for="thegrapes-orderby" class="mr-2 mb-2 mb-lg-0 d-none d-lg-inline-block"><?php _e( 'Sort by:', 'thegrapes' ); ?></label>
	<div class="select-wrap d-lg-inline-block d-block">
		<select name="thegrapes-orderby" id="thegrapes-orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'thegrapes' ); ?>">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<?php global $wp_query; ?>
	<!-- required hidden field for admin-ajax.php -->
	<input type="hidden" name="action" value="thegrapesfilter" />
	<input type="hidden" name="thegrapes_posts_per_page" value="<?php echo $wp_query->query_vars['posts_per_page']; ?>" />
	<input type="hidden" name="paged" value="1" />
	<input type="hidden" name="taxonomy" value="" />
	<input type="hidden" name="slug" value="" />
 <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
