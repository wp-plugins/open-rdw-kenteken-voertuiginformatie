<?php
if( !function_exists('get_tsd_footer_iframe') ):
	function get_tsd_footer_iframe( $id = 1, $filename = 'wordpress-plugin.html', $return = false ) {
		$json = @file_get_contents('http://crm.tussendoor.nl/view-iframe/'.$id.'/'.$filename.'?code=1');
		if( $json ):
			$iframe_code = json_decode($json, true);
			if( isset($iframe_code['code']) ):
				if( $return ):
					return $iframe_code['code'];
				else:
					echo $iframe_code['code'];
				endif;
			endif;
		endif;
	}
endif;