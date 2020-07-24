<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the Invoice Receipts requests
*/

class InvoiceReceipts extends Authentication{

	/** @const entity api url */
	const ENTITY = '/invoiceReceipts/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	InvoiceReceipts array data structure

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

	/**
	* List InvoiceReceipts of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=374
	**/
	public function getInvoiceReceipts(array $c = [])
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, ['company_id' => $c['company_id']]);
	}

	/**
	* Get a InvoiceReceipts by Id 
	* @param int $tax_id // $this->getInvoiceReceipts() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=375
	**/
	public function getInvoiceReceipt(array $c = [], int $invoice_receipt_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getOne'.static::ACCESS.''.$c['token']['access_token'];
		return  parent::curl($url, ['company_id' => $c['company_id'], 'invoice_receipt_id' => $invoice_receipt_id]);
	}

	/**
	* Create InvoiceReceipts in the Company 
	* @param array $ir InvoiceReceipts
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=376
	**/
	public function setInvoiceReceipt(array $c = [], array $ir = [])
	{
		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];
		
		$response = parent::curl($url, [
			'company_id' => $c['company_id'],
			'name' => $t['name'], 
			'value' => $t['value'],
			'type' => $t['type'],
			'saft_type' => $t['saft_type'],
			'vat_type' => $t['vat_type'],
			'stamp_tax' => $t['stamp_tax'],
			'exemption_reason' => $t['exemption_reason'],
			'fiscal_zone' => $t['fiscal_zone'],
			'active_by_default' => $t['active_by_default']
		]);

		return $response;
	}

	/**
	* Update InvoiceReceipts
	* @param array $ir InvoiceReceipts
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=377
	**/
	public function updateInvoiceReceipt(array $c = [], array $ir = [])
	{

		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];

		$response =  parent::curl($url, [
			'company_id' => $c['company_id'],
			'tax_id' => $t['tax_id'],
			'name' => $t['name'], 
			'value' => $t['value'],
			'type' => $t['type'],
			'saft_type' => $t['saft_type'],
			'vat_type' => $t['vat_type'],
			'stamp_tax' => $t['stamp_tax'],
			'exemption_reason' => $t['exemption_reason'],
			'fiscal_zone' => $t['fiscal_zone'], //$this->getFiscalZones($id)
			'active_by_default' => $t['active_by_default']
		]);

		return $response;
	}

	/**
	* Delete a Tax from the Company 
	* @param int $tax_id // $this->getTaxes($c) required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=378
	**/
	public function deleteInvoiceReceipt(array $c = [], int $document_id  = 0)
	{
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];
		return  parent::curl($url, ['company_id' => $c['company_id'], 'document_id' => $document_id ]);
	}

}