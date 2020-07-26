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

	private $active_by_default;

    public function getActiveByDefault()
    {
        return $this->active_by_default;
    }

    public function setActiveByDefault(int $active_by_default = 0)
    {
        $this->active_by_default = $active_by_default;
    }


	private $fiscal_zone;

    public function getFiscalZone()
    {
        return $this->fiscal_zone;
    }

    public function setFiscalZone(string $fiscal_zone = null)
    {
        $this->fiscal_zone = $fiscal_zone;
    }


	private $exemption_reason;

    public function getExemptionReason()
    {
        return $this->exemption_reason;
    }

    public function setExemptionReason(string $exemption_reason = null)
    {
        $this->exemption_reason = $exemption_reason;
    }

	private $type;

    public function getType()
    {
        return $this->type;
    }

    public function setType(int $type = 0)
    {
        $this->type = $type;
    }

	private $saft_type;

    public function getSaftType()
    {
        return $this->saft_type;
    }

    public function setSaftType(int $saft_type = 0)
    {
        $this->saft_type = $saft_type;
    }

	private $vat_type;

    public function getVatType()
    {
        return $this->vat_type;
    }

    public function setVatType(int $vat_type = 0)
    {
        $this->vat_type = $vat_type;
    }

	private $stamp_tax;

    public function getStampTax()
    {
        return $this->stamp_tax;
    }

    public function setStampTax(string $stamp_tax = null)
    {
        $this->stamp_tax = $stamp_tax;
    }

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
	* List Taxes of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=262
	**/
	public function getTaxes()
	{
		return parent::curl(parent::getPath('getAll'), ['company_id' => parent::getCompanyId()]);
	}

	/**
	* Create Tax in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=263
	**/
	public function setTax()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName(), 
			'value' => $this->getValue(),
			'type' => $this->getType(),
			'saft_type' => $this->getSaftType(),
			'vat_type' => $this->getVatType(),
			'stamp_tax' => $this->getStampTax(),
			'exemption_reason' => $this->getExemptionReason(),
			'fiscal_zone' => $this->getFiscalZone(),
			'active_by_default' => $this->getActiveByDefault()
		]);

	}

	/**
	* Update Tax by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=264
	**/
	public function updateTax()
	{
	
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
			'tax_id' => $this->getId(),
			'name' => $this->getName(), 
			'value' => $this->getValue(),
			'type' => $this->getType(),
			'saft_type' => $this->getSaftType(),
			'vat_type' => $this->getVatType(),
			'stamp_tax' => $this->getStampTax(),
			'exemption_reason' => $this->getExemptionReason(),
			'fiscal_zone' => $this->getFiscalZone(),
			'active_by_default' => $this->getActiveByDefault()
		]);

	}

	/**
	* Delete a Tax from the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=265
	**/
	public function deleteTax()
	{

		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'tax_id' => $this->getId()
		]);
	}

}