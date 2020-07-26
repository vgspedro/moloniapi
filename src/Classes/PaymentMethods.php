<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class for CRUD the Payment Methods requests
 */

class PaymentMethods extends Authentication{

	/** @const entity api url */
	const ENTITY = '/paymentMethods/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/** PaymentMethods array data structure
	$pm = [
		'payment_method_id' => 0,//int required ON UPDATE only $this->getPaymentMethods()
		'name' => 'payment name', //string required
		'is_numeric' => 0, // int
	]
	**/

	private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id = 0)
    {
        $this->id = $id;
    }

    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    private $is_numeric;

    public function getIsNumeric()
    {
        return $this->is_numeric;
    }

    public function setIsNumeric(int $is_numeric = 0)
    {
        $this->is_numeric = $is_numeric;
    }


	/**
	* List Payment Methods of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=236
	**/
	public function getPaymentMethods()
	{
		$url = parent::getUrl().''.static::ENTITY.'getAll'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, ['company_id' => parent::getCompanyId() ]);
	}

	/**
	* Create Payment Methods
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function setPaymentMethods()
	{
		$url = parent::getUrl().''.static::ENTITY.'insert'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url,[
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName(),
			'is_numeric' => $this->getIsMumeric()
		]);
	}

	/**
	* Delete Payment Methods from the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=239
	**/
	public function deletePaymentMethods()
	{
		$url = parent::getUrl().''.static::ENTITY.'delete'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url,[
			'company_id' => parent::getCompanyId(),
			'payment_method_id' => $this->getId()
		]);
	}

	/**
	* Update PaymentMethods by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function updatePaymentMethods()
	{
		$url = parent::getUrl().''.static::ENTITY.'update'.static::ACCESS.''.parent::getAccessToken();
	
		return parent::curl($url,[
			'company_id' => parent::getCompanyId(),
			'payment_method_id' => $this->getId(),
			'name' => $this->getName(),
			'is_numeric' => $this->getIsMumeric()
		]);
	}

}