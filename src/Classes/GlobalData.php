<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which Reads the Global Data information from Moloni
 */

class GlobalData extends Authentication{

	/** @const access api url */
	const ACCESS = '/getAll/?access_token=';

	/**
	* List Countries available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=68
	**/
	public function getCountries(array $c)
	{

		$url = $c['url'].'/countries'.static::ACCESS.''.$c['token']['access_token'];
		$response = $this->curl($url);

		return $response;
	}

	/**
	* List Languages available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=70
	**/
	public function getLanguages(array $c)
	{

		$url = $c['url'].'/languages'.static::ACCESS.''.$c['token']['access_token'];
		$response = $this->curl($url);

		return $response;
	}

	/**
	* List Currencies available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=101
	**/
	public function getCurrencies(array $c)
	{

		$url = $c['url'].'/currencies'.static::ACCESS.''.$c['token']['access_token'];
		$response = $this->curl($url);

		return $response;
	}

	/**
	* Get list of Fiscal Zones available in Moloni
	* @param int $id country_id  // $this->getCountries()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=69
	**/
	public function getFiscalZones(array $c, int $id)
	{

		$url = $c['url'].'/fiscalZones'.static::ACCESS.''.$c['token']['access_token'];
		$response = $this->curl($url,['country_id' => $id]);

		return $response;
	}

}