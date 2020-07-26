<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the Delivery Methods requests
*/

class DeliveryMethods extends Authentication{

	/** @const entity api url */
	const ENTITY = '/deliveryMethods/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/** DeliveryMethods array data structure
	$dm = [
		'delivery_method_id' => 0,//int required ON UPDATE only $this->getDeliveryMethods()
		'name' => 'delivery name', //string required
	]
	*/

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

	/**
	* List Delivery Methods in the Company 
	* @return json 
	**/
	public function getDeliveryMethods()
	{
		$url = parent::getUrl().''.static::ENTITY.'getAll'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, ['company_id' => parent::getCompanyId()]);
	}

	/**
	* Update Delivery Methods by Id
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=251
	**/
	public function updateDeliveryMethods()
	{
		$url = parent::getUrl().''.static::ENTITY.'update'.static::ACCESS.''.parent::getAccessToken();
	
		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName(),
			'delivery_method_id' => $this->getId()
		]);
	}

	/**
	* Delete Delivery Methods from the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=252
	**/
	public function deleteDeliveryMethods()
	{
		$url = parent::getUrl().''.static::ENTITY.'delete'.static::ACCESS.''.parent::getAccessToken();
		
		return parent::curl($url, [
			'company_id' => parent::getCompanyId(), 
			'delivery_method_id' => $this->getId()
		]);
	}

	/**
	* Create Delivery Methods by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=250
	**/
	public function setDeliveryMethods()
	{
		$url = parent::getUrl().''.static::ENTITY.'insert'.static::ACCESS.''.parent::getAccessToken();
		
		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName()
		]);
	}

}