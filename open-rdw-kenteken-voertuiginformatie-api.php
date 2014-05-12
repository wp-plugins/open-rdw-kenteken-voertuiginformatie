<?php
class getOpenRDW {

	private $key;
	private $url;
	private $url_option;

	public function __construct() {
		$this->key = get_option('open_data_rdw_key');
		$this->url = 'https://api.datamarket.azure.com/opendata.rdw/VRTG.Open.Data/v1/';
	}

	public function Data( $license ) {
		$WebSearchURL = $this->url . 'KENT_VRTG_O_DAT';

		$cred = sprintf('Authorization: Basic %s', 
		base64_encode($this->key . ":" . $this->key) );

		$context = stream_context_create(
		array(
			'http' 	=> array(
				'header' 		=> $cred,
				'ignore_errors' => TRUE
			)
		)
		);

		$request = $this->url . 'KENT_VRTG_O_DAT(\'' . urlencode( $this->clean_license($license) ) . '\')?$format=json';
		return json_decode( file_get_contents($request, 0, $context), true );
	}

	public function get_formatted($license = null) {
		$result = $this->Data($license);
		if( is_array($result) ) {
			$result = reset($result);
		}

		$options 	= array();
		$options[] 	= ($result['Kenteken'] || !$license ? array('category' => __('Vehicle','open_data_rdw'), 'label' => __('License plate','open_data_rdw'), 'name' => 'Kenteken', 'value' => $result['Kenteken']) : null);
		$options[] 	= ($result['Merk'] || !$license ? array('category' => __('Vehicle','open_data_rdw'), 'label' => __('Brand','open_data_rdw'), 'name' => 'Merk', 'value' => ucfirst($result['Merk'])) : null);
		$options[] 	= ($result['Handelsbenaming'] || !$license ? array('category' => __('Vehicle','open_data_rdw'), 'label' => __('Model','open_data_rdw'), 'name' => 'Handelsbenaming', 'value' => $result['Handelsbenaming']) : null);
		$options[] 	= ($result['Voertuigsoort'] || !$license ? array('category' => __('Vehicle','open_data_rdw'), 'label' => __('Vehicle type','open_data_rdw'), 'name' => 'Voertuigsoort', 'value' => $result['Voertuigsoort']) : null);

		$options[] 	= ($result['Eerstekleur'] || !$license ? array('category' => __('Version','open_data_rdw'), 'label' => __('Color (1)','open_data_rdw'), 'name' => 'Eerstekleur', 'value' => ucfirst($result['Eerstekleur'])) : null);
		$options[] 	= ($result['Tweedekleur'] || !$license ? array('category' => __('Version','open_data_rdw'), 'label' => __('Color (2)','open_data_rdw'), 'name' => 'Tweedekleur', 'value' => ucfirst($result['Tweedekleur'])) : null);
		$options[] 	= ($result['Aantalzitplaatsen'] || !$license ? array('category' => __('Version','open_data_rdw'), 'label' => __('Number of seats','open_data_rdw'), 'name' => 'Aantalzitplaatsen', 'value' => $result['Aantalzitplaatsen']) : null);
		$options[] 	= ($result['Aantalstaanplaatsen'] || !$license ? array('category' => __('Version','open_data_rdw'), 'label' => __('number of standing places','open_data_rdw'), 'name' => 'Aantalstaanplaatsen', 'value' => $result['Aantalstaanplaatsen']) : null);

		$options[] 	= ($result['Hoofdbrandstof'] || !$license ? array('category' => __('Motor','open_data_rdw'), 'label' => __('Fuel (1)','open_data_rdw'), 'name' => 'Hoofdbrandstof', 'value' => ucfirst($result['Hoofdbrandstof'])) : null);
		$options[] 	= ($result['Nevenbrandstof'] || !$license ? array('category' => __('Motor','open_data_rdw'), 'label' => __('Fuel (2)','open_data_rdw'), 'name' => 'Nevenbrandstof', 'value' => ucfirst($result['Nevenbrandstof'])) : null);
		$options[] 	= ($result['Aantalcilinders'] || !$license ? array('category' => __('Motor','open_data_rdw'), 'label' => __('Number of cylinders','open_data_rdw'), 'name' => 'Aantalcilinders', 'value' => $result['Aantalcilinders']) : null);
		$options[] 	= ($result['Cilinderinhoud'] || !$license ? array('category' => __('Motor','open_data_rdw'), 'label' =>  __('Engine capacity','open_data_rdw'), 'name' => 'Cilinderinhoud', 'value' => $result['Cilinderinhoud'].' cc') : null);

		$options[] 	= ($result['Massaleegvoertuig'] || !$license ? array('category' => __('Weight and capacity','open_data_rdw'), 'label' => __('Mass of empty vehicle','open_data_rdw'), 'name' => 'Massaleegvoertuig', 'value' => $result['Massaleegvoertuig'].' kg') : null);
		$options[] 	= ($result['Laadvermogen'] || !$license ? array('category' => __('Weight and capacity','open_data_rdw'), 'label' => __('Capacity','open_data_rdw'), 'name' => 'Laadvermogen', 'value' => $result['Laadvermogen'].' kg') : null);
		$options[] 	= ($result['Toegestanemaximummassavoertuig'] || !$license ? array('category' => __('Weight and capacity','open_data_rdw'), 'label' => __('Maximum permissible mass of vehicle','open_data_rdw'), 'name' => 'Toegestanemaximummassavoertuig', 'value' => $result['Toegestanemaximummassavoertuig'].' kg') : null);
		$options[] 	= ($result['Massarijklaar'] || !$license ? array('category' => __('Weight and capacity','open_data_rdw'), 'label' => __('Mass roadworthy','open_data_rdw'), 'name' => 'Massarijklaar', 'value' => $result['Massarijklaar'].' kg') : null);

		$options[] 	= ($result['Maximumtetrekkenmassaongeremd'] || !$license ? array('category' => __('Maximum towable mass','open_data_rdw'), 'label' => __('Unbraked','open_data_rdw'), 'name' => 'Maximumtetrekkenmassaongeremd', 'value' => $result['Maximumtetrekkenmassaongeremd'].' kg') : null);
		$options[] 	= ($result['Maximumtetrekkenmassageremd'] || !$license ? array('category' => __('Maximum towable mass','open_data_rdw'), 'label' => __('Braked','open_data_rdw'), 'name' => 'Maximumtetrekkenmassageremd', 'value' => $result['Maximumtetrekkenmassageremd'].' kg') : null);
		$options[] 	= ($result['Maximumtetrekkenmassaopleggergeremd'] || !$license ? array('category' => __('Maximum towable mass','open_data_rdw'), 'label' => __('Trailer braked','open_data_rdw'), 'name' => 'Maximumtetrekkenmassaopleggergeremd', 'value' => $result['Maximumtetrekkenmassaopleggergeremd'].' kg') : null);
		$options[] 	= ($result['Maximumtetrekkenmassaautonoomgeremd'] || !$license ? array('category' => __('Maximum towable mass','open_data_rdw'), 'label' => __('Autonomous braked','open_data_rdw'), 'name' => 'Maximumtetrekkenmassaautonoomgeremd', 'value' => $result['Maximumtetrekkenmassaautonoomgeremd'].' kg') : null);
		$options[] 	= ($result['Maximumtetrekkenmassamiddenasgeremd'] || !$license ? array('category' => __('Maximum towable mass','open_data_rdw'), 'label' => __('Center axis braked','open_data_rdw'), 'name' => 'Maximumtetrekkenmassamiddenasgeremd', 'value' => $result['Maximumtetrekkenmassamiddenasgeremd'].' kg') : null);
			
		$options[] 	= ($result['Datumeerstetoelating'] || !$license ? array('category' => __('History','open_data_rdw'), 'label' => __('Date of first registration','open_data_rdw'), 'name' => 'Datumeerstetoelating', 'value' => $this->dmy($result['Datumeerstetoelating'])) : null);
		$options[] 	= ($result['DatumeersteafgifteNederland'] || !$license ? array('category' => __('History','open_data_rdw'), 'label' => __('Date of first release Netherlands','open_data_rdw'), 'name' => 'DatumeersteafgifteNederland', 'value' => $this->dmy($result['DatumeersteafgifteNederland'])) : null);
		$options[] 	= ($result['Datumaanvangtenaamstelling'] || !$license ? array('category' => __('History','open_data_rdw'), 'label' => __('Date of last ascription','open_data_rdw'), 'name' => 'Datumaanvangtenaamstelling', 'value' => $this->dmy($result['Datumaanvangtenaamstelling'])) : null);
		$options[] 	= ($result['VervaldatumAPK'] || !$license ? array('category' => __('History','open_data_rdw'), 'label' => __('MOT Expiry','open_data_rdw'), 'name' => 'VervaldatumAPK', 'value' => $this->dmy($result['VervaldatumAPK'])) : null);
		
		return array_filter($options);
	}

	private function clean_license( $license ) {
		return strtoupper( preg_replace('/[^A-Za-z0-9]/', '', $license) );
	}

	private function dmy($date) {
		if( substr($date, 0, 6) == '/Date(' ) {
			$timestamp = preg_replace("/[^0-9]/","",$date)/1000;
			return date('d-m-Y', $timestamp);
		} else if ($date == '0000-00-00' || $date == '') {
			return null;
		} else {
			$timestamp = strtotime($date);
			return date('d-m-Y', $timestamp);
		}
		
	}

}