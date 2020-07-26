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

		$url = parent::getUrl().''.static::ENTITY.'count'.static::ACCESS.''.parent::getAccessToken();

		return  parent::curl($url, ['company_id' => parent::getCompanyId()]);
	}
	
	/**
	* List Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomers(array $c = []){	

		$url = parent::getUrl().''.static::ENTITY.'getAll'.static::ACCESS.''.parent::getAccessToken();

		return  parent::curl($url, ['company_id' => parent::getCompanyId()]); 
	}

	/**
	* Create a new Customer in the Company 
	* @param array $a Customer information 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=204
	**/
	public function setCustomer(array $c = [], array $a = [])
	{

		$url = parent::getUrl().''.static::ENTITY.'insert'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'vat' => $a['vat'], 
			'number' => $a['number'],
			'name' => $a['name'],
			'language_id' => $a['language_id'],
			'address' => $a['address'],
			'zip_code' => $a['zip_code'],
			'city' => $a['city'],
			'country_id' => $a['country_id'],
			'email' => $a['email'],
			'website' => $a['website'],
			'phone' => $a['phone'],
			'fax' => $a['fax'],
			'contact_name' => $a['contact_name'],
			'contact_email' => $a['contact_email'],
			'contact_phone' => $a['contact_phone'],
			'notes' => $a['notes'],
			'salesman_id' => $a['salesman_id'], // int
			'price_class_id' => $a['price_class_id'] ,
			'maturity_date_id' => $a['maturity_date_id'],
			'payment_day' => $a['payment_day'], 
			'discount' => $a['discount'],
			'credit_limit' => $a['credit_limit'],
			'copies'=> [
				'document_type_id' => $a['copies']['document_type_id'],
				'copies' => $a['copies']['copies']
			],
			'payment_method_id' => $a['payment_method_id'],
			'delivery_method_id' => $a['delivery_method_id'],
			'field_notes' => $a['field_notes']
		]);
	}

	/**
	* Get Customer by Id
	* @param int $id Customer Id // $this->getCustomers()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getCustomerById(array $c = [], int $id = 0)
	{
		$url = parent::getUrl().''.static::ENTITY.'getOne'.static::ACCESS.''.parent::getAccessToken();	

		return  parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $id
		]);
	}

	/**
	* Get Customer by Vat
	* @param string $vat Customer Vat // '123456789'
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=201
	**/
	public function getCustomerByVat(array $c = [], string $vat = null)
	{
		$url = parent::getUrl().''.static::ENTITY.'getByVat'.static::ACCESS.''.parent::getAccessToken();

		return  parent::curl($url, ['company_id' => parent::getCompanyId(), 'vat' => $vat]);
	}

	/**
	* Update Customer by Id
	* @param array $a Customer information //test set customer_id =  30259661
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=205
	**/
	public function updateCustomerById(array $c = [], array $a = [])
	{
		$url = parent::getUrl().''.static::ENTITY.'update'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $a['customer_id'], // int required ON UPDATE only $this->getCustomers()
			'vat' => $a['vat'],
			'number' => $a['number'],
			'name' => $a['name'],
			'language_id' => $a['language_id'],
			'address' => $a['address'],
			'zip_code' => $a['zip_code'],
			'city' => $a['city'],
			'country_id' => $a['country_id'],
			'email' => $a['email'],
			'website' => $a['website'],
			'phone' => $a['phone'],
			'fax' => $a['fax'],
			'contact_name' => $a['contact_name'],
			'contact_email' => $a['contact_email'],
			'contact_phone' => $a['contact_phone'],
			'notes' => $a['notes'],
			'salesman_id' => $a['salesman_id'], // int
			'price_class_id' => $a['price_class_id'] ,
			'maturity_date_id' => $a['maturity_date_id'],
			'payment_day' => $a['payment_day'], 
			'discount' => $a['discount'],
			'credit_limit' => $a['credit_limit'],
			'copies'=> [
				'document_type_id' => $a['copies']['document_type_id'],
				'copies' => $a['copies']['copies']
			],
			'payment_method_id' => $a['payment_method_id'],
			'delivery_method_id' => $a['delivery_method_id'],
			'field_notes' => $a['field_notes']
		]);

	}


	/**
	* Delete Customer by Id
	* @param int $id Customer Id // $this->getCustomers()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=206
	**/
	public function deleteCustomer(array $c = [], int $id = 0)
	{
		$url = parent::getUrl().''.static::ENTITY.'delete'.static::ACCESS.''.parent::getAccessToken();
		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $id
		]);
	}

}