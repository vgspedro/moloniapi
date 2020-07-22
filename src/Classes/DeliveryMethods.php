<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
* A class which CRUD the Taxes requests
*/

class DeliveryMethods extends Authentication{

	/**
	* Get list of Delivery Methods in the Company 
	* @return json 
	**/
	public function getDeliveryMethods(array $c)
	{

		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/deliveryMethods/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, ['company_id' => $c['company_id']]);
		return $response;
	}

	/**
	* Update Delivery Methods by Id
	* @param array $dm Delivery Methods // $this->getDeliveryMethods() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=251
	**/
	public function updateDeliveryMethods(array $dm = [])
	{
		$m = new Moloni();
		return $m->updateDeliveryMethods($this->credencials, $dm);
	}

	/**
	* Delete Delivery Methods from the Company 
	* @param int $delivery_methods_id // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=252
	**/
	public function deleteDeliveryMethods(int $delivery_methods_id = 0)
	{
		$m = new Moloni();
		return $m->deleteDeliveryMethods($this->credencials, $delivery_methods_id);
	}

	/**
	* Create Delivery Methods by Id
	* @param array $dm Delivery Methods // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=250
	**/
	public function setDeliveryMethods(array $dm = [])
	{
		$m = new Moloni();
		return $m->setDeliveryMethods($this->credencials, $dm);
	}


}