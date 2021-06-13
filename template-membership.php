<?php
/*
# ===================================================
# template-membership.php
#
# Template name: Membership
# ===================================================
*/

defined( 'ABSPATH' ) || exit;

get_header();

$member_header_desc = get_theme_mod( 'set_member_header_desc', '' );
$member_header_img = get_theme_mod( 'set_member_header_img' );

for ($i=0; $i < 5; $i++) {
  $j = $i + 1;
  $member_benefits[$i]['icon'] = get_theme_mod( 'set_member_benefits_icon_' . $j, '' );
  $member_benefits[$i]['text'] = get_theme_mod( 'set_member_benefits_text_' . $j, '' );
}

?>
<section id="sec-shop-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php the_title(); ?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
						</ol>
					</nav>
					<div class="subheader mb-5">
						<p class="lead">
							<?php echo wpautop( esc_html($member_header_desc), false ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
        <?php if( isset($member_header_img) && $member_header_img ): ?>
					<div class="intro-bg-img">
            <?php echo wp_get_attachment_image( $member_header_img, 'full', false, array( 'class' => ' wow fadeInUp nolazyload', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ); ?>
          </div>

				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section id="membership">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php if( ! is_user_logged_in() ) : ?>
					<div class="already-member d-flex flex-column flex-md-row align-items-center mb-8">
						<span class="text-large d-inline-block mr-0 mr-md-2 mb-2 mb-md-0">
							<?php _e( 'Already a member?', 'thegrapes' ); ?>
						</span>
						<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ?>" class="btn btn-line btn-primary"><span><?php _e( 'Login', 'thegrapes' ); ?></span></a>
					</div>
				<?php endif; ?>
				<h2><?php _e( 'Member will recieve:', 'thegrapes' ); ?></h2>
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
							 	<div class="text-large mb-2">Become a member</div>
								<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ?>" class="btn btn-line btn-primary"><span><?php _e( 'Join now', 'thegrapes' ); ?></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

 <?php

get_footer();
