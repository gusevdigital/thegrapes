<?php
$display_offer = false;
$offer_timer = '';

$valid_field = get_field( 'valid_till' );

if( $valid_field ) {

  $valid = new DateTime( $valid_field );
  $now = new DateTime('NOW');

  if( $valid > $now ) {

    $display_offer = true;

    $timer_id = wp_unique_id( 'timer-' );

    $offer_timer = '
    <div class="offers-item__timer" id="' . $timer_id . '" valid-till="' . $valid->format('Y-m-d H:i:s') . '"></div>';

  } else {
    $display_offer = false;
  }


} else {
  $display_offer = true;
}

if( $display_offer ) :

  $offers_old_price_title = get_theme_mod( 'set_offers_old_price_title', __( 'Old price is', 'thegrapes' ) );
  $offers_new_price_title = get_theme_mod( 'set_offers_new_price_title', __( 'Offer price is', 'thegrapes' ) );

  $product = wc_get_product( get_the_ID() );
  ?>
  <div class="row offers-item mb-6">
    <?php if ( $img = get_the_post_thumbnail( null, 'full', array( 'class' => 'img-fluid pt-group-img offers-item__img' ) ) ) : ?>
      <div class="col-lg-4 mb-6">
        <?php echo $img; ?>
      </div>
    <?php endif; ?>

      <div class="col-lg-4 mb-6">
        <h2 class="offers-item__title"><?php _e( 'Limited offer', 'thegrapes' ); ?></h2>
        <?php
        if( $offer_timer ) {

           echo $offer_timer;

        }
        ?>
        <div class="offers-item__content"><?php the_content(); ?></div>
      </div>
      <div class="col-lg-4 pb-3">
        <!--<div class="text-large text-dark mb-2 pt-group-pt-title">
          <?php echo $offers_wines_title; ?>
        </div>-->
        <?php
        $wines = get_field('offer_products');
        $total_wine_price = 0;
        if( $wines ):
          foreach( $wines as $wine_id ):
            $wine_title = get_the_title( $wine_id );
            $wine_link = get_the_permalink( $wine_id );

            $wine_product = wc_get_product($wine_id);
            $wine_price = $wine_product->get_regular_price();
            $total_wine_price += $wine_price;
            ?>
            <a href="<?php echo $wine_link; ?>" title="<?php echo $wine_title; ?>" class="list-link"><span></span><?php echo $wine_title; ?></a>
            <?php
          endforeach;
        endif;
        ?>
        <?php if( $total_wine_price ) : ?>
          <div class="offers-item__old-price">
            <?php echo $offers_old_price_title . ' ' . wc_price($total_wine_price); ?>
          </div>
          <div class="offers-item__price pt-price price">
            <?php
              if( $total_wine_price ) {
                echo $offers_new_price_title . ' ' . ' ' . $product->get_price_html();
              } else {
                ?>
                <div class="text-large text-dark mr-2">Price:</div>
                <div class="pt-price price"><?php echo $product->get_price_html(); ?></div>
                <?php
              }
            ?>
          </div>

        <?php endif; ?>
        <div class="offers-item__add-to-cart">
          <a href="<?php echo home_url() . explode('?', $_SERVER['REQUEST_URI'], 2)[0] . '?add-to-cart=' . get_the_ID(); ?>" class="btn btn-outline-primary mb-4 mr-lg-4"><?php _e('Add to cart', 'thegrapes'); ?></a>
          <a href="<?php echo home_url() . '/checkout/?add-to-cart=' . get_the_ID(); ?>&buynow=1" class="btn btn-primary mb-4"><?php _e('Buy now', 'thegrapes'); ?></a>
        </div>
      </div>

  </div>
  <?php
endif;
