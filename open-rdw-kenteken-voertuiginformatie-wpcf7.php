<?php
class OpenDataRDW_wpcf7 {

	public function __construct() {
		add_action('init', array($this, 'wpcf7_add_shortcode_open_rdw'), 7);
		add_action('admin_init', array($this, 'wpcf7_add_tag_generator_open_rdw'), 22);
	}

	/*--------------------------------------------------------------
	- Register the shortcode handler
	--------------------------------------------------------------*/

	public function wpcf7_add_shortcode_open_rdw() {
		if (function_exists('wpcf7_add_shortcode')) {
			wpcf7_add_shortcode('open_rdw', array($this, 'wpcf7_open_rdw_shortcode_handler'), true);
			wpcf7_add_shortcode('open_rdw*', array($this, 'wpcf7_open_rdw_shortcode_handler'), true);
		}
	}

	/*--------------------------------------------------------------
	- Register the tag wpcf7-tag-generator
	--------------------------------------------------------------*/

	public function wpcf7_add_tag_generator_open_rdw() {
		if (function_exists('wpcf7_add_tag_generator')) {
			wpcf7_add_tag_generator(
				'open_rdw',
				'Kenteken (Open RDW)',
				'wpcf7-tg-pane-open-rdw',
				array($this, 'wpcf7_tg_pane_open_rdw')
			);
		}
	}

	/*--------------------------------------------------------------
	- Shortcode handler
	--------------------------------------------------------------*/

	public function wpcf7_open_rdw_shortcode_handler( $tag ) {
		$tag = new WPCF7_Shortcode( $tag );

		if ( empty( $tag->name ) )
			return '';

		$atts['class'] 	= $tag->get_class_option($class);
		$atts['id'] 	= 'open-data-rdw';

		$value = (string) reset( $tag->values );

		if ( $tag->has_option( 'placeholder' ) || $tag->has_option( 'watermark' ) ) {
			$atts['placeholder'] = $value;
			$value = '';
		}

		$atts['value'] 		= $value;
		$atts['type'] 		= 'text';
		$atts['name'] 		= $tag->name;
		$atts['style'] 		= 'text-transform:uppercase';
		$atts['maxlength'] 	= '8';

		$atts = wpcf7_format_atts($atts);

		$html = sprintf(
			'<span class="wpcf7-form-control-wrap %1$s"><input %2$s />%3$s</span>',
			$tag->name, $atts, $validation_error);

		$html .= ' <img src="' . OPEN_RDW_PLUGIN_URL . '/resources/ajax-loader.gif" id="open_rdw-loading" style="display:none">';
		$html .= ' <img src="' . OPEN_RDW_PLUGIN_URL . '/resources/warning-icon.png" id="open_rdw-error" style="display:none">';
		$html .= ' <img src="' . OPEN_RDW_PLUGIN_URL . '/resources/accepted-icon.png" id="open_rdw-accepted" style="display:none">';

		return $html;
	}

	/*--------------------------------------------------------------
	- Tag generator
	--------------------------------------------------------------*/

	public function wpcf7_tg_pane_open_rdw( &$contact_form ) {
		$rdw = new getOpenRDW();
		$fields = $rdw->get_formatted();
		include(OPEN_RDW_PLUGIN_DIR . '/views/admin/wpcf7-tag-generator.php');
	}

}
?>