<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class for CRUD the MeasurementUnits requests
 */

class MeasurementUnits extends Authentication{

	/** @const entity api url */
	const ENTITY = '/measurementUnits/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	MeasurementUnits array data structure

    $mu = [
    	'unit_id' => 0,// int required ON UPDATE only $this->getMeasurementUnits()
		'name' => 'name of unit EX Metters',// string required
		'short_name' => 'mt',// string required
    ];

	*/

	/**
	* List of Measurement Units in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=266
	**/
	public function getMeasurementUnits(array $c = [])
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, ['company_id' => $c['company_id']]);
	}

	/**
	* Create Measurement Units in the Company 
	* @param array $mu Measurement Units
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=267
	**/
	public function setMeasurementUnits(array $c = [], array $mu = [])
	{
		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];

		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'name' => $mu['name'],// string required
			'short_name' => $mu['short_name'],// string required
		]);

	}

	/**
	* Update Measurement Units in the Company 
	* @param array $mu Measurement Units
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=268
	**/
	public function updateMeasurementUnits(array $c = [], array $mu = [])
	{
		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];
		
		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'unit_id' => $mu['unit_id'],// int required $this->getMeasurementUnits()
			'name' => $mu['name'],// string required
			'short_name' => $mu['short_name'],// string required
		]);

	}

	/**
	* Delete Measurement Units in the Company 
	* @param int $unit_id Measurement Unit sid
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=269
	**/
	public function deleteMeasurementUnits(array $c = [], int $unit_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];

		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'unit_id' => $unit_id,
		]);
	}

}


