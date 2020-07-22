<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the MeasurementUnits requests
 */

class MeasurementUnits extends Authentication{

	/**
	* Get list of Measurement Units in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=266
	**/
	public function getMeasurementUnits(array $c)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/measurementUnits/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $c['company_id']]);
		return $response;
	}

	/**
	* Create Measurement Units in the Company 
	* @param array $mu Measurement Units
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=267
	**/
	public function setMeasurementUnits(array $c, array $mu = [])
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/measurementUnits/insert/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [

			'company_id' => $c['company_id'],
			'name' => $mu['name'],// string required
			'short_name' => $mu['short_name'],// string required
		]);

		return $response;
	}

	/**
	* Update Measurement Units in the Company 
	* @param array $mu Measurement Units
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=268
	**/
	public function updateMeasurementUnits(array $c, array $mu = [])
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/measurementUnits/update/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
			'unit_id' => 0,// int required $this->getgetMeasurementUnits()
			'name' => $mu['name'],// string required
			'short_name' => $mu['short_name'],// string required
		]);

		return $response;
	}

	/**
	* Delete Measurement Units in the Company 
	* @param int $unit_id Measurement Unit sid
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=269
	**/
	public function deleteMeasurementUnits(array $c, int $unit_id)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/measurementUnits/delete/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
			'unit_id' => 0,// int required $this->getgetMeasurementUnits()
		]);

		return $response;
	}

}