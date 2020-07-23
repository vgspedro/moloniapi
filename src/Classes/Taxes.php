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

	/** @var int id*/
	private $id;

	/** @var array $c*/
	private $c;

	/**
	 * Sets id
	 *
	 * @param int id
	 *
	 * @return \Classes\Taxes
	 */
	public function setId(int $id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * Gets tax id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	public function setCredencials(array $c) {
		$this->c = $c;
		return $this;
	}

	/**
	 * Gets tax id
	 *
	 * @return int
	 */
	public function getCredencials() {
		return $this->$c;
	}


	/**
	* Delete a Tax from the Company 
	* @param int $tax_id // $this->getTaxes($c) required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=265
	**/
	public function deleteTestTax()
	{
		$url = $this->getCredencials()['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$this->getCredencials()['token']['access_token'];
		return parent::curl($url, ['company_id' => $this->getCredencials()['company_id'], 'tax_id' => $this->getId()]);
	}


	/**
	* List Taxes of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=262
	**/
	public function getTaxes(array $c = [])
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id']]);
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
		
		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
			'name' => $t['name'], 
			'value' => $t['value'],
			'type' => $t['type'],
			'saft_type' => $t['saft_type'],
			'vat_type' => $t['vat_type'],
			'stamp_tax' => $t['stamp_tax'],
			'exemption_reason' => $t['exemption_reason'],
			'fiscal_zone' => $t['fiscal_zone'], //$moloni->getFiscalZones($id)
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

		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
			'tax_id' => 1999147,
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
	
		return $this->curl($url, ['company_id' => $c['company_id'], 'tax_id' => $tax_id]);
	}

}