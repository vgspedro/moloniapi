<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class for CRUD the Warehouses requests
 */

class Warehouses  extends Authentication{

	/** @const entity api url */
	const ENTITY = '/warehouses/';
	/** @const access api url */
	const ACCESS = '/?access_token=';
	
	/**
	Warehouses array data structure
	[
		'warehouse_id' => 0, // int required ON UPDATE only $this->getAll()
		'title' => 'Armazem x', //string required
		'is_default' => 1, //int
		'code' => 'cod', // string required,
        'address' => 'Fiscal Address', // string required
		'zip_code' => 'Fiscal zip code', // string if country_id = 1 then 0000-000
		'city' => 'Fiscal City', //string required
		'country_id' =>  0, // int required GlobalData->getCountries()
		'phone' => '',// string
		'fax' => '',// string
		'contact_name' => '',// string
		'contact_email' => '',// string
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

    private $title;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title = null)
    {
        $this->title = $title;
    }

    private $is_default;

    public function getIsDefault()
    {
        return $this->is_default;
    }

    public function setIsDefault(int $is_default = 0)
    {
        $this->is_default = $is_default;
    }

    private $code;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(string $code = null)
    {
        $this->code = $code;
    }

    private $address;

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $address = null)
    {
        $this->address = $address;
    }

    private $zip_code;

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code = '0000-000')
    {
        $this->zip_code = $zip_code;
    }

    private $city;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(string $city = null)
    {
        $this->city = $city;
    }

    private $country_id;

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function setCountryId(int $country_id = 1)
    {
        $this->country_id = $country_id;
    }

    private $phone;

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(string $phone = null)
    {
        $this->phone = $phone;
    }

    private $fax;

    public function getFax()
    {
        return $this->fax;
    }

    public function setFax(string $fax = null)
    {
        $this->fax = $fax;
    }

	private $contact_name;

    public function getContactName()
    {
        return $this->contact_name;
    }

    public function setContactName(string $contact_name = null)
    {
        $this->contact_name = $contact_name;
    }

	private $contact_email;

    public function getContactEmail()
    {
        return $this->contact_email;
    }

    public function setContactEmail(string $contact_email = null)
    {
        $this->contact_email = $contact_email;
    }


	/**
	* List Warehouses of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=496
	**/

	public function getAll()
    {
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId()
		]); 
	}

	/**
	* Create a Warehouses in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=497
	**/
	public function insert()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(),
			'title' => $this->getTitle(), 
			'is_default' => $this->getIsDefault(),
			'code' => $this->getCode(),
			'address' => $this->getAddress(),
			'zip_code' => $this->getZipCode(),
			'city' => $this->getCity(),
			'country_id' => $this->getCountryId(),
			'phone' => $this->getPhone(),
			'fax' => $this->getFax(),
			'contact_name' => $this->getContactName(),
			'contact_email' => $this->getContactEmail()
		]);
	}



	/**
	* Update Warehouses by Id
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=498
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
			'warehouse_id' => $this->getId(),
			'title' => $this->getTitle(), 
            'is_default' => $this->getIsDefault(),
            'code' => $this->getCode(),
            'address' => $this->getAddress(),
            'zip_code' => $this->getZipCode(),
            'city' => $this->getCity(),
            'country_id' => $this->getCountryId(),
            'phone' => $this->getPhone(),
            'fax' => $this->getFax(),
            'contact_name' => $this->getContactName(),
            'contact_email' => $this->getContactEmail()
        ]);
	}

	/**
	* Delete Warehouses by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=499
	**/
	public function delete()
	{
		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'warehouse_id' => $this->getId()
		]);
	}

}