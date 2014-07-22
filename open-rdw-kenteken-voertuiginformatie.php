<?php
/*
	Plugin Name: Open RDW kenteken voertuiginformatie
	Plugin URI: http://www.tussendoor.nl
	Description: Open RDW Kenteken voertuiginformatie voor het ophalen en verwerken van voertuig informatie binnen WordPress. Plugin vereist koppeling met RDW
	Version: 1.0.6
	Author: Tussendoor internet & marketing
	Author URI: http://www.tussendoor.nl
	Tested up to: 3.9
*/

if ( ! defined('OPEN_RDW_PLUGIN_DIR')) define('OPEN_RDW_PLUGIN_DIR', dirname(__FILE__));
if ( ! defined('OPEN_RDW_PLUGIN_URL')) define('OPEN_RDW_PLUGIN_URL', plugins_url('open-rdw-kenteken-voertuiginformatie'));

require_once('open-rdw-kenteken-voertuiginformatie-api.php');
require_once('open-rdw-kenteken-voertuiginformatie-widget.php');
require_once('open-rdw-kenteken-voertuiginformatie-wpcf7.php');
require_once('open-rdw-kenteken-voertuiginformatie-tinymce.php');

class OpenDataRDW {

	private $rdw;

	public function __construct() {

		$this->rdw = new getOpenRDW();

		add_action('init', array($this, 'init'));
		add_action('admin_menu', array($this, 'admin_menu'));
		add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
		add_action('widgets_init', array($this, 'register_widget'));

		add_shortcode('open_data_rdw_check', array($this, 'shortcode'));
		add_filter('open_data_rdw_check', array($this, 'do_shortcode'));

		add_shortcode('open_rdw_quform', array($this, 'quform_shortcode'));

		add_action('wp_ajax_get_open_rdw_data', array($this, 'get_json'));
		add_action('wp_ajax_nopriv_get_open_rdw_data', array($this, 'get_json'));
	}

	public function init() {

		//Set language folder
		load_plugin_textdomain( 'open_data_rdw', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		// Start WPCF7 plugins
		if (function_exists('wpcf7_add_shortcode')) {
			$wpcf7 = new OpenDataRDW_wpcf7();
			wpcf7_add_shortcode(array('open_rdw', 'open_rdw*'), array($wpcf7, 'shortcode_handler'), true);
		}

		//Abort early if the user will never see TinyMCE
		if (current_user_can('edit_posts') && current_user_can('edit_pages') && get_user_option('rich_editing') == 'true') {
			$tinymce = new OpenDataRDW_tinymce();

			// //Add a callback to regiser our tinymce plugin   
			add_filter('mce_external_plugins', array($tinymce, 'register'));

			// // Add a callback to add our button to the TinyMCE toolbar
			add_filter('mce_buttons', array($tinymce, 'add_buttons'));
		}
		
		// Register and include the javascript files
		wp_register_script('open_rdw_quform_script', OPEN_RDW_PLUGIN_URL . '/resources/open-rdw-quform.js', array('jquery'), '1.0.4');
		wp_register_script('open_data_rdw_script', OPEN_RDW_PLUGIN_URL . '/resources/open-data-rdw.js', array('jquery'), '1.0.4');
		wp_enqueue_script('open_data_rdw_script');

		wp_localize_script( 'open_data_rdw_script', 'ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
	}

	public function admin_menu() {
		add_menu_page('Open data RDW', 'Open data RDW', 'manage_options', 'open_data_rdw', array(&$this, 'about'), OPEN_RDW_PLUGIN_URL.'/resources/open-rdw_white.png');
		add_submenu_page ('open_data_rdw', __('Information', 'open_data_rdw'), __('Information', 'open_data_rdw'), 'manage_options', 'open_data_rdw_about', array(&$this, 'about'));
		add_submenu_page ('open_data_rdw', __('Settings', 'open_data_rdw'), __('Settings', 'open_data_rdw'), 'manage_options', 'open_data_rdw_settings', array(&$this, 'settings'));
		remove_submenu_page('open_data_rdw', 'open_data_rdw');
	}

	public function admin_enqueue_scripts() {
		wp_register_style('open_data_rdw_admin', OPEN_RDW_PLUGIN_URL . '/resources/admin.css');
		wp_enqueue_style('open_data_rdw_admin');

		wp_register_script('open_data_rdw_tinymce', OPEN_RDW_PLUGIN_URL . '/resources/open-data-rdw-tinymce.js', array('jquery'), '1.0.3');
		wp_enqueue_script('open_data_rdw_tinymce');
	}

	public function about() {
		$fields = $this->rdw->get_formatted();
		require_once(OPEN_RDW_PLUGIN_DIR . '/views/admin/about.php');
	}

	public function settings() {
		if( $_POST ) {
			update_option('open_data_rdw_key', $_POST['open_data_rdw_key']);
		}
		require_once(OPEN_RDW_PLUGIN_DIR . '/views/admin/settings.php');
	}

	/*--------------------------------------------------------------
	- AJAX
	--------------------------------------------------------------*/

	public function get_json() {
		if ( isset( $_POST['kenteken'] ) ) {
			$data = $this->rdw->get_formatted($_POST['kenteken']);
			foreach ($data as $row) {
				$json['result'][$row['name']] = $row['value'];
			}

			if ($_POST['kenteken']) {
				if ($data[0]['value'] == '') {
					$json['errors'] = __( 'No license plates found', 'open_data_rdw' );
				}
				else {
					$json['errors'] = false;
				}	
			}
			else {
				$json['errors'] = __( 'No license plate entered', 'open_data_rdw' );
			}

			header('Content-type: application/json');
			echo json_encode($json);
			die();
		}
	}

	/*--------------------------------------------------------------
	- Register the plugin widget
	--------------------------------------------------------------*/

	public function register_widget() {
		register_widget('Open_RDW_Kenteken_Widget');
	}

	/*--------------------------------------------------------------
	- Kenteken check shortcode
	--------------------------------------------------------------*/

	public function shortcode($fields) {
		if( isset($_POST['open_data_rdw_kenteken']) ) {
			$data = $this->rdw->get_formatted( $_POST['open_data_rdw_kenteken'] );
		}
		include(OPEN_RDW_PLUGIN_DIR . '/views/frontend/shortcode.php');
	}

	public function quform_shortcode($fields) {
		$license_key = array_search('Kenteken', $fields);

		if( $license_key ):
			$license = $license_key; unset($fields[$license_key]);
			wp_enqueue_script( 'open_rdw_quform_script' );

			$data = array(
				'license'	=> $license,
				'fields' 	=> array_flip($fields),
				'url'		=> admin_url( 'admin-ajax.php' ),
				'images' 	=> array(
					'loading' => OPEN_RDW_PLUGIN_URL . '/resources/ajax-loader.gif',
					'warning' => OPEN_RDW_PLUGIN_URL . '/resources/warning-icon.png',
					'success' => OPEN_RDW_PLUGIN_URL . '/resources/accepted-icon.png'
				)
			);
			wp_localize_script( 'open_rdw_quform_script', 'ajax', $data );
		endif;
	}

}

new OpenDataRDW();
?>