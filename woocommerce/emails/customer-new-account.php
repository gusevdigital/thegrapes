<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
<?php
	$user = get_user_by('login', $user_login);
	if ( ! empty( $user ) ) {
		if( $user->first_name && $user->last_name) : ?>
			<h2 style="margin-bottom:40px;"><?php printf( esc_html__( 'Dear, %s. Welcome aboard!', 'woocommerce' ), $user->first_name . ' ' . $user->last_name ); ?></h2>
		<?php endif;
	}
?>
<h3 style="margin-bottom: 24px;"><?php _e( 'Your membership includes:', 'thegrapes' ); ?></h3>
<?php
for ($i=0; $i < 5; $i++) {
	$j = $i + 1;
	$member_benefits[$i]['icon'] = get_theme_mod( 'set_member_benefits_icon_' . $j, '' );
	$member_benefits[$i]['text'] = get_theme_mod( 'set_member_benefits_text_' . $j, '' );
}
?>
<div style="border: 2px solid #0B223B; border-radius: 4px; padding: 24px;margin-bottom:32px;">
<?php foreach ($member_benefits as $benefit) : ?>
	<?php if( $benefit['text'] ) :
		$benefit['text'] = str_replace( '<u>', '<u style="font-weight:bold;">', $benefit['text'] );
		?>
		<div style="display:flex;margin-bottom:24px;margin-bottom: 24px;">
			<?php if( $benefit['icon'] ) : ?>
				<div style="margin-right: 16px;width: 48px!important; min-height: 48px; height: auto;">
					<img src="<?php echo is_numeric( $benefit['icon'] ) ? wp_get_attachment_url( $benefit['icon'] ) : $benefit['icon']; ?>" style="width: 100%; height: auto;min-width:48px;">
				</div>
			<?php endif; ?>
			<div>
				<div style="color:#414141;"><?php echo $benefit['text']; ?></div>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; ?>
</div>
<table style="width:100%;">
	<tr>
		<td style="width:50%;text-align:center;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;border-width:0;">
			<h3 style="text-align:center;"><a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" title="<?php _e( 'Our store', 'thegrapes' ); ?>"><?php _e( 'Visit store', 'thegrapes' ); ?></a></h3>
		</td>
		<td style="width:50%;text-align:center;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;border-width:0;">
			<h3 style="text-align:center;"><a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ?>" title="<?php _e( 'Member account', 'thegrapes' ); ?>"><?php _e( 'Visit my account', 'thegrapes' ); ?></a></h3>
		</td>
	</tr>
</table>



<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
