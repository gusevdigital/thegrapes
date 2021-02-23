<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load colors.
$bg        = get_option( 'woocommerce_email_background_color' );
$body      = get_option( 'woocommerce_email_body_background_color' );
$base      = get_option( 'woocommerce_email_base_color' );
$base_text = wc_light_or_dark( $base, '#202020', '#ffffff' );
$text      = get_option( 'woocommerce_email_text_color' );

// Pick a contrasting color for links.
$link_color = wc_hex_is_light( $base ) ? $base : $base_text;

if ( wc_hex_is_light( $body ) ) {
	$link_color = wc_hex_is_light( $base ) ? $base_text : $base;
}

$bg_darker_10    = wc_hex_darker( $bg, 10 );
$body_darker_10  = wc_hex_darker( $body, 10 );
$base_lighter_20 = wc_hex_lighter( $base, 20 );
$base_lighter_40 = wc_hex_lighter( $base, 40 );
$text_lighter_20 = wc_hex_lighter( $text, 20 );
$text_lighter_40 = wc_hex_lighter( $text, 40 );

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
// body{padding: 0;} ensures proper scale/positioning of the email in the iOS native email app.
?>
body {
	padding: 0;
}


#wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
	margin: 0;
	padding: 70px 0;
	-webkit-text-size-adjust: none !important;
	width: 100%;
}

#template_container {
	box-shadow: -8px 0 16px 0 rgba(18, 18, 18, 0.24) !important;
	background-color: <?php echo esc_attr( $body ); ?>;
	border: 2px solid <?php echo esc_attr( $base ); ?>;
	border-radius: 3px !important;
	width: 100%;
	max-width: 600px;
}

#template_header {
	background-color: <?php echo esc_attr( $base ); ?>;
	border-radius: 0 !important;
	color: <?php echo esc_attr( $base_text ); ?>;
	border-bottom: 0;
	font-weight: bold;
	line-height: 100%;
	vertical-align: middle;
	font-family: Arial, sans-serif;
	width: 100%;
	max-width: 600px;
}

#template_header h1,
#template_header h1 a {
	color: <?php echo esc_attr( $base_text ); ?>;
	background-color: inherit;
}

#template_header_image img {
	margin-left: 0;
	margin-right: 0;
}

#template_footer td {
	padding: 0;
	border-radius: 6px;
}

#template_footer #credit {
	border: 0;
	color: <?php echo esc_attr( $text_lighter_40 ); ?>;
	font-family: Arial, sans-serif;
	font-size: 12px;
	line-height: 150%;
	text-align: center;
	padding: 24px 0;
}

#template_footer #credit p {
	margin: 0 0 16px;
}

#body_content {
	background-color: <?php echo esc_attr( $body ); ?>;
	padding: 24px;
}

#body_content table td {
	padding: 48px 48px 32px;
}

#body_content table {
	border-width: 0;
}

#body_content table img {
	margin-bottom: 0;
	width: auto;
	height: auto;
	max-height: auto;
	max-width: auto;
}


#body_content table tr td {
	padding: 12px;
}

#body_content table tr th {
	padding: 12px;
}

#body_content .thegrapes-order-details table td {
	border-width: 0 0 2px 0;
	border-color: rgba(11,34,59,0.24);
}

#body_content .payment-method-notification p {
	margin-bottom: 0;
}

#body_content .thegrapes-order-details table tbody tr:last-of-type td {
	border-bottom-width: 0;
}

#body_content .thegrapes-order-details table tfoot tr:last-of-type td {
	border-bottom-width: 0;
}

#body_content .thegrapes-order-details table th {
	border-width: 0 0 2px 0;
	border-color: rgba(11,34,59,0.24);
}

#body_content .thegrapes-order-details table tr:last-of-type th {
	border-bottom-width:0;
}


#body_content td ul.wc-item-meta {
	font-size: small;
	margin: 1em 0 0;
	padding: 0;
	list-style: none;
}

#body_content td ul.wc-item-meta li {
	margin: 0.5em 0 0;
	padding: 0;
}

#body_content td ul.wc-item-meta li p {
	margin: 0;
}

#body_content p {
	margin: 0 0 16px;
}

#body_content_inner {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	font-family: Arial, sans-serif;
	font-size: 14px;
	line-height: 150%;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

#body_content_inner>p {
	display:none!important;
}

.td {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border-style: solid;
	vertical-align: middle;
}

.address {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
}

.text {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: Arial, sans-serif;
}

.link {
	color: <?php echo esc_attr( $link_color ); ?>;
}

#header_wrapper {
	padding: 36px 48px;
	display: block;
}

h1 {
	color: <?php echo esc_attr( $base ); ?>;
	font-family: Georgia, serif;
	font-size: 30px;
	font-weight: 300;
	line-height: 150%;
	margin: 0;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
	text-shadow: 0 1px 0 <?php echo esc_attr( $base_lighter_20 ); ?>;
}

h2 {
	color: <?php echo esc_attr( $base ); ?>;
	display: block;
	font-family: Arial, sans-serif;
	font-size: 18px;
	font-weight: bold;
	line-height: 130%;
	margin: 0 0 18px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

h3 {
	color: <?php echo esc_attr( $base ); ?>;
	display: block;
	font-family: Arial, sans-serif;
	font-size: 16px;
	font-weight: bold;
	line-height: 130%;
	margin: 16px 0 8px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

a {
	color: <?php echo esc_attr( $link_color ); ?>;
	font-weight: bold;
	letter-spacing: 1px;
	text-decoration: underline;
	text-transform:lowercase;
}

img {
	border: none;
	display: inline-block;
	font-size: 14px;
	font-weight: bold;
	height: auto;
	outline: none;
	text-decoration: none;
	text-transform: capitalize;
	vertical-align: middle;
	margin-<?php echo is_rtl() ? 'left' : 'right'; ?>: 10px;
	max-width: 100%;
	height: auto;
	margin-bottom: 40px;
	max-height: 80px;
}
<?php
