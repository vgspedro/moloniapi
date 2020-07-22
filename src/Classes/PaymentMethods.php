<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class for CRUD the Payment Methods requests
 */

class PaymentMethods extends Authentication{

	/** @const entity api url */
	const ENTITY = '/paymentMethods/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	* List Payment Methods of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=236
	**/
	public function getPaymentMethods(array $c = [])
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id']]);
	}

	/**
	* Create Payment Methods
	* @param array $pm Payment Methods
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function setPaymentMethods(array $c = [], array $pm = [])
	{

		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];
	
		$response = $this->curl($url,[
			'company_id' => $c['company_id'],
			'name' => $pm['name'], //string required
			'is_numeric' => $pm['is_numeric'] //int
		]);

		return $response;
	}

	/**
	* Delete Payment Methods from the Company 
	* @param int $payment_method_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=239
	**/
	public function deletePaymentMethods(array $c = [], int $payment_method_id = 0)
	{
	
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];

		$response = $this->curl($url,[
			'company_id' => $c['company_id'],
			'payment_method_id' => 0,//int required $this->getPaymentMethods()
		]);

		return $response;
	}

	/**
	* Update PaymentMethods by Id
	* @param array $pm PaymentMethods // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function updatePaymentMethods(array $c = [], array $pm = [])
	{
		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];
	
		$response = $this->curl($url,[
			'company_id' => $c['company_id'],
			'payment_method_id' => 0,//int required $this->getPaymentMethods()
			'name' => $pm['name'], //string required
			'is_numeric' => $pm['is_numeric'], //int
		]);

		return $response;
	}

}