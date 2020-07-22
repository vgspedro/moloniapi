<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
* A class which CRUD the Taxes requests
*/

class DeliveryMethods extends Authentication{

	/** @const entity api url */
	const ENTITY = '/deliveryMethods/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	* List Delivery Methods in the Company 
	* @return json 
	**/
	public function getDeliveryMethods(array $c = [])
	{
		
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id']]);
	}

	/**
	* Update Delivery Methods by Id
	* @param array $dm Delivery Methods // $this->getDeliveryMethods() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=251
	**/
	public function updateDeliveryMethods(array $c = [], array $dm = [])
	{
		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id']]);
	}


	/**
	* Delete Delivery Methods from the Company 
	* @param int $delivery_methods_id // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=252
	**/
	public function deleteDeliveryMethods(int $delivery_methods_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id'], 'delivery_methods_id' => $delivery_methods_id]);
	}

	/**
	* Create Delivery Methods by Id
	* @param array $dm Delivery Methods // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=250
	**/
	public function setDeliveryMethods(array $dm = [])
	{
		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id']]);
	}


}