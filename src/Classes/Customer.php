<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class for CRUD the Customer requests
 */

class Customer extends Authentication{

	/** @const entity api url */
	const ENTITY = '/customers/';
	/** @const access api url */
	const ACCESS = '/?access_token=';
	
	/**
	Customer array data structure
	$a = [
		'customer_id' => 0, // int required ON UPDATE only $this->getCustomers()
		'vat' => '100200300', //string required NIPC 
		'number' => 'our client reference', // string (max 20) required SNC
		'name' => 'Name of fiscal number owner', //string required
		'language_id' => 1, // int required 1=>PT, 2=>EN, 3=>ES
		'address' => 'Fiscal Address', // string required
		'zip_code' => 'Fiscal zip code', // string if country_id = 1 then 0000-000
		'city' => 'Fiscal City', //string required
		'country_id' =>  0, // int required GlobalData->getCountries()
		'email' => '',// string
		'website' => '',// string
		'phone' => '',// string
		'fax' => '',// string
		'contact_name' => '',// string
		'contact_email' => '',// string
		'contact_phone' => '',// string
		'notes' => '',// string
		'salesman_id' => 0, // int
		'price_class_id' => 0 , // int
		'maturity_date_id' => 0, // int required MaturityDates->getMaturityDates()
		'payment_day' => 0, // int
		'discount' => 0.0, // float
		'credit_limit' => 0.0, // float,
		'copies'=> [
			'document_type_id' => 0, // int required DocumentType->getDocumentType()
			'copies' => 3, // int required
		],
		'payment_method_id' =>  0, // int required PaymentMethod->getPaymentMethod()
		'delivery_method_id' => 0, // int,
		'field_notes' => '',// string
	]
	**/


	/**
	* Count all Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomerCount(array $c = []){	

		$url = $c['url'].''.static::ENTITY.'count'.static::ACCESS.''.$c['token']['access_token'];	
		return  parent::curl($url, ['company_id' => $c['company_id']]);
	}
	
	/**
	* List Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomers(array $c = []){	

		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];	
		return  parent::curl($url, ['company_id' => $c['company_id']]); 
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

		$response = parent::curl($url, [
			'company_id' => $c['company_id'],
			'vat' => $a['vat'], 
			'number' => $a['number'],
			'name' => $a['name'],
			'language_id' => $a['language_id'],
			'address' => $a['address'],
			'zip_code' => $a['zip_code'],
			'city' => $a['city'],
			'country_id' => $a['country_fiscal_id'],
			'email' => '',
			'website' => '',
			'phone' => '',
			'fax' => '',
			'contact_name' => '',
			'contact_email' => '',
			'contact_phone' => '',
			'notes' => '',
			'salesman_id' => $a['salesman_id'], // int
			'price_class_id' => 0 ,
			'maturity_date_id' => 0,
			'payment_day' => 0, 
			'discount' => 0.0,
			'credit_limit' => 0.0,
			'copies'=> [
				'document_type_id' => 0,
				'copies' => 3,
			],
			'payment_method_id' => 0,
			'delivery_method_id' => 0,
			'field_notes' => ''
		]);

		return $response;
	}

	/**
	* Get Customer by Id
	* @param int $id Customer Id // $this->getCustomers()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getCustomerById(array $c = [], int $id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getOne'.static::ACCESS.''.$c['token']['access_token'];	
		return  parent::curl($url, ['company_id' => $c['company_id'], 'customer_id' => $id]);
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
		return  parent::curl($url, ['company_id' => $c['company_id'], 'vat' => $vat]);
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

		$response =  parent::curl($url, [
			'company_id' => $c['company_id'],
			'customer_id' => $a['customer_id'], // int required ON UPDATE only $this->getCustomers()
			'vat' => $a['vat'], //string required NIPC 
			'number' => $a['number'], // string (max 20) required SNC
			'name' => $a['name'], //string required
			'language_id' => $a['language_id'], // int required 1=>PT, 2=>EN, 3=>ES
			'address' => $a['address'], // string required
			'zip_code' => $a['zip_code'], // string if country_id = 1 then 0000-000
			'city' => $a['city'], //string required
			'country_id' => $a['country_fiscal_id'], // GlobalData->getCountries()
			'email' => '',// string
			'website' => '',// string
			'phone' => '',// string
			'fax' => '',// string
			'contact_name' => '',// string
			'contact_email' => '',// string
			'contact_phone' => '',// string
			'notes' => '',// string
			'salesman_id' => $a['salesman_id'], // int
			'price_class_id' => 0 , // int
			'maturity_date_id' => 0, // int required $moloni->getMaturityDates()
			'payment_day' => 0, // int
			'discount' => 0.0, // float
			'credit_limit' => 0.0, // float,
			'copies'=> [
				'document_type_id' => 0, // int required $moloni->getDocumentType()
				'copies' => 3, // int required
			],
			'payment_method_id' =>  0, // int required $moloni->getPaymentMethod()
			'delivery_method_id' => 0, // int,
			'field_notes' => '',// string
		]);

		return $response;
	}


	/**
	* Delete Customer by Id
	* @param int $id Customer Id // $this->getCustomers()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=206
	**/
	public function deleteCustomer(array $c = [], int $id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];	
		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'customer_id' => $id
		]);
	}

}