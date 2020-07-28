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

    [
        'maturity_date_id' => 0, //int required ON UPDATE only
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
	public function getAll()
	{
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId()
		]);
	}

	/**
	* Update PaymentMethods by Id
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=242
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
			'maturity_date_id' => $this->getId(), //int required  
			'name' => $this->getName(),  //string required
			'days' => $this->getDays(),  //int required
			'associated_discount' => $this->getAssociatedDiscount() // float required
		]);
	}

	/**
	* Delete Maturity Dates from the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=243
	**/
	public function delete()
	{
		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'maturity_date_id' => $this->getId()
		]);
	}

	/**
	* Update MaturityDates by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=241
	**/
	public function insert()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName(),  //string required
			'days' => $this->getDays(),  //int required
			'associated_discount' => $this->getAssociatedDiscount() // float required
		]);
	}

}