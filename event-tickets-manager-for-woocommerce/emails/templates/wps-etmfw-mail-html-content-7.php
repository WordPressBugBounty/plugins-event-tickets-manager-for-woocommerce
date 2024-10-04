<?php

/**
 * Exit if accessed directly
 *
 * @package    Event_Tickets_Manager_For_Woocommerce
 * @subpackage Event_Tickets_Manager_For_Woocommerce/emails/templates
 */

if (!defined('ABSPATH')) {
	exit;
}

if (is_plugin_active('event-tickets-manager-for-woocommerce-pro/event-tickets-manager-for-woocommerce-pro.php')) {
	$wps_etmfw_background_color = !empty(get_option('wps_etmfw_pdf_background_color')) ? get_option('wps_etmfw_pdf_background_color') : '#006333';
	$wps_etmfw_text_color = !empty(get_option('wps_etmfw_pdf_text_color')) ? get_option('wps_etmfw_pdf_text_color') : '#ffffff';
	$wps_etmfw_header_background_color = !empty(get_option('wps_etmfw_pdf_header_background_color')) ? get_option('wps_etmfw_pdf_header_background_color') : '#81d742';
} else {
	$wps_etmfw_background_color = !empty(get_option('wps_etmfw_ticket_bg_color', '')) ? get_option('wps_etmfw_ticket_bg_color') : '#f5ebeb';
	$wps_etmfw_text_color = !empty(get_option('wps_etmfw_ticket_text_color', '')) ? get_option('wps_etmfw_ticket_text_color', '') : '#f5ebeb';
	$wps_etmfw_header_background_color = !empty(get_option('wps_etmfw_ticket_bg_color')) ? get_option('wps_etmfw_ticket_bg_color') : '#81d742';
}

$wps_etmfw_border_type = !empty(get_option('wps_etmfw_border_type')) ? get_option('wps_etmfw_border_type') : 'none';
$wps_etmfw_border_color = !empty(get_option('wps_etmfw_pdf_border_color')) ? get_option('wps_etmfw_pdf_border_color') : '#000000';
$wps_etmfw_logo_size = !empty(get_option('wps_etmfw_logo_size', true)) ? get_option('wps_etmfw_logo_size', true) : '180';
$wps_etmfw_qr_size = !empty(get_option('wps_etmfw_qr_size')) ? get_option('wps_etmfw_qr_size') : '180';
$wps_etmfw_qr_code_is_enable = !empty(get_option('wps_etmfwp_include_qr')) ? get_option('wps_etmfwp_include_qr') : '';
$wps_etmfw_barcode_enable = !empty(get_option('wps_etmfwp_include_barcode')) ? get_option('wps_etmfwp_include_barcode') : '';

$image_attributes = '';
$wps_etmfw_background_image = !empty(get_option('wps_etmfw_background_image')) ? get_option('wps_etmfw_background_image') : '';
if (!empty($wps_etmfw_background_image)) {
	$image_attributes = wp_get_attachment_image_src($wps_etmfw_background_image, 'thumbnail');
}

$image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail');
if ('on' == get_option('wps_etmfw_prod_logo_plugin')) {
	$product_image_url = (is_array($image) && isset($image[0])) ? $image[0] : '';
} else {
	$product_image_url = !empty(get_option('wps_etmfw_mail_setting_upload_logo')) ? get_option('wps_etmfw_mail_setting_upload_logo') : '';
}

?>
<!-- Template Start -->

