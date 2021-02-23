<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<?php
	$cart_back_url = 'shop';
	$referer_url = $_SERVER['HTTP_REFERER'];
	$referer_parts = explode('/', $referer_url);
	$product_i = array_search( 'product', $referer_parts, true );
	if( $product_i && array_key_exists( $product_i + 1, $referer_parts ) ) {
		$product_slug = $referer_parts[ $product_i+1 ];
		$product_obj = get_page_by_path( $product_slug, OBJECT, 'product' );
		$referer_product = wc_get_product( $product_obj->ID );
		if( $referer_product ) {
			if( $referer_product->get_type() == 'bundle' ) {
				$cart_back_url = 'bundle';
			}
		}
	}



?>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>


	<?php if ( ! WC()->cart->is_empty() && ! count( WC()->cart->get_applied_coupons() ) ) : ?>
		<?php
		$user = wp_get_current_user();
		if ( in_array( 'customer', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) ) :
			$wine_discount_number = 20;
			$wine_discount = 20;
			$cart_content = WC()->cart->get_cart();
			$wine_qty = 0;
			foreach ( $cart_content as $cart_item_key => $cart_item ) {
				$product_id = $cart_item['product_id'];
				$_product = wc_get_product( $product_id  );
				if( $_product->get_type() != 'bundle' ) {
					$wine_qty += $cart_item['quantity'];
				}
				/*
				$list_of_item = wc_get_product_terms( $cart_item['product_id'], $taxonomy_name, array( 'fields' => $get_by ) );
				$intersect    = array_intersect( $list_of_item, $list );
				$check        = $in ? ! empty( $intersect ) : empty( $intersect );
				if ( $check ) {
					$quantity += $cart_item['quantity'];
				}
				*/
			}

		?>
		<div class="notify-dark text-center mb-3">
			<?php
			 if( $wine_qty < $wine_discount_number ) {
					echo sprintf( __( "Add <u>%d</u> more bottles to get <u>%d%% discount</u>!", 'thegrapes' ), $wine_discount_number - $wine_qty,  $wine_discount );
				} else {
					echo __( 'You have <u>20% discount</u>!', 'thegrapes' );
				}
			?>
		</div>
	<?php endif;
	endif; ?>


	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-remove">&nbsp;</th>
				<th class="product-product"><?php esc_html_e( 'Product', 'thegrapes' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'thegrapes' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'thegrapes' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'thegrapes' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			$cart = WC()->cart->get_cart();


			foreach ( $cart as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

					if (strpos( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ), 'bundled_table_item') == false) :

						$additional_class = '';
						if ( $cart_item['data']->get_type() == 'bundle' ) {
							$additional_class = ' align-items-start';
						} else {
							$additional_class = ' align-items-center cart-img-shadow';
						}

					?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="product-remove text-right text-lg-center">
								<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove link-decoration-none" aria-label="%s" data-product_id="%s" data-product_sku="%s">
											<label class="mr-1 mb-0 d-inline-block d-lg-none">Remove:</label>
											<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path
													d="M3.44104 17.0591C4.35741 17.9754 5.42485 18.695 6.61381 19.1979C7.84552 19.7189 9.15304 19.983 10.5001 19.983C11.8471 19.983 13.1546 19.7189 14.3864 19.1979C15.5753 18.695 16.6428 17.9754 17.5592 17.0591C18.4755 16.1427 19.1951 15.0753 19.698 13.8863C20.2189 12.6546 20.4831 11.347 20.4831 10.0001C20.4831 8.65299 20.2189 7.34548 19.698 6.11379C19.1951 4.92483 18.4755 3.85739 17.5592 2.94103C16.6428 2.02466 15.5753 1.30506 14.3864 0.802195C13.1546 0.281197 11.8471 0.0170746 10.5001 0.0170746C9.15304 0.0170746 7.84552 0.281231 6.61381 0.802195C5.42485 1.30506 4.35741 2.02469 3.44104 2.94103C2.52468 3.85736 1.80508 4.92483 1.30218 6.11376C0.781246 7.34548 0.51709 8.65299 0.51709 10.0001C0.51709 11.3471 0.781246 12.6546 1.30221 13.8863C1.80508 15.0753 2.52471 16.1427 3.44104 17.0591ZM10.5001 1.47444C15.2087 1.47444 19.0257 5.29149 19.0257 10.0001C19.0257 14.7086 15.2087 18.5256 10.5001 18.5256C5.7915 18.5256 1.97446 14.7086 1.97446 10.0001C1.97446 5.29149 5.7915 1.47444 10.5001 1.47444Z"
													fill="#898989" />
												<path
													d="M10.5 20.0009C9.15058 20.0009 7.84085 19.7363 6.60709 19.2145C5.41609 18.7107 4.34681 17.9899 3.42895 17.0721C2.51102 16.1541 1.7902 15.0848 1.28648 13.8938C0.764598 12.66 0.5 11.3503 0.5 10.001C0.5 8.65171 0.764598 7.34192 1.28645 6.10806C1.79016 4.91713 2.51102 3.84785 3.42892 2.92992C4.34681 2.01199 5.41613 1.29116 6.60706 0.787446C7.84092 0.265598 9.15068 0.000999451 10.5 0.000999451C11.8494 0.000999451 13.1591 0.265598 14.3928 0.787481C15.5838 1.2912 16.6531 2.01206 17.5711 2.92995C18.489 3.84795 19.2098 4.91723 19.7135 6.10809C20.2354 7.34195 20.5 8.65171 20.5 10.001C20.5 11.3503 20.2354 12.66 19.7135 13.8939C19.2098 15.0848 18.489 16.1541 17.5711 17.0721C16.6532 17.9899 15.5838 18.7107 14.3928 19.2146C13.1591 19.7363 11.8494 20.0009 10.5 20.0009ZM10.5 0.0350183C9.15527 0.0350183 7.85 0.298698 6.62036 0.818778C5.43348 1.32079 4.3678 2.03917 3.453 2.95397C2.53817 3.8688 1.81979 4.93444 1.31778 6.12129C0.797699 7.35097 0.534019 8.65627 0.534019 10.001C0.534019 11.3457 0.797699 12.651 1.31778 13.8806C1.81979 15.0675 2.53817 16.1332 3.453 17.048C4.36777 17.9627 5.43341 18.6811 6.62036 19.1832C7.84987 19.7032 9.15517 19.9669 10.5 19.9669C11.8448 19.9669 13.1501 19.7032 14.3796 19.1832C15.5666 18.6811 16.6322 17.9627 17.547 17.048C18.4619 16.1331 19.1802 15.0674 19.6822 13.8806C20.2023 12.651 20.466 11.3457 20.466 10.001C20.466 8.65627 20.2023 7.35097 19.6822 6.12136C19.1802 4.93454 18.4619 3.86891 17.547 2.954C16.6322 2.0392 15.5665 1.32083 14.3796 0.818812C13.1501 0.298698 11.8448 0.0350183 10.5 0.0350183ZM10.5 18.5436C8.21819 18.5436 6.07293 17.655 4.45945 16.0415C2.84597 14.428 1.95737 12.2828 1.95737 10.001C1.95737 7.71919 2.84594 5.57393 4.45945 3.96045C6.07293 2.34697 8.21819 1.45837 10.5 1.45837C12.7818 1.45837 14.927 2.34697 16.5405 3.96045C18.154 5.57396 19.0426 7.71919 19.0426 10.001C19.0426 12.2828 18.154 14.428 16.5405 16.0415C14.927 17.655 12.7818 18.5436 10.5 18.5436ZM10.5 1.49238C8.22727 1.49238 6.09058 2.37745 4.4835 3.9845C2.87645 5.59158 1.99138 7.72827 1.99138 10.001C1.99138 12.2737 2.87645 14.4104 4.4835 16.0174C6.09055 17.6245 8.22727 18.5096 10.5 18.5096C12.7727 18.5096 14.9094 17.6245 16.5165 16.0174C18.1235 14.4104 19.0086 12.2737 19.0086 10.001C19.0086 7.72827 18.1235 5.59155 16.5165 3.9845C14.9094 2.37742 12.7727 1.49238 10.5 1.49238Z"
													fill="#898989" />
												<path
													d="M6.79061 13.7092C6.93291 13.8516 7.11936 13.9227 7.30585 13.9227C7.49234 13.9227 7.67883 13.8515 7.8211 13.7092L10.4998 11.0305L13.1785 13.7092C13.3208 13.8516 13.5073 13.9227 13.6938 13.9227C13.8803 13.9227 14.0667 13.8515 14.209 13.7092C14.4936 13.4247 14.4936 12.9633 14.209 12.6788L11.5303 10.0001L14.209 7.32134C14.4935 7.03677 14.4935 6.57537 14.209 6.29084C13.9245 6.00627 13.4631 6.00627 13.1785 6.29084L10.4998 8.96958L7.82107 6.29084C7.5365 6.00627 7.0751 6.00627 6.79057 6.29084C6.50601 6.57541 6.50601 7.03677 6.79057 7.32134L9.4693 10.0001L6.79057 12.6788C6.50604 12.9633 6.50604 13.4247 6.79061 13.7092Z"
													fill="#898989" />
												<path
													d="M13.6939 13.9398C13.4947 13.9398 13.3075 13.8622 13.1666 13.7213L10.4999 11.0546L7.83328 13.7213C7.69244 13.8622 7.50517 13.9398 7.30599 13.9398C7.10681 13.9398 6.91954 13.8622 6.7787 13.7213C6.63787 13.5804 6.5603 13.3932 6.5603 13.1941C6.5603 12.9949 6.63787 12.8076 6.7787 12.6668L9.44539 10.0001L6.7787 7.33336C6.48798 7.0426 6.48798 6.56954 6.7787 6.27878C6.91954 6.13794 7.10678 6.06038 7.30599 6.06038C7.50517 6.06038 7.69244 6.13794 7.83328 6.27878L10.5 8.94548L13.1667 6.27878C13.3075 6.13794 13.4948 6.06038 13.6939 6.06038C13.8931 6.06038 14.0803 6.13794 14.2212 6.27878C14.362 6.41962 14.4396 6.60689 14.4396 6.80607C14.4396 7.00525 14.362 7.19253 14.2212 7.33336L11.5545 10.0001L14.2212 12.6668C14.3621 12.8076 14.4397 12.9949 14.4397 13.1941C14.4397 13.3932 14.3621 13.5804 14.2212 13.7213C14.0803 13.8622 13.8931 13.9398 13.6939 13.9398ZM10.4999 11.0065L13.1907 13.6972C13.325 13.8317 13.5038 13.9057 13.6939 13.9057C13.884 13.9057 14.0627 13.8317 14.1972 13.6972C14.3316 13.5629 14.4056 13.3842 14.4056 13.1941C14.4056 13.004 14.3316 12.8252 14.1972 12.6908L11.5063 10.0001L14.1971 7.30931C14.3315 7.1749 14.4055 6.99617 14.4055 6.80607C14.4055 6.61597 14.3315 6.43727 14.1971 6.30286C14.0627 6.16846 13.884 6.09443 13.6939 6.09443C13.5038 6.09443 13.3251 6.16846 13.1907 6.30286L10.4999 8.99362L7.8092 6.30286C7.67479 6.16846 7.49605 6.09443 7.30596 6.09443C7.11586 6.09443 6.93716 6.16846 6.80275 6.30286C6.5253 6.58036 6.5253 7.03182 6.80275 7.30931L9.49349 10.0001L6.80275 12.6908C6.66835 12.8252 6.59432 13.004 6.59432 13.1941C6.59432 13.3842 6.66835 13.5629 6.80275 13.6972C6.9372 13.8317 7.1159 13.9057 7.30599 13.9057C7.49609 13.9057 7.67479 13.8317 7.80923 13.6972L10.4999 11.0065Z"
													fill="#898989" />
											</svg>
											</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'thegrapes' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
								?>
							</td>

							<td class="product-product" data-title="<?php esc_attr_e( 'Product', 'thegrapes' ); ?>">
								<div class="d-flex flex-row<?php echo $additional_class; ?>">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'thegrapes-product-img-bundle' ), $cart_item, $cart_item_key );
									?>
									<div class="product-thumbnail">
										<?php
										if ( ! $product_permalink ) {
											echo $thumbnail; // PHPCS: XSS ok.
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
										}
										?>
									</div>
									<div class='product-info'>
										<div class="product-title">
											<?php

											if ( ! $product_permalink ) {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;' );
											} else {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key ) );
											}
											?>
										</div>
										<div class="product-vintage">
											<?php
											 if ( $cart_item['data']->get_type() == 'bundle' ) {
												 _e( 'Included:', 'thegrapes' );
												 wc_get_formatted_cart_item_data( $cart_item );
												 echo '<ul class="product-info">';
												 foreach ($cart_item['bundled_items'] as $key) {
													 $data = $cart[ $key ][ 'data' ];
													 $amount = $cart[$key]['quantity'];
													 $title = $data->get_title();
												 		echo '<li>';
														echo $title;
														if( $data->get_type() == 'variation' && null !== $data->get_attributes() ) {
															foreach ($data->get_attributes() as $key => $value) {
																if( 'vintage' == $key )
																	echo ' - ' . $value;
															}
														}
														if( $amount > 1 ) {
															echo ' x' . $amount;
														}
														echo '</li>';
												 }
												 echo '</ul>';
											 } else {
												 foreach ($cart_item['data']->get_attributes() as $key => $value) {
													 if( 'vintage' == $key && is_string( $value ) ) {
														 echo __( 'Vintage: ', 'thegrapes' ) . $value;
													 }
												 }
											 }
											?>
										</div>
									</div>
									<?php

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

									// Backorder notification.
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
									}
									?>
								</div>
							</td>

							<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'thegrapes' ); ?>">
								<span class="text-style float-left d-inline-block d-lg-none"><?php _e( 'Price:', 'thegrapes' ); ?></span>
								<div class="float-right float-lg-none">
									<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
								</div>
							</td>

							<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'thegrapes' ); ?>">
								<span class="text-style float-left d-inline-block d-lg-none"><?php _e( 'Quantity:', 'thegrapes' ); ?></span>
								<div class="float-right float-lg-none d-lg-block">
									<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = '<div class="input-group input-quantity mb-0 justify-content-center d-flex align-items-center">
											<div class="input-group-button">
												<span data-quantity="minus" data-field="quantity">
													-
												</span>
											</div>';
										$product_quantity .= woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '1',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
										$product_quantity .= '<div class="input-group-button">
											<span data-quantity="plus" data-field="quantity">
												+
											</span>
										</div>
									</div>';
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
								</div>
							</td>

							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'thegrapes' ); ?>">
								<span class="text-style float-left d-inline-block d-lg-none"><?php _e( 'Subtotal:', 'thegrapes' ); ?></span>
								<div class="float-right float-lg-none d-lg-block">
									<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
								</div>
							</td>
						</tr>
						<?php
					endif;
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr class="below-products">
				<td class="back-to-shop" colspan="2">
					<?php $continue_shopping_url = $cart_back_url == 'bundle' ? home_url( '/bundles' ) : wc_get_page_permalink( 'shop' ); ?>
					<a href="<?php echo $continue_shopping_url; ?>" class="btn btn-outline-primary btn-line" title="<?php _e( 'Continue shopping', 'thegrapes' ); ?>"><span><?php _e( 'Continue shopping', 'thegrapes' ); ?></span></a>
				</td>
				<td colspan="3" class="product-coupon" class="actions">
					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon text-right">
							<label for="coupon_code" class="mr-2 d-none mb-2 mb-lg-0"><?php esc_html_e( 'Coupon:', 'thegrapes' ); ?></label>
							<div class="input-wrap d-lg-inline-block d-block mr-0 mr-lg-2 mb-2 mb-lg-0">
								<input type="text" name="coupon_code" class="input-text input-field" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'thegrapes' ); ?>" />
							</div>
							<button type="submit" class="button btn btn-primary btn-line m-100" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'thegrapes' ); ?>"><span><?php esc_attr_e( 'Apply coupon', 'thegrapes' ); ?></span></button>
						</div>
					<?php } ?>

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><span><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></span></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<?php
  $delivery_title = get_theme_mod( 'set_cart_info_delivery_title', '' );
	$delivery_icon_title = get_theme_mod( 'set_cart_info_delivery_icon_title', '' );
	$delivery_icon_text = get_theme_mod( 'set_cart_info_delivery_icon_text', '' );
	$delivery_add_text = get_theme_mod( 'set_cart_info_delivery_add_text', '' );
	$shipping_title = get_theme_mod( 'set_cart_info_shipping_title', '' );
	$shipping_icon_title = get_theme_mod( 'set_cart_info_shipping_icon_title', '' );
	$shipping_icon_text = get_theme_mod( 'set_cart_info_shipping_icon_text', '' );
	$shipping_add_text = get_theme_mod( 'set_cart_info_shipping_add_text', '' );
