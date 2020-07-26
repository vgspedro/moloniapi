<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the DocumentTypes requests
*/

class DocumentTypes extends Authentication{

	/** @const entity api url */
	const ENTITY = '/documents/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	DocumentType array data structure

    $dt = [
    	'qty' => 50, //int,
    	'offset' => 0, //int
    	'document_id' => 0, //int ONLY IN $this->getDocumentType()
        'customer_id' => 0, // int Customer->getCustomers()
        'supplier_id' => 0, // int Supplier->getSuppliers()
        'salesman' => 0, //int Salesman->getSalesmens()
        'document_set_id' => 0, // int Document->getDocuments()
        'number' => 0, //int
        'date' => '', // date
        'expiration_date' => '', // date
        'year' => 0, // int
        'your_reference' => '', // string
    	'our_reference' => '' // string
    ];

	*/

	/**
	* List All DocumentTypes 
	* @param int $language_id Language Id // GlobalData->getLanguages() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=226
	**/
	public function getAllDocumentTypes(array $c = [], int $language_id = 0)
	{
		return parent::curl(parent::getPath('getAllDocumentTypes'), [
			'company_id' => $c['company_id'],
			'language_id' => $language_id
		]);
	}

	/**
	* List DocumentTypes of Company 
	* @param int $language_id Language Id // GlobalData->getLanguages() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=227
	**/
	public function getDocumentTypes(array $c = [], array $dt = [])
	{
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => $c['company_id'],
			'qty' => $dt['qty'], //int,
    		'offset' => $dt['offset'], //int
        	'customer_id' => $dt['customer_id'], // int Customer->getCustomers()
       		'supplier_id' => $dt['supplier_id'], // int Supplier->getSuppliers()
        	'salesman' => $dt['salesman'], //int Salesman-getSalesmens()
        	'document_set_id' => $dt['document_set_id'], // int Document->getDocuments()
        	'number' => $dt['number'], //int
        	'date' => $dt['date'], // date
        	'expiration_date' => $dt['expiration_date'], // date
        	'year' => $dt['year'], // int
        	'your_reference' => $dt['your_reference'], // string
    		'our_reference' => $dt['our_reference'] // string
		]);
	}

	/**
	* Get DocumentType by search of Company 
	* @param int $language_id Language Id // GlobalData->getLanguages() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=228
	**/
	public function getDocumentType(array $c = [], array $dt = [])
	{

		return parent::curl(parent::getPath('getOne'), [
			'company_id' => $c['company_id'],
			'qty' => $dt['qty'], //int,
			'document_id' => $dt['document_id'],//int
    		'offset' => $dt['offset'], //int
        	'customer_id' => $dt['customer_id'], // int Customer->getCustomers()
       		'supplier_id' => $dt['supplier_id'], // int Supplier->getSuppliers()
        	'salesman' => $dt['salesman'], //int Salesman-getSalesmens()
        	'document_set_id' => $dt['document_set_id'], // int Document->getDocuments()
        	'number' => $dt['number'], //int
        	'date' => $dt['date'], // date
        	'expiration_date' => $dt['expiration_date'], // date
        	'year' => $dt['year'], // int
        	'your_reference' => $dt['your_reference'], // string
    		'our_reference' => $dt['our_reference'] // string
		]);
	}

	/**
	* Get PDF link of DocumentType 
	* @param int $language_id Language Id // GlobalData->getLanguages() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=278
	**/
	public function getPDFLink(array $c = [], int $document_id = 0)
	{
		return parent::curl(parent::getPath('getPDFLink'), [
			'company_id' => $c['company_id'],
			'document_id' => $document_id
		]);
	}



}