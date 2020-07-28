<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the Documents requests
*/

class Documents extends Authentication{

	/** @const entity api url */
	const ENTITY = '/documents/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	DocumentType array data structure

    $dt = [
    	'qty' => 50, //int,
    	'offset' => 0, //int
    	'document_id' => 0, //int ONLY IN $this->getDocument()
        'customer_id' => 0, // int Customer->getCustomers()
        'supplier_id' => 0, // int Supplier->getSuppliers()
        'salesman_id' => 0, //int Salesman->getSalesmens()
        'document_set_id' => 0, // int
        'number' => 0, //int
        'date' => '', // date
        'expiration_date' => '', // date
        'year' => 0, // int
        'your_reference' => '', // string
    	'our_reference' => '' // string
    ];
	*/



    private $our_reference;

    public function getOurReference()
    {
        return $this->our_reference;
    }

    public function setOurReference(string $our_reference = null)
    {
        $this->our_reference = $our_reference;
    }

    private $your_reference;

    public function getYourReference()
    {
        return $this->your_reference;
    }

    public function setYourReference(string $your_reference = null)
    {
        $this->your_reference = $your_reference;
    }

    private $year;

    public function getYear()
    {
        return $this->year;
    }

    public function setYear(int $year = 0)
    {
        $this->year = $year;
    }

    private $expiration_date;

    public function getExpirationDate()
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(string $expiration_date = null)
    {
        $this->expiration_date = $expiration_date;
    }


    private $date;

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(string $date = null)
    {
        $this->date = $date;
    }

	private $number;

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber(int $number = 0)
    {
        $this->number = $number;
    }

	private $document_set_id;

    public function getDocumentSetId()
    {
        return $this->document_set__id;
    }

    public function setDocumentSetId(int $document_set_id = 0)
    {
        $this->document_set_id = $document_set_id;
    }


	private $salesman_id;

    public function getSalesmanId()
    {
        return $this->salesman_id;
    }

    public function setSalesman_id(int $salesman_id = 0)
    {
        $this->salesman_id = $salesman_id;
    }


	private $supplier_id;

    public function getSupplierId()
    {
        return $this->supplier_id;
    }

    public function setSupplierId(int $supplier_id = 0)
    {
        $this->supplier_id = $supplier_id;
    }


	private $customer_id;

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id = 0)
    {
        $this->customer_id = $customer_id;
    }


	private $offset;

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOffset(int $offset = 0)
    {
        $this->offset = $offset;
    }

	private $qty;

    public function getQty()
    {
        return $this->qty;
    }

    public function setQty(int $qty = 50)
    {
        $this->qty = $qty;
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


	/**
	* List All DocumentTypes 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=226
	**/
	public function getAllDocumentTypes()
	{
		return parent::curl(parent::getPath('getAllDocumentTypes'), [
			'company_id' => parent::getCompanyId(),
			'language_id' => $this->getLanguageId()
		]);
	}

	/**
	* List DocumentTypes of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=227
	**/
	public function getDocumentTypes()
	{
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId(),
			'qty' => $this->getQty(), //int,
    		'offset' => $this->getOffset(), //int
        	'customer_id' => $this->getCustomerId(), // int Customer->getCustomers()
       		'supplier_id' => $this->getSupplierId(), // int Supplier->getSuppliers()
        	'salesman' => $this->getSalesman(), //int Salesman-getSalesmens()
        	'document_set_id' => $this->getDocumentSetId(), // int Document->getDocuments()
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'expiration_date' => $this->getExpirationDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}

	/**
	* Get DocumentType by search of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=228
	**/
	public function getDocumentType()
	{

		return parent::curl(parent::getPath('getOne'), [
			'company_id' => parent::getCompanyId(),
			'qty' => $this->getQty(), //int,
			'document_id' => $this->getId(),//int
    		'offset' => $this->getOffset(), //int
            'customer_id' => $this->getCustomerId(), // int Customer->getCustomers()
            'supplier_id' => $this->getSupplierId(), // int Supplier->getSuppliers()
            'salesman' => $this->getSalesman(), //int Salesman-getSalesmens()
            'document_set_id' => $this->getDocumentSetId(), // int Document->getDocuments()
            'number' => $this->getNumber(), //int
            'date' => $this->getDate(), // date
            'expiration_date' => $this->getExpirationDate(), // date
            'year' => $this->getYear(), // int
            'your_reference' => $this->getYourReference(), // string
            'our_reference' => $this->getOurReference() // string
		]);
	}

	/**
	* Get PDF link of DocumentType 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=278
	**/
	public function getPDFLink()
	{
		return parent::curl(parent::getPath('getPDFLink'), [
			'company_id' => parent::getCompanyId(),
			'document_id' => $this->getId()
		]);
	}

}