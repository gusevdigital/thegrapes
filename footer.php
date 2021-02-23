<?php
/**
 * The template for displaying the footer
 *
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thegrapes
 */

$footer_logo = get_theme_mod( 'set_footer_logo_desc', '' );
$footer_logo_mobile = get_theme_mod( 'set_footer_logo_mobile', '' );

$footer_contacts_title = get_theme_mod( 'set_footer_contact_title', __( 'Contacts', 'thegrapes' ) );
$footer_phone = get_theme_mod( 'set_footer_contact_phone', '' );
$footer_email = get_theme_mod( 'set_footer_contact_email', '' );
$footer_address = get_theme_mod( 'set_footer_contact_address', '' );

$footer_links_title = get_theme_mod( 'set_footer_links_title', __( 'Links', 'thegrapes' ) );

$footer_subscription_title = get_theme_mod( 'set_footer_subscription_title', __( 'Newsletter', 'thegrapes' ) );
$footer_subscription_text = get_theme_mod( 'set_footer_subscription_text', '' );

$footer_legal_title = get_theme_mod( 'set_footer_legal_title', __( 'Legal', 'thegrapes' ) );
$footer_legal = get_theme_mod( 'set_footer_legal_text', '' );

$footer_instagram = get_theme_mod( 'set_social_instagram' );
$footer_facebook = get_theme_mod( 'set_social_facebook' );
$footer_youtube = get_theme_mod( 'set_social_youtube' );
$footer_whatsapp = get_theme_mod( 'set_social_whatsapp' );

$footer_secure_checkout = get_theme_mod( 'set_secure_checkout_img', '' );

$footer_copyright = get_theme_mod( 'set_footer_copyright_text', '' );


