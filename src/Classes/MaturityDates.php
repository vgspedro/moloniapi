<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the MaturityDates requests
 */

class MaturityDates extends Authentication{

	/** @const entity api url */
	const ENTITY = '/maturityDates/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	* List MaturityDates in the Company 
	* @return json 
	**/
	public function getMaturityDates(array $c = [])
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id']]);
	}

	/**
	* Update PaymentMethods by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=242
	**/
	public function updateMaturityDates(array $c = [], array $md = [])
	{

		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id']]);
	}

	/**
	* Delete Maturity Dates from the Company 
	* @param int $maturity_dates_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=243
	**/
	public function deleteMaturityDates(array $c = [], int $maturity_dates_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id'], 'maturity_dates_id' => $maturity_dates_id]);
	}

	/**
	* Update MaturityDates by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=241
	**/
	public function setMaturityDates(array $c = [],array $md = [])
	{
		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id']]);
	}

}