<table border='0' cellpadding='0' cellspacing='0' role='presentation' style='width: 100%;font-family:Arial, Helvetica, sans-serif;'>
	<tbody>
		<tr>
			<td colspan="3" style='padding: 0 0 10px;'>
				<div style="padding:20px;background-image:url(<?php echo esc_url($image_attributes[0]); ?>);background-size: cover;background-position:center center;background-repeat: no-repeat;">
					<div style="background-image: url(<?php echo $product_image_url; ?>); height: 40px; background-size: contain; background-position: center; background-repeat: no-repeat"></div>
					<div style='color:#FFC525;font-size:32px;font-weight:bold;margin:10px 0 0;letter-spacing:0.5px;line-height:1.25;text-align:center;'>[EVENTNAME]</div>
				</div>
			</td>
		</tr>
		<tr>
			<td style="width:35%;padding:10px;background:#FFC525;">
				<div style='color:#000;'>
					<h3 style='color:#000;font-size:14px;font-weight:normal;margin:0 0 8px;letter-spacing:0.5px;'><strong style='color:#000;'><?php echo __('From:', 'event-tickets-manager-for-woocommerce'); ?></strong>[NEW_START_DATE]</h3>
					<h3 style='color:#000;font-size:14px;font-weight:normal;margin:0 0 8px;letter-spacing:0.5px;'><strong style='color:#000;'><?php echo __('To:', 'event-tickets-manager-for-woocommerce'); ?> </strong>[NEW_END_DATE]</h3>
					<h3 style='color:#000;font-size:14px;font-weight:normal;margin:0;letter-spacing:0.5px;'><strong style='color:#000;'><?php echo __('Venue:', 'event-tickets-manager-for-woocommerce'); ?> </strong>[VENUE]</h4>
				</div>
			</td>
			<td style="width:30%;background:#fff;">
				<div style='text-align:center;padding:20px;'>
					<h4 style='color:#000;font-size: 20px;font-weight:bold;line-height:20px;border-bottom:1px solid #f4f4f4;margin: 0 0 5px;padding:0 0 10px;text-align: center;letter-spacing:0.5px;'><?php echo __('Ticket Code', 'event-tickets-manager-for-woocommerce'); ?></h4>

                    <?php if (('on' == $wps_etmfw_barcode_enable) && (('' == $wps_etmfw_qr_code_is_enable))) { ?>
					<!-- BAR CODE START-->
					<div style="background-image: url([TICKET_URL]); height: 40px; background-size: contain; background-position: center center; background-repeat: no-repeat"></div>
					<!-- BAR CODE END -->
                    <?php } ?>

                    <?php if (is_plugin_active('event-tickets-manager-for-woocommerce-pro/event-tickets-manager-for-woocommerce-pro.php') && ('on' == $wps_etmfw_qr_code_is_enable) && ('' == $wps_etmfw_barcode_enable)) { ?>
						<!-- QR CODE START -->
                        <div style="height:150px;max-width:150px;width:100%;margin:auto;text-align: center;background-image: url([TICKET_URL]); background-size:140% 140%;background-position: center center; background-repeat: no-repeat"></div>
						<!-- QR CODE END -->
					<?php  } ?>

                    <?php if (('' == $wps_etmfw_barcode_enable) && (('' == $wps_etmfw_qr_code_is_enable))) { ?>
					<h4 style='color:#000;font-size: 20px;font-weight:normal;line-height:1;border-top:1px solid #f4f4f4;margin: 5px 0 0;padding:10px 0 0;text-align: center;letter-spacing:0.5px;'>[TICKET]</h4>
                    <?php } ?>
				</div>
			</td>
			<td style='width:35%;padding:10px;background:#FFC525;'>
				[ADDITIONALINFO]
			</td>
		</tr>
		<tr>
			<td colspan="3" style='padding-top:10px;'>
				<div style='padding: 20px;background:#f4f4f4;'>
					<h4 style='color:#000;font-weight:bold;font-size:18px;margin:0 0 5px;letter-spacing:0.5px;line-height:1;'><?php echo __('Note:', 'event-tickets-manager-for-woocommerce'); ?></h4>
					<p style='color:#000;font-size:14px;letter-spacing:0.5px;line-height:1.5;'>[EMAILBODYCONTENT]</p>
				</div>
			</td>
		</tr>
	</tbody>
</table>
<!-- Template End -->