<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_id = $product->get_id();

$product_thumbnail_id = $product->get_image_id();

if( ! $product_thumbnail_id ) {
	return;
}

$product_img_shadow = $product->is_type( 'simple' ) || $product->is_type( 'variable' ) && USER_BROWSER != 'Safari' && USER_BROWSER != 'Internet Explorer' ? ' pt-pr-img-shadow' : '';

$pt_award = get_post_meta( $product_id, 'thegrapes_product_details_award', true );
$pt_award_text = get_post_meta( $product->get_id(), 'thegrapes_product_details_award_text', true );
$pt_award_tooltip =
	isset($pt_award_text) && esc_html($pt_award_text) != '' ?
	'data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="' . esc_html($pt_award_text) . '"' :
	'';
$pt_rating = get_post_meta( $product_id, 'thegrapes_product_details_rating', true );
$pt_rating_text = get_theme_mod( 'set_shop_points_text' );
$pt_rating_tooltip =
	isset($pt_rating_text) && esc_html($pt_rating_text) != '' ?
	'data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="' . esc_html($pt_rating_text) . '"' :
	'';
$pt_grapes = get_post_meta( $product_id, 'thegrapes_product_details_grapes', true );

if( $product->is_type( 'variable' ) ){
    $available_variations = $product->get_available_variations();
    // var_dump($available_variations);

		$vintage = array();
    foreach( $available_variations as $value ){
				foreach ($value['attributes'] as $key => $attr) {
					if( $key == 'attribute_vintage' ) {
						array_push($vintage, $attr);
					}
				}
    }
}

?>

<figure <?php wc_product_class( 'pt-pr col-lg-4 col-md-6 wow fadeInUp', $product ); ?> data-wow-duration=".8s"	>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php
		  if ( $pt_award && $pt_award > 0 || $pt_rating && $pt_rating > 0 ):
		?>
			<div class="pt-pr-awards">
				<?php if ( $pt_award && $pt_award > 0 ) : ?>
					<div class="pt-pr-award<?php if( $pt_award_tooltip != '' ) echo ' tooltip-trigger'; ?>" <?php if( $pt_award_tooltip != '' ) echo $pt_award_tooltip; ?>>
						<span class="golden"><?php echo $pt_award; ?></span>
					</div>
				<?php endif; ?>
				<?php if ( $pt_rating && $pt_rating > 0 ) : ?>
					<div class="pt-pr-score d-flex align-items-center justify-content-center<?php if( $pt_rating_tooltip != '' ) echo ' tooltip-trigger'; ?>" <?php if( $pt_rating_tooltip != '' ) echo $pt_rating_tooltip; ?>>
						<span><?php echo $pt_rating . '/100 '; ?></span>
						<?php if( $pt_rating_tooltip != '' ) : ?>
							<svg class="ml-1_2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M9.696 12.592C10.848 12.592 11.664 11.952 12.016 10.944L10.608 10.416C10.448 10.864 10.144 11.152 9.696 11.152C9.376 11.152 9.12 10.944 9.12 10.592C9.12 10.16 9.424 9.952 10.48 9.536C11.872 8.992 12.688 8.48 12.688 7.2C12.688 5.664 11.52 4.672 9.728 4.672C7.984 4.672 6.912 5.776 6.672 7.12L8.416 7.408C8.624 6.72 9.104 6.336 9.776 6.336C10.352 6.336 10.816 6.576 10.816 7.136C10.816 7.664 10.464 7.984 9.216 8.464C8.208 8.848 7.488 9.456 7.488 10.544C7.488 11.776 8.416 12.592 9.696 12.592ZM9.696 16.096C10.432 16.096 11.024 15.52 11.024 14.784C11.024 14.048 10.432 13.44 9.696 13.44C8.96 13.44 8.368 14.048 8.368 14.784C8.368 15.52 8.96 16.096 9.696 16.096Z"
									fill="#414141" />
								<rect x="1" y="1" width="18" height="18" rx="9" stroke="#414141" stroke-width="2" />
							</svg>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="pt-pr-wrap text-center">
			<?php echo get_the_post_thumbnail( $product_id, 'thegrapes-product-img', array( 'class' => '' . $product_img_shadow ) ); ?>
			<h4 class="pt-pr-title"><?php the_title(); ?></h4>
			<?php if( $pt_grapes ) : ?>
				<div class="pt-pr-grape">
					<?php
						$pt_grapes_r = explode( ',', $pt_grapes );
						foreach ($pt_grapes_r as $ki => $v) {
							$v = trim( $v );
							echo '<span>' . $v . '</span>';
						}
					?>
				</div>
			<?php endif; ?>
			<?php if( isset($vintage) && count($vintage) ) : ?>
				<div class="pt-pr-years">
					<?php foreach ($vintage as $year) : ?>
						<span><?php echo $year; ?></span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<div class="pt-pr-price">
				<?php echo $product->get_price_html(); ?>
			</div>
		</div>
	</a>
</figure>
