<?php
class OpenDataRDW_tinymce {

	public function register($plugin_array) {
		$plugin_array['open_data_rdw_button'] = OPEN_RDW_PLUGIN_URL . '/resources/open-data-rdw-tinymce.js';
		return $plugin_array;
	}

	public function add_buttons($buttons) {
		$buttons[] = "open_data_rdw_button";
		return $buttons;
	}

}
?>