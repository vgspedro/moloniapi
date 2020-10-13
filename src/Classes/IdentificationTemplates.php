<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the IdentificationTemplates requests
*/

class IdentificationTemplates extends Authentication{

	/** @const entity api url */
	const ENTITY = '/identificationTemplates/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	IdentificationTemplates array data structure

    $identification_templates = [
        template_id => 0, //int required ON UPDATE only
        name => 'User name', // string required
        business_name => 'the company', //string required
        email => 'user email', //string required
        address => 'Fiscal address', //string required
        city => 'City', // string required
        zip_code => '0000-000', // string required
        country_id => 1, //int required get it from $moloni->getCountries()
        phone => '', // string
        fax => '', // string
        website => '', //string 
        notes => '', //string
        documents_footnote => '', //string
        email_sender_name => 'One name ', //string required
        email_sender_address => 'One address', // string required
    ];*/

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

    private $business_name;

    public function getBusinessName()
    {
        return $this->business_name;
    }

    public function setBusinessName(string $business_name = null)
    {
        $this->business_name = $business_name;
    }

    private $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email = null)
    {
        $this->email = $email;
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

    private $city;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(string $city = null)
    {
        $this->city = $city;
    }

    private $zip_code;

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code = null)
    {
        $this->zip_code = $zip_code;
    }

    private $country_id;

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function setCountryId(int $country_id = 0)
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

    private $website;

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite(string $website = null)
    {
        $this->website = $website;
    }

    private $notes;

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes(string $notes = null)
    {
        $this->notes = $notes;
    }

    private $documents_footnote;

    public function getDocumentsFootnote()
    {
        return $this->documents_footnote;
    }

    public function setDocumentsFootnote(string $documents_footnote = null)
    {
        $this->documents_footnote = $documents_footnote;
    }

    private $email_sender_name;

    public function getEmailSenderName()
    {
        return $this->email_sender_name;
    }

    public function setEmailSenderName(string $email_sender_name = null)
    {
        $this->email_sender_name = $email_sender_name;
    }

    private $email_sender_address;

    public function getEmailSenderAddress()
    {
        return $this->email_sender_address;
    }

    public function setEmailSenderAddress(string $email_sender_address = null)
    {
        $this->email_sender_address = $email_sender_address;
    }

	/**
	* List IdentificationTemplates of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=270
	**/
	public function getAll()
	{
		return parent::curl(parent::getPath('getAll'), [
            'company_id' => parent::getCompanyId()
        ]);
	}

	/**
	* Create IdentificationTemplates in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=271
	**/
	public function insert()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName(),
			'business_name' => $this->getBusinessName(),
            'email' => $this->getEmail(),
            'address' => $this->getAddress(),
            'city' => $this->getCity(),
            'zip_code' => $this->getZipCode(),
            'country_id' => $this->getCountryId(),
            'phone' => $this->getPhone(),
            'fax' => $this->getFax(),
            'website' => $this->getWebsite(),
            'notes' => $this->getNotes(),
            'documents_footnote' => $this->getDocumentsFootnote(),
            'email_sender_name' => $this->getEmailSenderName(),
            'email_sender_address' => $this->getEmailSenderAddress()
		]);

	}

	/**
	* Update IdentificationTemplates by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=272
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
			'template_id' => $this->getId(),
			'name' => $this->getName(), 
			'business_name' => $this->getBusinessName(),
            'email' => $this->getEmail(),
            'address' => $this->getAddress(),
            'city' => $this->getCity(),
            'zip_code' => $this->getZipCode(),
            'country_id' => $this->getCountryId(),
            'phone' => $this->getPhone(),
            'fax' => $this->getFax(),
            'website' => $this->getWebsite(),
            'notes' => $this->getNotes(),
            'documents_footnote' => $this->getDocumentsFootnote(),
            'email_sender_name' => $this->getEmailSenderName(),
            'email_sender_address' => $this->getEmailSenderAddress()
		]);
	}

	/**
	* Delete a IdentificationTemplates from the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=273
	**/
	public function delete()
	{
		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'template_id' => $this->getId()
		]);
	}

}