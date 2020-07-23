<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the Taxes requests
*/

class Taxes extends Authentication{

	/** @const entity api url */
	const ENTITY = '/taxes/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	Taxes array data structure

    $tax = [
    	'tax_id' => 0, //int required ON UPDATE only $this->getTaxes()
        'name' => 'Tx.Iva Intermédia 13', //string required
        'value' => 13, // int required
        'type' => 1, // int required
        'saft_type' => 1, //int required
        'vat_type' => 'OUT', // string required ["RED","INT","NOR","ISE","OUT"]"
        'stamp_tax' => '', //string required
        'exemption_reason' => '', // string required
        'fiscal_zone' => 'PT', // string required get it from $moloni->getFiscalZones($id)
        'active_by_default' => 0 // int required
    ];

	*/

	/**
	* List Taxes of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=262
	**/
	public function getTaxes(array $c = [])
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, ['company_id' => $c['company_id']]);
	}

	/**
	* Create Tax in the Company 
	* @param array $t Tax // This->getTaxes($c) required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=263
	**/
	public function setTax(array $c = [], array $t = [])
	{
		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];
		
		$response =  parent::curl($url, [
			'company_id' => $c['company_id'],
			'name' => $t['name'], 
			'value' => $t['value'],
			'type' => $t['type'],
			'saft_type' => $t['saft_type'],
			'vat_type' => $t['vat_type'],
			'stamp_tax' => $t['stamp_tax'],
			'exemption_reason' => $t['exemption_reason'],
			'fiscal_zone' => $t['fiscal_zone'],
			'active_by_default' => $t['active_by_default']
		]);

		return $response;
	}

	/**
	* Update Tax by Id
	* @param array $t Tax information // $this->getTaxes($c) required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=264
	**/
	public function updateTax(array $c = [], array $t = [])
	{

		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];

		$response =  parent::curl($url, [
			'company_id' => $c['company_id'],
			'tax_id' => $t['tax_id'],
			'name' => $t['name'], 
			'value' => $t['value'],
			'type' => $t['type'],
			'saft_type' => $t['saft_type'],
			'vat_type' => $t['vat_type'],
			'stamp_tax' => $t['stamp_tax'],
			'exemption_reason' => $t['exemption_reason'],
			'fiscal_zone' => $t['fiscal_zone'], //$this->getFiscalZones($id)
			'active_by_default' => $t['active_by_default']
		]);

		return $response;
	}

	/**
	* Delete a Tax from the Company 
	* @param int $tax_id // $this->getTaxes($c) required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=265
	**/
	public function deleteTax(array $c = [], int $tax_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];
		return  parent::curl($url, ['company_id' => $c['company_id'], 'tax_id' => $tax_id]);
	}

}