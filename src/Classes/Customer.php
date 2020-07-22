<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class for CRUD the Customer requests
 */

class Customer extends Authentication{

	/** @const entity api url */
	const ENTITY = '/customers/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	* Get all Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomerCount(array $c = []){	

		$url = $c['url'].''.static::ENTITY.'count'.static::ACCESS.''.$c['token']['access_token'];	
		return $this->curl($url);
	}

	/**
	* Create a new Customer in the Company 
	* @param array $a Customer information 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=204
	**/
	public function setCustomer(array $c = [], array $a = [])
	{

		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];	

		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
			'vat' => $a['vat'], //NIPC
			'number' => $a['cid'], //SNC
			'language_id' => $a['language_id'],
			'name' => $a['name'],
			'address' => $a['address'],
			'city' => $a['city'],
			'zip_code' => $a['zip_code'], //if country_id = 1 then 0000-000
			'discount' => $a['discount'],
			'credit_limit' => $a['credit_limit'],
			'payment_day' => $a['payment_day'],
			'country_id' => $a['country_fiscal_id'],
			'maturity_date_id' => $a['maturity_date_id'], 
			'qty_copies_document' => $a['qty_copies_document'],
			'payment_method_id' => $a['payment_method_id'],
			'copies'=> [
				'document_type_id' => $a['copies']['document_type_id'],
				'copies' => $a['copies']['copies'],
			],
			'delivery_method_id' => $a['delivery_method_id'],
			'salesman_id' => $a['salesman_id']
		]);

		return $response;
	}

	/**
	* Get Customer by Id
	* @param int $id Customer Id // $this->getCustomerByVat(string $vat)
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getCustomerById(array $c = [], int $id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getOne'.static::ACCESS.''.$c['token']['access_token'];	

		$response = $this->curl($url, ['company_id' => $c['company_id'], 'customer_id' => $id]);

		return $response;
	}

	/**
	* Get Customer by Vat
	* @param string $vat Customer Vat // '123456789'
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=201
	**/
	public function getCustomerByVat(array $c = [], string $vat = null)
	{
		$url = $c['url'].''.static::ENTITY.'getByVat'.static::ACCESS.''.$c['token']['access_token'];

		$response = $this->curl($url, ['company_id' => $c['company_id'], 'vat' => $vat]);

		return $response;
	}

	/**
	* Update Customer by Id
	* @param array $a Customer information //test set customer_id =  30259661
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=205
	**/
	public function updateCustomerById(array $c = [], array $a = [])
	{
		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];	

		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
			'customer_id' => 30259661,
			'vat' => $a['vat'], //NIPC
			'number' => $a['cid'], //SNC
			'language_id' => $a['language_id'], //1=>PT, 2=>EN, 3=>ES
			'name' => $a['name'],
			'address' => $a['address'],
			'city' => $a['city'],
			'zip_code' => $a['zip_code'], //if country_id = 1 then 0000-000
			'discount' => $a['discount'],
			'credit_limit' => $a['credit_limit'],
			'payment_day' => $a['payment_day'],
			'country_id' => $a['country_fiscal_id'],
			'maturity_date_id' => $a['maturity_date_id'], //18253 PP || 18252 30d || 18254 60d || 18255 90d
			'qty_copies_document' => $a['qty_copies_document'],
			'payment_method_id' => $a['payment_method_id'], //17236 cash || xxxx paypal
			'copies'=> [
				'document_type_id' => $a['copies']['document_type_id'],
				'copies' => $a['copies']['copies'],
			],
			'delivery_method_id' => $a['delivery_method_id'],
			'salesman_id' => $a['salesman_id']
		]);

		return $response;
	}

}