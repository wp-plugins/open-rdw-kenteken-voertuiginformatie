<?php
class Open_RDW_Kenteken_Widget extends WP_Widget {

	private $rdw;

	public function __construct() {
		parent::__construct(
			'open_rdw_widget', // Base ID
			'Open RDW Kenteken widget', // Name
			array('description' => __( 'Request data by means of license plate from the Open RDW.', 'open_data_rdw' )) // Args
		);
		$this->rdw = new getOpenRDW();
	}

	public function widget($args, $instance) {
		wp_register_style('open_rdw_widget', OPEN_RDW_PLUGIN_URL . '/resources/widget.css');
		wp_enqueue_style('open_rdw_widget');

		if ($_POST['open_data_rdw_kenteken']) {
			$data = $this->rdw->get_formatted($_POST['open_data_rdw_kenteken']);
		}
		extract($args, EXTR_SKIP);
		extract($instance);
		
		if( strpos($before_widget, 'class') === false ) {
    		$before_widget = str_replace('>', 'class="'. $open_data_rdw_class . '"', $before_widget);
  		} else {
  			$before_widget = str_replace('class="', 'class="'. $open_data_rdw_class . ' ', $before_widget);
  		}
		
		include(OPEN_RDW_PLUGIN_DIR . '/views/frontend/widget.php');
	}

	public function form($instance) {
		$fields = $this->rdw->get_formatted();
		$open_data_rdw_class = ! empty($instance['open_data_rdw_class']) ? $instance['open_data_rdw_class'] : 'open-data-widget';

		include(OPEN_RDW_PLUGIN_DIR . '/views/admin/widget-settings.php');
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['open_data_rdw_class'] = $new_instance['open_data_rdw_class'];
		$instance['title'] = $new_instance['title'];

		$fields = $this->rdw->get_formatted();
		foreach ($fields as $f) {
			$instance[$f['name']] = isset($new_instance[$f['name']]) ? true : false;
		}

		return $instance;
	}
}
?>