?>

<div class="row">
	<div class="col-lg-8">
		<div class="cart-colaterals-info mb-2">
			<?php if ( $delivery_title ) : ?>
			<h2 class="mb-4"><?php echo $delivery_title; ?></h2>
			<?php endif; ?>
			<div class="row d-flex align-items-center">
				<div class="col-lg-6 mb-4">
					<div class="pt-dt-item d-flex flex-row">
						<div class="pt-dt-img">
							<img src="<?php echo ICONS . '/delivery.png'; ?>">
						</div>
						<div class="pt-dt-content d-flex flex-column">
							<?php if ( $delivery_icon_title ) : ?>
							<span class="pt-dt-header"><?php echo $delivery_icon_title; ?></span>
							<?php endif; ?>
							<?php if ( $delivery_icon_text ) : ?>
							<span class="pt-dt-text"><?php echo $delivery_icon_text; ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6 mb-4">
					<?php if( $delivery_add_text ) : ?>
					<?php echo $delivery_add_text; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<hr class="mt-2 hr-light" />
		<div class="cart-colaterals-info mb-2">
			<?php if( $shipping_title ) : ?>
			<h2 class="mb-4"><?php echo $shipping_title; ?></h2>
			<?php endif; ?>
			<div class="row d-flex align-items-center">
				<div class="col-lg-6 mb-4">
					<div class="pt-dt-item d-flex flex-row">
						<div class="pt-dt-img">
							<img src="<?php echo ICONS . '/shopping-fee.png'; ?>">
						</div>
						<div class="pt-dt-content d-flex flex-column">
							<?php if( $shipping_icon_title ) : ?>
							<span class="pt-dt-header"><?php echo $shipping_icon_title; ?></span>
							<?php endif; ?>
							<?php if( $shipping_icon_text ) : ?>
							<span class="pt-dt-text"><?php echo $shipping_icon_text; ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div id="cart-notify-text" class="col-lg-6 mb-4">
					<?php echo wc_add_notice_free_shipping(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4" id="cart-totals">
		<div class="cart-totals-wrap bill-wrapper">
			<div class="cart-collaterals">
				<?php
					/**
					 * Cart collaterals hook.
					 *
					 * @hooked woocommerce_cross_sell_display
					 * @hooked woocommerce_cart_totals - 10
					 */
					do_action( 'woocommerce_cart_collaterals' );
				?>
			</div>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
