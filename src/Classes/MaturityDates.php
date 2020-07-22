<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the MaturityDates requests
 */

class MaturityDates extends Authentication{
/**
	* Get list of MaturityDates in the Company 
	* @return json 
	**/
	public function getMaturityDates(array $c)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/maturityDates/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, ['company_id' => $c['company_id']]);

		return $response;
	}

	/**
	* Update PaymentMethods by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=242
	**/
	public function updateMaturityDates(array $md = [])
	{
		$m = new Moloni();
		return $m->updateMaturityDates($this->credencials, $md);
	}

	/**
	* Delete Maturity Dates from the Company 
	* @param int $maturity_dates_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=243
	**/
	public function deleteMaturityDates(int $maturity_dates_id = 0)
	{
		$m = new Moloni();
		return $m->deleteMaturityDates($this->credencials, $maturity_dates_id);
	}

	/**
	* Update MaturityDates by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=241
	**/
	public function setMaturityDates(array $md = [])
	{
		$m = new Moloni();
		return $m->setMaturityDates($this->credencials, $md);
	}

}