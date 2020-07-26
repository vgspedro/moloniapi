<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class for CRUD the MeasurementUnits requests
 */

class MeasurementUnits extends Authentication{

	/** @const entity api url */
	const ENTITY = '/measurementUnits/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	MeasurementUnits array data structure

    $mu = [
    	'unit_id' => 0,// int required ON UPDATE only $this->getMeasurementUnits()
		'name' => 'name of unit EX Metters',// string required
		'short_name' => 'mt',// string required
    ];
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

    private $short_name;

    public function getShortName()
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name = null)
    {
        $this->short_name = $short_name;
    }

	/**
	* List of Measurement Units in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=266
	**/
	public function getMeasurementUnits()
	{
		$url = parent::getUrl().''.static::ENTITY.'getAll'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, ['company_id' => parent::getCompanyId() ]);
	}

	/**
	* Create Measurement Units in the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=267
	**/
	public function setMeasurementUnits()
	{
		$url = parent::getUrl().''.static::ENTITY.'insert'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName(),// string required
			'short_name' => $this->getShortName()// string required
		]);

	}

	/**
	* Update Measurement Units in the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=268
	**/
	public function updateMeasurementUnits()
	{
		$url = parent::getUrl().''.static::ENTITY.'update'.static::ACCESS.''.parent::getAccessToken();
		
		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'unit_id' => $this->getId(),// int required $this->getMeasurementUnits()
			'name' => $this->getName(),// string required
			'short_name' => $this->getShortName()// string required
		]);

	}

	/**
	* Delete Measurement Units in the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=269
	**/
	public function deleteMeasurementUnits()
	{
		$url = parent::getUrl().''.static::ENTITY.'delete'.static::ACCESS.''.parent::getAccessToken();

		return parent::curl($url, [
			'company_id' => parent::getCompanyId(),
			'unit_id' => $this->getId()
		]);
	}

}


