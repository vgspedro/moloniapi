<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the Taxes requests
 */

class Taxes extends Authentication{

	/**
	* List Taxes of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=262
	**/
	public function getTaxes(array $c)
	{

		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/taxes/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $c['company_id']]);
		return $response;
	}

	/**
	* Create Tax in the Company 
	* @param array $t Tax // This->getTaxes($c) required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=263
	**/
	public function setTax(array $c, array $t = [])
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/taxes/insert/?access_token=".$token['data']->access_token;

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
	public function updateTax(array $t = [])
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/taxes/update/?access_token=".$token['data']->access_token;

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
	public function deleteTax(int $tax_id = 0)
	{

		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/taxes/delete/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $c['company_id'], 'tax_id' => $tax_id]);
		return $response;
	}


}