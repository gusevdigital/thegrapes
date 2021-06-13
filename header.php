<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thegrapes
 */

global $woocommerce;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P6V8KZ7');</script>
<!-- End Google Tag Manager -->
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'page-home' ); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P6V8KZ7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
  <!--<div id="loading-wrap" class="text-center" style="">
    <span class="valign-helper"></span>
		<?php $loading_img = get_theme_mod( 'set_loading_logo', IMAGES . '/logo-white.png' ); ?>
    <?php echo wp_get_attachment_image( $loading_img, 'full' ); ?>
  </div>-->
  <div class="main-wrap">
    <header id="header" class="fixed-top">
      <div class="container">
        <nav class="navbar main-navbar navbar-expand-lg navbar-light flex-column">
          <div class="navbar-upper w-100 d-table">
            <div class="burger-wrapper d-table-cell d-lg-none w-33">
              <a class="burger-toggler open-side-modal d-flex" href="#mobile-navbar-modal" aria-expanded="false" aria-label="Toggle mobile navigation">
                <span class="burger-toggler-icon">
                  <span class="line"></span>
                  <span class="line"></span>
                  <span class="line"></span>
                </span>
              </a>
            </div>
            <div class="nav-socials d-none d-lg-table-cell text-left w-33">
							<?php
								$header_instagram = get_theme_mod( 'set_social_instagram' );
								if ( !empty($header_instagram) ) :
							?>
	              <div class="nav-social nav-icon float-left">
	                <a target="_blank" title="<?php _e( 'Visit our Instagram account', 'thegrapes' ); ?>" rel="nofollow" href="<?php echo esc_url( $header_instagram ); ?>" title="<?php _e( 'Visit our Instagram page', 'thegrapes' ); ?>">
	                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
	                    <g id="034-instagram">
	                      <g id="Group">
	                        <g id="Group_2">
	                          <path id="Vector"
	                            d="M11.3523 0H4.64775C2.08497 0 0 2.08497 0 4.64775V11.3523C0 13.915 2.08497 16 4.64775 16H11.3523C13.915 16 16 13.915 16 11.3523V4.64775C16 2.08497 13.915 0 11.3523 0ZM14.75 11.3523C14.75 13.2258 13.2258 14.75 11.3523 14.75H4.64775C2.77422 14.75 1.25 13.2258 1.25 11.3523V4.64775C1.25 2.77422 2.77422 1.25 4.64775 1.25H11.3523C13.2258 1.25 14.75 2.77422 14.75 4.64775V11.3523Z"
	                            fill="#121212" />
	                        </g>
	                      </g>
	                      <g id="Group_3">
	                        <g id="Group_4">
	                          <path id="Vector_2"
	                            d="M8 3.6875C5.62206 3.6875 3.6875 5.62206 3.6875 8C3.6875 10.3779 5.62206 12.3125 8 12.3125C10.3779 12.3125 12.3125 10.3779 12.3125 8C12.3125 5.62206 10.3779 3.6875 8 3.6875ZM8 11.0625C6.31134 11.0625 4.9375 9.68866 4.9375 8C4.9375 6.31134 6.31134 4.9375 8 4.9375C9.68866 4.9375 11.0625 6.31134 11.0625 8C11.0625 9.68866 9.68866 11.0625 8 11.0625Z"
	                            fill="#121212" />
	                        </g>
	                      </g>
	                      <g id="Group_5">
	                        <g id="Group_6">
	                          <path id="Vector_3" d="M12.375 4.25C12.7202 4.25 13 3.97018 13 3.625C13 3.27982 12.7202 3 12.375 3C12.0298 3 11.75 3.27982 11.75 3.625C11.75 3.97018 12.0298 4.25 12.375 4.25Z" fill="#121212" />
	                        </g>
	                      </g>
	                    </g>
	                  </svg>
	                </a>
	              </div>
							<?php
							endif;
							$header_facebook = get_theme_mod( 'set_social_facebook' );
							if ( !empty($header_facebook) ) :
							?>
              <div class="nav-social nav-icon float-left">
                <a target="_blank" title="<?php _e( 'Visit our Facebook page', 'thegrapes' ); ?>" rel="nofollow" href="<?php echo esc_url( $header_facebook ); ?>" title="<?php _e( 'Visit our facebook page', 'thegrapes' ); ?>">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                      <path
                        d="M4.54126 9.29133H6.21993V15.4993C6.21993 15.7753 6.44326 15.9993 6.71993 15.9993L9.39126 16C9.66793 16 9.89126 15.7753 9.89126 15.5V9.292H11.4826C11.7346 9.292 11.9473 9.104 11.9786 8.854L12.3106 6.18733C12.3479 5.89 12.1153 5.62533 11.8146 5.62533H9.89126C9.96659 3.978 9.60126 3.49067 10.6726 3.49067C11.3979 3.404 12.5419 3.77133 12.5419 2.99067V0.606C12.5419 0.356 12.3573 0.144667 12.1099 0.110667C11.9006 0.082 11.0733 0 10.0473 0C5.37393 0 6.33593 5.18133 6.22059 5.62467H4.54126C4.26526 5.62467 4.04126 5.84867 4.04126 6.12467V8.79133C4.04126 9.06733 4.26526 9.29133 4.54126 9.29133ZM5.04126 6.62533H6.71993C6.99593 6.62533 7.21993 6.40133 7.21993 6.12533V4.02467C7.21993 2.10267 8.24993 1.00067 10.0466 1.00067C10.6319 1.00067 11.1706 1.02933 11.5413 1.05867V2.49133C11.2733 2.628 8.89059 1.902 8.89059 4.28933V6.126C8.89059 6.402 9.11459 6.626 9.39059 6.626H11.2479L11.0399 8.29267H9.39059C9.11459 8.29267 8.89059 8.51667 8.89059 8.79267V15H7.22059V8.792C7.22059 8.516 6.99659 8.292 6.72059 8.292H5.04126V6.62533Z"
                        fill="#121212" />
                    </g>
                    <defs>
                      <clipPath id="clip0">
                        <rect width="16" height="16" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </a>
              </div>
							<?php
							endif;
							$header_youtube = get_theme_mod( 'set_social_youtube' );
							if ( !empty($header_youtube) ) :
							?>
              <div class="nav-social nav-icon float-left">
                <a target="_blank" rel="nofollow" title="<?php _e( 'Visit our YouTube channel', 'thegrapes' ); ?>" href="<?php echo esc_url( $header_youtube ); ?>" title="<?php _e( 'Visit our YouTube channel', 'thegrapes' ); ?>">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M15.6741 4.2929C15.4458 3.44859 14.7789 2.78297 13.9359 2.55631C12.7354 2.22825 8.48109 2.21878 7.99994 2.21878C7.51913 2.21878 3.26771 2.22787 2.06993 2.54259C2.06777 2.54319 2.06565 2.54375 2.06352 2.54434C1.23287 2.77203 0.550592 3.45912 0.32528 4.29468C0.324999 4.29583 0.324686 4.29696 0.324374 4.29812C0.00368749 5.51499 0 7.8991 0 8.00001C0 8.10141 0.00368749 10.4978 0.325311 11.7053C0.553185 12.5505 1.22037 13.2169 2.06562 13.4441C3.27717 13.7718 7.52013 13.7812 7.99994 13.7812C8.48078 13.7812 12.7322 13.7721 13.93 13.4574C13.9311 13.4571 13.9323 13.4568 13.9334 13.4565C14.7795 13.229 15.4468 12.5626 15.6746 11.7175C15.6749 11.7163 15.6752 11.7151 15.6755 11.714C15.9945 10.5037 15.9999 8.1386 15.9999 8.01398C16.0005 7.89441 16.0073 5.50936 15.6741 4.2929ZM14.7498 8.01216C14.7498 8.65397 14.6991 10.5117 14.4672 11.3937C14.3546 11.809 14.0266 12.1364 13.6104 12.2489C12.7251 12.4804 9.2609 12.5312 7.99994 12.5312C6.74225 12.5312 3.28302 12.4785 2.39105 12.2372C1.97359 12.125 1.64452 11.7965 1.53268 11.3818C1.25362 10.334 1.25 8.02316 1.25 8.00001C1.25 7.35823 1.30078 5.50086 1.53256 4.61874C1.64477 4.20452 1.98137 3.86421 2.39093 3.75068C3.27889 3.51956 6.73972 3.46881 7.99994 3.46878C9.26078 3.46878 12.7258 3.52146 13.6088 3.76277C14.0263 3.87499 14.3554 4.20352 14.4677 4.62011C14.4679 4.62093 14.4681 4.62177 14.4683 4.62258C14.7085 5.49896 14.753 7.36429 14.7498 8.01216Z"
                      fill="#121212" />
                    <path d="M5.94019 4.71387V11.2861L11.6268 7.99998L5.94019 4.71387ZM7.19018 6.87989L9.12851 8.00001L7.19018 9.12013V6.87989Z" fill="#121212" />
                  </svg>
                </a>
              </div>
							<?php
							endif;
							$header_whatsapp = get_theme_mod( 'set_social_whatsapp' );
							if ( !empty($header_whatsapp) ) :
							?>
              <div class="nav-social nav-icon float-left">
                <a target="_blank" rel="nofollow" href="<?php echo esc_url( $header_whatsapp ); ?>" title="<?php _e( 'Chat with us via WhatsApp', 'thegrapes' ); ?>">
                  <svg id="regular" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m13.33 18.076c4.05.964 5.475-2.5 4.761-3.793-.286-.516-2.856-1.507-2.981-1.555-1.104-.402-1.512.348-2.277 1.335-1.469-.735-2.454-1.314-3.466-2.96.057-.071.133-.155.19-.219.354-.396 1.017-1.134.565-2.037-.38-.757-.569-1.285-.708-1.672-.403-1.121-.71-1.425-2.098-1.425-1.445 0-2.566 1.899-2.566 3.534 0 3.569 4.798 7.889 8.58 8.792zm-6.014-10.826c.3 0 .452.01.528.022.162.343.326 1.059.93 2.173-.094.351-1.429 1.174-.81 2.238 1.265 2.148 2.531 2.893 4.345 3.795 1.208.546 1.594-.443 2.36-1.312.355.144 1.553.674 2.079.94-.047 1.036-1.047 1.992-3.07 1.51-3.472-.829-7.429-4.735-7.429-7.333.001-.988.694-2.033 1.067-2.033z"/><path d="m.083 23.085c-.131.474.224.949.723.949.18 0-.114.046 5.848-1.5 2.427 1.236 4.272 1.197 5.45 1.308 10.555 0 15.725-12.873 8.461-20.363-9.957-9.624-25.464 2.336-18.975 14.127zm19.288-18.672c.173.316 5.135 4.791 2.372 11.478-1.701 4.12-5.626 6.659-10.024 6.421-3.578-.199-4.504-1.477-5.163-1.302l-4.683 1.22 1.245-4.524c.054-.194.027-.401-.073-.575-5.983-10.324 7.546-20.939 16.326-12.718z"/></svg>
									<div class="whatsapp-bubble"><?php _e( 'Chat with us', 'thegrapes' ); ?></div>
                </a>
              </div>
							<?php
							endif;
							?>
            </div>
            <a class="navbar-logo py-lg-3 d-table-cell text-center w-33" title="<?php _e( 'Go to home page', 'thegrapes' ); ?>" href="<?php echo home_url( '/' ) ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php $img = get_theme_mod( 'set_header_logo', IMAGES . '/logo.svg' ); ?>
							<?php if( is_numeric( $img ) ) : ?>
								<?php echo wp_get_attachment_image( $img, 'full', false, array( 'class' => 'logo-desktop d-none d-sm-inline-block nolazyload' ) ); ?>
							<?php else: ?>
								<img src="<?php echo $img ?>" class="logo-desktop d-none d-sm-inline-block nolazyload" />
							<?php endif; ?>
							<?php $img = get_theme_mod( 'set_header_mobile_logo', IMAGES . '/logo-mobile.svg' ); ?>
							<?php if( is_numeric( $img ) ) : ?>
								<?php echo wp_get_attachment_image( $img, 'full', false, array( 'class' => 'logo-mobile d-inline-block d-sm-none nolazyload', 'width' => '22', 'height' => '32' ) ); ?>
							<?php else: ?>
								<img src="<?php echo $img; ?>" class="logo-mobile d-inline-block d-sm-none nolazyload" />
							<?php endif; ?>
            </a>
            <div class="nav-shop d-table-cell text-right w-33">
              <div class="nav-minicart nav-icon float-right">
                <a href="#minicart-modal" class="open-side-modal cart" title="<?php _e( 'Open mini cart', 'thegrapes' ); ?>">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M16.4404 17.2481L15.3451 5.05022C15.3152 4.7171 15.036 4.46195 14.7016 4.46195H12.4429V3.44322C12.4429 1.54463 10.8983 0 8.9998 0C7.10139 0 5.55702 1.54463 5.55702 3.44322V4.46195H3.29671C2.9623 4.46195 2.68312 4.7171 2.65322 5.05022L1.55361 17.2961C1.53741 17.4769 1.59789 17.6559 1.7203 17.7898C1.8427 17.9237 2.01577 17.9999 2.1971 17.9999H15.8013C15.8018 17.9999 15.8025 17.9999 15.803 17.9999C16.1599 17.9999 16.4491 17.7106 16.4491 17.3538C16.449 17.3179 16.4461 17.2825 16.4404 17.2481ZM6.84916 3.44322C6.84916 2.25712 7.81396 1.29214 8.99989 1.29214C10.1859 1.29214 11.1508 2.25712 11.1508 3.44322V4.46195H6.84916V3.44322ZM2.90381 16.7079L3.88739 5.75409H5.55702V6.90944C5.55702 7.26624 5.8462 7.55551 6.20309 7.55551C6.55998 7.55551 6.84916 7.26624 6.84916 6.90944V5.75409H11.1508V6.90944C11.1508 7.26624 11.44 7.55551 11.7969 7.55551C12.1538 7.55551 12.4429 7.26624 12.4429 6.90944V5.75409H14.111L15.0946 16.7079H2.90381Z"
                      fill="#121212" />
                  </svg>
                  <span class="minicart-number items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
              </div>
              <div class="nav-login nav-icon float-right dropdown">
                <a href="#account" class="dropdown-toggle" title="<?php _e( 'Open account menu', 'thegrapes' ); ?>" id="accountMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php if( is_user_logged_in() ) :
										$current_user = wp_get_current_user();
										if( $current_user->user_firstname ) :
											$user_name =  $current_user->user_firstname;
											// Add Last Name
											//$user_name .= $current_user->user_lastname ? ' ' . $current_user->user_lastname : '';
											?>
										<span class="d-none d-lg-inline-block mr-1 small"><?php echo __( 'Hello, ', 'thegrapes' ) . '<strong>' . $user_name . '</strong>'; ?></span>
										<?php endif; ?>
									<?php endif; ?>
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M13.6569 10.3431C12.7855 9.47181 11.7484 8.82678 10.6168 8.43631C11.8288 7.60159 12.625 6.20463 12.625 4.625C12.625 2.07478 10.5502 0 8 0C5.44978 0 3.375 2.07478 3.375 4.625C3.375 6.20463 4.17122 7.60159 5.38319 8.43631C4.25163 8.82678 3.2145 9.47181 2.34316 10.3431C0.832156 11.8542 0 13.8631 0 16H1.25C1.25 12.278 4.27803 9.25 8 9.25C11.722 9.25 14.75 12.278 14.75 16H16C16 13.8631 15.1678 11.8542 13.6569 10.3431ZM8 8C6.13903 8 4.625 6.486 4.625 4.625C4.625 2.764 6.13903 1.25 8 1.25C9.86097 1.25 11.375 2.764 11.375 4.625C11.375 6.486 9.86097 8 8 8Z"
                      fill="#121212" />
                  </svg>
                </a>
								<div id="account-dropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="accountMenu">
									<?php if( is_user_logged_in() ) : ?>
										<?php
											$current_url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
											if( $current_user->user_firstname ) : ?>
												<div class="dropdown-header d-block d-lg-none">
													<?php echo __( 'Hello, ', 'thegrapes' ) . '<strong>' . $current_user->user_firstname . '</strong>'; ?>
												</div>
											<?php endif; ?>
											<div class="dropdown-header d-none d-lg-inline-block">
												<strong><?php _e( 'Member account', 'thegrapes' ); ?></strong>
											</div>
											<div class="dropdown-divider"></div>
											<a title="<?php _e( 'Membership', 'thegrapes' ); ?>" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ?>" class="dropdown-item <?php echo $current_url == preg_replace( "#^[^:/.]*[:/]+#i", "", esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ) ? 'active' : ''; ?>"><?php _e( 'Membership', 'thegrapes' ); ?></a>
											<a title="<?php _e( 'Orders', 'thegrapes' ); ?>" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . 'orders'; ?>" class="dropdown-item <?php echo strpos($current_url,'account/orders/') !== false ? 'active' : ''; ?>"><?php _e( 'Orders', 'thegrapes' ); ?></a>
											<a title="<?php _e( 'Settings', 'thegrapes' ); ?>" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . 'edit-account'; ?>" class="dropdown-item <?php echo strpos($current_url,'account/edit-account/') !== false ? 'active' : ''; ?>"><?php _e( 'Settings', 'thegrapes' ); ?></a>
											<div class="dropdown-divider"></div>
											<a title="<?php _e( 'Logout', 'thegrapes' ); ?>" href="<?php echo esc_url( wp_logout_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ); ?>" class="dropdown-item"><?php _e( 'Logout', 'thegrapes' ); ?></a>
									<?php else: ?>
										<div class="dropdown-header">
											<?php _e( 'Member account', 'thegrapes' ); ?>
										</div>
										<a title="<?php _e( 'Login / Register', 'thegrapes' ); ?>" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ?>" class="dropdown-item"><?php _e( 'Login / Register', 'thegrapes' ); ?></a>
									<?php endif; ?>
							  </div>
              </div>
            </div>
          </div>

					<?php
					wp_nav_menu( array(
						'theme_location'    => 'thegrapes_main_menu',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'navbar-bottom collapse navbar-collapse',
						'container_id'      => 'navbarSupportedContent',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
						'walker'            => new WP_Bootstrap_Navwalker(),
					) );
					?>
        </nav>
      </div>
    </header>
    <div id="mobile-navbar-modal" class="side-modal-wrapper" style="visibility:hidden">
      <div class="overlay">
      </div>
      <nav class="side-modal-container mobile-navbar navbar-light">
        <div class="side-modal-upper">
          <a href="#mobile-navbar-modal" class="close-button float-right">
            <span class="line"></span>
            <span class="line"></span>
          </a>
        </div>
				<?php
				wp_nav_menu( array(
					'theme_location'    => 'thegrapes_main_menu',
					'depth'             => 2,
					'container'         => 'div',
					'container_class'   => 'navbar-mobile',
					'container_id'      => 'mobileNav',
					'menu_class'        => 'mobile-nav navbar-nav flex-column vertical-nav',
					'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
					'walker'            => new WP_Bootstrap_Navwalker(),
				) );
				?>
				<div class="nav-socials pt-8 px-2">
					<?php
						$header_instagram = get_theme_mod( 'set_social_instagram' );
						if ( !empty($header_instagram) ) :
					?>
						<div class="nav-social nav-icon float-left">
							<a target="_blank" rel="nofollow" title="<?php _e( 'Visit our Instagram account', 'thegrapes' ); ?>" href="<?php echo esc_url( $header_instagram ); ?>" title="<?php _e( 'Visit our Instagram page', 'thegrapes' ); ?>">
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g id="034-instagram">
										<g id="Group">
											<g id="Group_2">
												<path id="Vector"
													d="M11.3523 0H4.64775C2.08497 0 0 2.08497 0 4.64775V11.3523C0 13.915 2.08497 16 4.64775 16H11.3523C13.915 16 16 13.915 16 11.3523V4.64775C16 2.08497 13.915 0 11.3523 0ZM14.75 11.3523C14.75 13.2258 13.2258 14.75 11.3523 14.75H4.64775C2.77422 14.75 1.25 13.2258 1.25 11.3523V4.64775C1.25 2.77422 2.77422 1.25 4.64775 1.25H11.3523C13.2258 1.25 14.75 2.77422 14.75 4.64775V11.3523Z"
													fill="#121212" />
											</g>
										</g>
										<g id="Group_3">
											<g id="Group_4">
												<path id="Vector_2"
													d="M8 3.6875C5.62206 3.6875 3.6875 5.62206 3.6875 8C3.6875 10.3779 5.62206 12.3125 8 12.3125C10.3779 12.3125 12.3125 10.3779 12.3125 8C12.3125 5.62206 10.3779 3.6875 8 3.6875ZM8 11.0625C6.31134 11.0625 4.9375 9.68866 4.9375 8C4.9375 6.31134 6.31134 4.9375 8 4.9375C9.68866 4.9375 11.0625 6.31134 11.0625 8C11.0625 9.68866 9.68866 11.0625 8 11.0625Z"
													fill="#121212" />
											</g>
										</g>
										<g id="Group_5">
											<g id="Group_6">
												<path id="Vector_3" d="M12.375 4.25C12.7202 4.25 13 3.97018 13 3.625C13 3.27982 12.7202 3 12.375 3C12.0298 3 11.75 3.27982 11.75 3.625C11.75 3.97018 12.0298 4.25 12.375 4.25Z" fill="#121212" />
											</g>
										</g>
									</g>
								</svg>
							</a>
						</div>
					<?php
					endif;
					$header_facebook = get_theme_mod( 'set_social_facebook' );
					if ( !empty($header_facebook) ) :
					?>
					<div class="nav-social nav-icon float-left">
						<a target="_blank" rel="nofollow" title="<?php _e( 'Visit our Facebook page', 'thegrapes' ); ?>" href="<?php echo esc_url( $header_facebook ); ?>" title="<?php _e( 'Visit our facebook page', 'thegrapes' ); ?>">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0)">
									<path
										d="M4.54126 9.29133H6.21993V15.4993C6.21993 15.7753 6.44326 15.9993 6.71993 15.9993L9.39126 16C9.66793 16 9.89126 15.7753 9.89126 15.5V9.292H11.4826C11.7346 9.292 11.9473 9.104 11.9786 8.854L12.3106 6.18733C12.3479 5.89 12.1153 5.62533 11.8146 5.62533H9.89126C9.96659 3.978 9.60126 3.49067 10.6726 3.49067C11.3979 3.404 12.5419 3.77133 12.5419 2.99067V0.606C12.5419 0.356 12.3573 0.144667 12.1099 0.110667C11.9006 0.082 11.0733 0 10.0473 0C5.37393 0 6.33593 5.18133 6.22059 5.62467H4.54126C4.26526 5.62467 4.04126 5.84867 4.04126 6.12467V8.79133C4.04126 9.06733 4.26526 9.29133 4.54126 9.29133ZM5.04126 6.62533H6.71993C6.99593 6.62533 7.21993 6.40133 7.21993 6.12533V4.02467C7.21993 2.10267 8.24993 1.00067 10.0466 1.00067C10.6319 1.00067 11.1706 1.02933 11.5413 1.05867V2.49133C11.2733 2.628 8.89059 1.902 8.89059 4.28933V6.126C8.89059 6.402 9.11459 6.626 9.39059 6.626H11.2479L11.0399 8.29267H9.39059C9.11459 8.29267 8.89059 8.51667 8.89059 8.79267V15H7.22059V8.792C7.22059 8.516 6.99659 8.292 6.72059 8.292H5.04126V6.62533Z"
										fill="#121212" />
								</g>
								<defs>
									<clipPath id="clip0">
										<rect width="16" height="16" fill="white" />
									</clipPath>
								</defs>
							</svg>
						</a>
					</div>
					<?php
					endif;
					$header_youtube = get_theme_mod( 'set_social_youtube' );
					if ( !empty($header_youtube) ) :
					?>
					<div class="nav-social nav-icon float-left">
						<a target="_blank" rel="nofollow" title="<?php _e( 'Visit our YouTube channel', 'thegrapes' ); ?>" href="<?php echo esc_url( $header_youtube ); ?>" title="<?php _e( 'Visit our YouTube channel', 'thegrapes' ); ?>">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M15.6741 4.2929C15.4458 3.44859 14.7789 2.78297 13.9359 2.55631C12.7354 2.22825 8.48109 2.21878 7.99994 2.21878C7.51913 2.21878 3.26771 2.22787 2.06993 2.54259C2.06777 2.54319 2.06565 2.54375 2.06352 2.54434C1.23287 2.77203 0.550592 3.45912 0.32528 4.29468C0.324999 4.29583 0.324686 4.29696 0.324374 4.29812C0.00368749 5.51499 0 7.8991 0 8.00001C0 8.10141 0.00368749 10.4978 0.325311 11.7053C0.553185 12.5505 1.22037 13.2169 2.06562 13.4441C3.27717 13.7718 7.52013 13.7812 7.99994 13.7812C8.48078 13.7812 12.7322 13.7721 13.93 13.4574C13.9311 13.4571 13.9323 13.4568 13.9334 13.4565C14.7795 13.229 15.4468 12.5626 15.6746 11.7175C15.6749 11.7163 15.6752 11.7151 15.6755 11.714C15.9945 10.5037 15.9999 8.1386 15.9999 8.01398C16.0005 7.89441 16.0073 5.50936 15.6741 4.2929ZM14.7498 8.01216C14.7498 8.65397 14.6991 10.5117 14.4672 11.3937C14.3546 11.809 14.0266 12.1364 13.6104 12.2489C12.7251 12.4804 9.2609 12.5312 7.99994 12.5312C6.74225 12.5312 3.28302 12.4785 2.39105 12.2372C1.97359 12.125 1.64452 11.7965 1.53268 11.3818C1.25362 10.334 1.25 8.02316 1.25 8.00001C1.25 7.35823 1.30078 5.50086 1.53256 4.61874C1.64477 4.20452 1.98137 3.86421 2.39093 3.75068C3.27889 3.51956 6.73972 3.46881 7.99994 3.46878C9.26078 3.46878 12.7258 3.52146 13.6088 3.76277C14.0263 3.87499 14.3554 4.20352 14.4677 4.62011C14.4679 4.62093 14.4681 4.62177 14.4683 4.62258C14.7085 5.49896 14.753 7.36429 14.7498 8.01216Z"
									fill="#121212" />
								<path d="M5.94019 4.71387V11.2861L11.6268 7.99998L5.94019 4.71387ZM7.19018 6.87989L9.12851 8.00001L7.19018 9.12013V6.87989Z" fill="#121212" />
							</svg>
						</a>
					</div>
					<?php
					endif;
					$header_whatsapp = get_theme_mod( 'set_social_whatsapp' );
					if ( !empty($header_whatsapp) ) :
					?>
					<div class="nav-social nav-icon float-left">
						<a target="_blank" href="<?php echo esc_url( $header_whatsapp ); ?>" title="<?php _e( 'Chat with us via WhatsApp', 'thegrapes' ); ?>">
							<svg id="regular" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m13.33 18.076c4.05.964 5.475-2.5 4.761-3.793-.286-.516-2.856-1.507-2.981-1.555-1.104-.402-1.512.348-2.277 1.335-1.469-.735-2.454-1.314-3.466-2.96.057-.071.133-.155.19-.219.354-.396 1.017-1.134.565-2.037-.38-.757-.569-1.285-.708-1.672-.403-1.121-.71-1.425-2.098-1.425-1.445 0-2.566 1.899-2.566 3.534 0 3.569 4.798 7.889 8.58 8.792zm-6.014-10.826c.3 0 .452.01.528.022.162.343.326 1.059.93 2.173-.094.351-1.429 1.174-.81 2.238 1.265 2.148 2.531 2.893 4.345 3.795 1.208.546 1.594-.443 2.36-1.312.355.144 1.553.674 2.079.94-.047 1.036-1.047 1.992-3.07 1.51-3.472-.829-7.429-4.735-7.429-7.333.001-.988.694-2.033 1.067-2.033z"/><path d="m.083 23.085c-.131.474.224.949.723.949.18 0-.114.046 5.848-1.5 2.427 1.236 4.272 1.197 5.45 1.308 10.555 0 15.725-12.873 8.461-20.363-9.957-9.624-25.464 2.336-18.975 14.127zm19.288-18.672c.173.316 5.135 4.791 2.372 11.478-1.701 4.12-5.626 6.659-10.024 6.421-3.578-.199-4.504-1.477-5.163-1.302l-4.683 1.22 1.245-4.524c.054-.194.027-.401-.073-.575-5.983-10.324 7.546-20.939 16.326-12.718z"/></svg>
						</a>
					</div>
					<?php
					endif;
					?>
				</div>
      </nav>
    </div>
    <div class="header-space"></div>
		<main class="content-wrap">
