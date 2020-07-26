<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class which Reads the Global Data information from Moloni
 */

class GlobalData extends Authentication{

    private $country_id;

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function setCountryId(int $country_id = 0)
    {
        $this->country_id = $country_id;
    }

	/** @const access api url */
	const ACCESS = '/getAll/?access_token=';
	/**
	
	* List Countries available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=68
	**/
	public function getCountries()
	{
		$url = parent::getUrl().'/countries'.static::ACCESS.''.parent::getAccessToken();
		return parent::curl($url);
	}

	/**
	* List Languages available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=70
	**/
	public function getLanguages()
	{
		$url = parent::getUrl().'/languages'.static::ACCESS.''.parent::getAccessToken();
		return parent::curl($url);
	}

	/**
	* List Currencies available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=101
	**/
	public function getCurrencies()
	{
		$url = parent::getUrl().'/currencies'.static::ACCESS.''.parent::getAccessToken();
		return parent::curl($url);
	}

	/**
	* Get list of Fiscal Zones available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=69
	**/
	public function getFiscalZones()
	{
		$url = parent::getUrl().'/fiscalZones'.static::ACCESS.''.parent::getAccessToken();
		return parent::curl($url, ['country_id' => $this->getCountryId()]);
	}

}