<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which Reads the Global Data information from Moloni
 */

class GlobalData extends Authentication{

	/**
	* List Countries available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=68
	**/
	public function getCountries(array $c)
	{

		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/countries/getAll/?access_token=".$token['data']->access_token;
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

		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/languages/getAll/?access_token=".$token['data']->access_token;

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

		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/currencies/getAll/?access_token=".$token['data']->access_token;
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
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/fiscalZones/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url,['country_id' => $id]);

		return $response;
	}

}