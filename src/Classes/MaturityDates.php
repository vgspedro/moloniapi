<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the MaturityDates requests
 */

class MaturityDates extends Authentication{

	/** @const entity api url */
	const ENTITY = '/maturityDates/';
	/** @const access api url */
	const ACCESS = '/?access_token=';


	/**
	MaturityDates array data structure

    $md = [
        'maturity_date_id' => 0, //int required ON UPDATE only $this->getMaturityDates()
        'name' => 'string',  //string required
        'days' => 15,  //int required
        'associated_discount' => 0.0 // float required
    ];

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

    private $days;

    public function getDays()
    {
        return $this->days;
    }

    public function setDays(int $days = 0)
    {
        $this->days = $days;
    }

    private $associated_discount;

    public function getAssociatedDiscount()
    {
        return $this->associated_discount;
    }

    public function setAssociatedDiscount(float $associated_discount = 0.0)
    {
        $this->associated_discount = $associated_discount;
    }
	
	/**
	* List MaturityDates in the Company 
	* @return json 
	**/
	public function getMaturityDates()
	{
		$url = parent::getUrl().''.static::ENTITY.'getAll'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, ['company_id' => parent::getCompanyId()]);
	}

	/**
	* Update PaymentMethods by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=242
	**/
	public function updateMaturityDates()
	{
		$url = parent::getUrl().''.static::ENTITY.'update'.static::ACCESS.''.parent::getAccessToken();
		
		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'maturity_date_id' => $this->getId(), //int required  
			'name' => $this->getName(),  //string required
			'days' => $this->getDays(),  //int required
			'associated_discount' => $this->getAssociatedDiscount() // float required
		]);
	}

	/**
	* Delete Maturity Dates from the Company 
	* @param int $maturity_dates_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=243
	**/
	public function deleteMaturityDates()
	{
		$url = parent::getUrl().''.static::ENTITY.'delete'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'maturity_date_id' => $this->getId()
		]);
	}

	/**
	* Update MaturityDates by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=241
	**/
	public function setMaturityDates()
	{
		$url = parent::getUrl().''.static::ENTITY.'insert'.static::ACCESS.''.parent::getAccessToken();
		
		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName(),  //string required
			'days' => $this->getDays(),  //int required
			'associated_discount' => $this->getAssociatedDiscount() // float required
		]);
	}

}