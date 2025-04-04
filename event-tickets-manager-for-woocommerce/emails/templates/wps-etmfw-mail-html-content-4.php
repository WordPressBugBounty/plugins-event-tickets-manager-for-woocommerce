<?php
/**
 * Exit if accessed directly
 * Vertico
 * @package    Event_Tickets_Manager_For_Woocommerce
 * @subpackage Event_Tickets_Manager_For_Woocommerce/emails/templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_plugin_active( 'event-tickets-manager-for-woocommerce-pro/event-tickets-manager-for-woocommerce-pro.php' ) ) {
	$wps_etmfw_background_color = ! empty( get_option( 'wps_etmfw_pdf_background_color' ) ) ? get_option( 'wps_etmfw_pdf_background_color' ) : '#000000';
	$wps_etmfw_text_color = ! empty( get_option( 'wps_etmfw_pdf_text_color' ) ) ? get_option( 'wps_etmfw_pdf_text_color' ) : '#ffffff';
	$wps_etmfw_header_background_color = ! empty( get_option( 'wps_etmfw_pdf_header_background_color' ) ) ? get_option( 'wps_etmfw_pdf_header_background_color' ) : '#000000';
} else {
	$wps_etmfw_background_color = ! empty( get_option( 'wps_etmfw_ticket_bg_color', '' ) ) ? get_option( 'wps_etmfw_ticket_bg_color' ) : '#000000';
	$wps_etmfw_text_color = ! empty( get_option( 'wps_etmfw_ticket_text_color', '' ) ) ? get_option( 'wps_etmfw_ticket_text_color', '' ) : '#f5ebeb';
	$wps_etmfw_header_background_color = ! empty( get_option( 'wps_etmfw_ticket_bg_color' ) ) ? get_option( 'wps_etmfw_ticket_bg_color' ) : '#000000';
}


$wps_etmfw_border_type = ! empty( get_option( 'wps_etmfw_border_type' ) ) ? get_option( 'wps_etmfw_border_type' ) : 'none';
$wps_etmfw_border_color = ! empty( get_option( 'wps_etmfw_pdf_border_color' ) ) ? get_option( 'wps_etmfw_pdf_border_color' ) : '#000000';
$wps_etmfw_logo_size = ! empty( get_option( 'wps_etmfw_logo_size', true ) ) ? get_option( 'wps_etmfw_logo_size', true ) : '180';
$wps_etmfw_qr_size = ! empty( get_option( 'wps_etmfw_qr_size' ) ) ? get_option( 'wps_etmfw_qr_size' ) : '180';
$wps_etmfw_qr_code_is_enable = ! empty( get_option( 'wps_etmfwp_include_qr' ) ) ? get_option( 'wps_etmfwp_include_qr' ) : '';

$image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail');
if('on' == get_option( 'wps_etmfw_prod_logo_plugin' ) ){
	$product_image_url = (is_array($image) && isset($image[0])) ? $image[0] : '';
	} else {
	$product_image_url = ! empty( get_option( 'wps_etmfw_mail_setting_upload_logo' ) ) ? get_option( 'wps_etmfw_mail_setting_upload_logo' ) : '';
	}
	
	$wps_etmfw_hide_details_pdf_ticket = get_option( 'wps_wet_hide_details_pdf_ticket' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php esc_html_e('Event Ticket', 'event-tickets-manager-for-woocommerce'); ?></title>
</head>
<body>
	<div class="ticket-container wps_etmfw_border_color wps_etmfw_ticket_body wps_etmfw_pdf_text_colour" style="background-color:  <?php echo esc_attr( $wps_etmfw_background_color ); ?>; border: 2px <?php echo esc_attr( $wps_etmfw_border_type . ' ' . $wps_etmfw_border_color ); ?>; color: <?php echo esc_attr( $wps_etmfw_text_color ); ?>;" id="wps_event_border_type">
		<div class="ticket-header" style="background-color:  <?php echo esc_attr( $wps_etmfw_header_background_color ); ?>;">  <!-- Add different color section -->
			<h1 class="wps_etmfw_pdf_text_colour" style="text-align: center;color: <?php echo esc_attr( $wps_etmfw_text_color ); ?>;">[EVENTNAME]</h1>
		</div>
		<table style="width:100%; margin:0 0 50px;">
			<tr style="padding: 20px; text-align: left;">
				<td style="width:32%; text-align:center; vertical-align:top;">
					<img class="logo" id="wps_wem_logo_id" style="width: <?php echo esc_attr( $wps_etmfw_logo_size . 'px' ); ?>; height: auto; margin-right: 20px;" src = <?php echo esc_url($product_image_url); ?>  alt="Event Logo">
				</td>
				<td>
					<div style="text-align: left;">
						<p><strong><?php esc_html_e('Event Name', 'event-tickets-manager-for-woocommerce'); ?>: </strong>[EVENTNAME]</p>
						<p><strong><?php echo esc_html__( 'Start Date', 'event-tickets-manager-for-woocommerce' ); ?>:</strong> [STARTDATE]</p>
						<p><strong><?php echo esc_html__( 'End Date', 'event-tickets-manager-for-woocommerce' ); ?>:</strong> [ENDDATE]</p>
						<p><strong><?php echo esc_html__( 'Venue', 'event-tickets-manager-for-woocommerce' ); ?>:</strong> [VENUE]</p>
					</div>
				</td>
			</tr>
		</table>
		<?php if ( 'on' == $wps_etmfw_qr_code_is_enable ) { ?>
			<div class="ticket-qrcode" style="text-align: center; margin:20px 0px;">
			[TICKET]
			</div>
		<?php } elseif ( 'on' == get_option( 'wps_etmfwp_include_barcode' ) ) { ?>
			<div style="text-align: center; margin:20px 0px;">
				<span style="background:white; text-align: center; margin:auto; padding:10px; max-width:220px; display:inline-block;">
					<img style="max-height:120px; max-width:200px;" src="[TICKET_URL]" alt="">
				</span>
			</div>
		<?php } else { ?>
			<div class="ticket-code wps_etmfw_pdf_text_colour" style="flex: 1; padding: 20px; text-align: center; border: 2px dashed #ddd;">
				<p style="font-size: 24px; margin: 0; padding: 10px;"><?php esc_html_e('Ticket Code: ', 'event-tickets-manager-for-woocommerce'); ?> [TICKET]</p>
			</div>
		<?php } 
		if ( 'on' != $wps_etmfw_hide_details_pdf_ticket ) {
			?>
				<div class="participant-details" style="padding: 20px; border-top: 2px solid #ddd; text-align: left; overflow-y: auto;">
				[ADDITIONALINFO]
					<!-- Add more participant details here if needed -->
				</div>
		<?php } ?>
		<div class="ticket-footer wps_etmfw_ticket_body" style="padding: 20px;color: <?php echo esc_attr( $wps_etmfw_text_color ); ?>; text-align: center; background-color: <?php echo esc_attr( $wps_etmfw_background_color ); ?>; border-top: 2px solid #ddd;">
			<p style="margin: 10px 0; font-size: 14px; color: <?php echo esc_attr( $wps_etmfw_text_color ); ?>!important;">[EMAILBODYCONTENT]</p>
		</div>
	</div>
</body>
</html>