?>

  </main> <!-- end content-wrap -->

  <!-- Footer -->
  <footer>
    <div class="footer-top"></div>
    <div class="footer-content">
      <div class="container">
        <div class="row">
          <?php if( $footer_phone || $footer_email || $footer_address ) : ?>
          <div class="col-xl-3 col-lg-4 mb-5">
            <h2 class="text-white"><?php echo $footer_contacts_title; ?></h2>
            <div class="footer-contacts">
              <?php if( $footer_phone ) : ?>
              <div class="contact-item d-flex align-items-center">
                <img src="<?php echo ICONS . '/phone.png'; ?>" class="mr-2" />
                <a rel="nofollow" href="tel:<?php echo filter_var($footer_phone, FILTER_SANITIZE_NUMBER_INT);; ?>" class="link-light" title="<?php _e( 'Our phone number', 'thegrapes' ); ?>"><?php echo strip_tags( $footer_phone ); ?></a>
              </div>
              <?php endif; ?>
              <?php if( $footer_email ) : ?>
              <div class="contact-item d-flex align-items-center">
                <img src="<?php echo ICONS . '/email.png'; ?>" class="mr-2" />
                <a rel="nofollow" href="mailto:<?php echo filter_var($footer_email, FILTER_SANITIZE_EMAIL); ?>" class="link-light" title="<?php _e( 'Our Email', 'thegrapes' ); ?>"><?php echo filter_var($footer_email, FILTER_SANITIZE_EMAIL); ?></a>
              </div>
              <?php endif; ?>
              <?php if( $footer_address ) : ?>
              <div class="contact-item d-flex align-items-center">
                <img src="<?php echo ICONS . '/location.png'; ?>" class="mr-2" />
                <a rel="nofollow" class="link-light" title="<?php _e( 'Our address', 'thegrapes' ); ?>"><?php echo strip_tags( $footer_address ); ?></a>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if( has_nav_menu( 'thegrapes_footer_menu' ) ) : ?>
          <div class="col-xl-3 col-lg-4 mb-5">
            <h2 class="text-white"><?php echo $footer_links_title; ?></h2>
            <?php
    				wp_nav_menu( array(
    					'theme_location'    => 'thegrapes_footer_menu',
    					'depth'             => 1,
    					'container'         => 'div',
    					'menu_class'        => 'nav vertical-nav d-flex flex-column link-light mb-3',
    					'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
    					'walker'            => new WP_Bootstrap_Navwalker(),
    				) );
    				?>
            <?php if ( $footer_instagram || $footer_facebook || $footer_youtube || $footer_whatsapp ) : ?>
            <div class="footer-socials d-flex flex-row">
              <?php if( $footer_instagram ) : ?>
              <a rel="nofollow" title="<?php _e( 'Visit our Instagram account', 'thegrapes' ); ?>" href="<?php echo esc_url( $footer_instagram ); ?>" title="Visit our Instagram account" target="_blank">
                <img src="<?php echo ICONS . '/instagram.png'; ?>" />
              </a>
              <?php endif; ?>
              <?php if( $footer_facebook ) : ?>
              <a rel="nofollow" title="<?php _e( 'Visit our Facebook page', 'thegrapes' ); ?>" href="<?php echo esc_url( $footer_facebook ); ?>" title="Visit our Facebook page" target="_blank">
                <img src="<?php echo ICONS . '/facebook.png'; ?>" />
              </a>
              <?php endif; ?>
              <?php if( $footer_youtube ) : ?>
              <a rel="nofollow" title="<?php _e( 'Visit our YouTube channel', 'thegrapes' ); ?>" href="<?php echo esc_url( $footer_youtube ); ?>" title="Visit our YouTube channel" target="_blank">
                <img src="<?php echo ICONS . '/youtube.png'; ?>" />
              </a>
              <?php endif; ?>
              <?php if( $footer_whatsapp ) : ?>
              <a rel="nofollow" href="<?php echo esc_url( $footer_whatsapp ); ?>" title="<?php _e( 'Chat with us via WhatsApp', 'thegrapes' ); ?>" target="_blank">
                <img src="<?php echo ICONS . '/whatsapp.png'; ?>" />
              </a>
              <?php endif; ?>
            </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
          <div class="col-xl-3 col-lg-4 mb-5">
            <h2 class="text-white"><?php echo $footer_subscription_title; ?></h2>
            <?php if( $footer_subscription_text ) : ?>
              <p><?php echo $footer_subscription_text; ?></p>
            <?php endif; ?>
            <?php echo do_shortcode('[contact-form-7 id="814" title="Subscription"]'); ?>
          </div>
          <?php if( 'DONT DISPLAY' == 'COLUMN' && ( isset($footer_logo) && $footer_logo || isset($footer_logo_mobile) && $footer_logo_mobile ) ): ?>
          <div class="col-xl-3 col-lg-4 mb-5">
            <div class="footer-logo text-lg-center">
              <a title="<?php _e( 'Go to home page', 'thegrapes' ); ?>" href="<?php echo home_url( '/' ) ?>" alt="<?php bloginfo( 'name' ); ?>">
                <?php if( isset($footer_logo) && $footer_logo ) : ?>
                  <?php if( is_numeric( $footer_logo ) ) : ?>
    								<?php echo wp_get_attachment_image( $footer_logo, 'full', false, array( 'class' => 'd-none d-lg-inline-block mx-auto' ) ); ?>
    							<?php else: ?>
    								<img src="<?php echo $footer_logo; ?>" class="d-none d-lg-inline-block mx-auto" />
    							<?php endif; ?>
                <?php endif; ?>
                <?php if( isset($footer_logo_mobile) && $footer_logo_mobile ) : ?>
                  <?php if( is_numeric( $footer_logo_mobile ) ) : ?>
    								<?php echo wp_get_attachment_image( $footer_logo_mobile, 'full', false, array( 'class' => 'd-inline-block d-lg-none mx-auto' ) ); ?>
    							<?php else: ?>
    								<img src="<?php echo $footer_logo_mobile; ?>" class="d-inline-block d-lg-none mx-auto" />
    							<?php endif; ?>
                <?php endif; ?>
              </a>
            </div>
          </div>
          <?php endif; ?>


          <?php if ( $footer_legal ) : ?>
          <div class="col-xl-3 mb-5">
            <h2 class="text-white"><?php echo $footer_legal_title; ?></h2>
            <p class="footer-text mb-0">
              <?php echo esc_html( $footer_legal ); ?>
            </p>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="footer-copyright pb-10">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">
              <?php if ( $footer_copyright ) : ?>
                <div class="mb-4 mb-lg-0">
                  <?php echo esc_html( strip_tags ( $footer_copyright ) ); ?>
                </div>

              <?php endif; ?>
              <?php if( isset( $footer_secure_checkout ) && $footer_secure_checkout ) : ?>
                <?php if( is_numeric( $footer_secure_checkout ) ) : ?>
                  <?php echo wp_get_attachment_image( $footer_secure_checkout, 'full', false, array( 'class' => 'h-auto w-auto secure-checkout' ) ); ?>
                <?php else: ?>
                  <img src="<?php echo $footer_secure_checkout; ?>" class="h-auto w-auto secure-checkout" />
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end footer-content -->
  </footer> <!-- end footer -->

  <!-- Minicart -->
  <div id="minicart-modal" class="side-modal-wrapper" style="visibility:hidden">
    <div class="overlay">
    </div>
    <div class="side-modal-container minicart">
      <a href="#minicart-modal" class="close-button float-right">
        <span class="line"></span>
        <span class="line"></span>
      </a>
      <div class="mini-cart-content">
        <div class="widget_shopping_cart_content">
          <?php woocommerce_mini_cart(); ?>
        </div>
      </div><!--mini-cart-content-->
    </div>
  </div> <!-- end Minicart -->

  <!-- Video Modal -->
  <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">

          <!-- 16:9 aspect ratio -->
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
          </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M48 2.65388L45.3461 0L24 21.3461L2.65388 0L0 2.65388L21.3461 24L0 45.3461L2.65388 48L24 26.6539L45.3461 48L48 45.3461L26.6539 24L48 2.65388Z" fill="#121212" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</div> <!-- end main-wrap -->

<!-- Prices Colors -->
<?php
  $price_regular_color = get_theme_mod( 'set_price_regular_color' );
  $price_discount_color = get_theme_mod( 'set_price_discount_color' );
?>
<style>
  <?php if( $price_regular_color ) : ?>
    /*.pt-pr .pt-pr-price,
    .variations-price,
    .woocommerce-Price-amount.amount*/
    .price ins,
    ins {
      color: <?php echo $price_regular_color; ?> !important;
    }
  <?php endif; ?>
  <?php if( $price_discount_color ) : ?>
    del,
    del .woocommerce-Price-amount.amount {
        color: <?php echo $price_discount_color; ?> !important;
    }
  <?php endif; ?>
</style>

<?php
  wp_footer();
?>

</body>
</html>
