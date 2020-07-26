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

/*
$ir_get_one = [
	'document_id' => 0, // int
	'intcustomer_id' => 0, // int
	'supplier_id' => 0, // int
	'salesman_id' => 0, // int
	'document_set_id' => 0, // int
	'number' => 0, // int
	'date' => 0, // int
	'expiration_date' => 0, // int
	'year' => 0, // int
	'your_reference' => 0, // int
	'our_reference' => 0, // int
];


$id = [
'document_id' => // int required ON UPDATE $this->getInvoiceReceipts
'date' => '2020-07-30', // date required
'expiration_date' => '2020-07-30', // date required
'maturity_date_id' => 0,// int
'document_set_id' => 0, // int required
'customer_id int' => 0, // int required
'alternate_address_id' => 0, // int
'our_reference string' => 'ref', // string
'your_reference string' => 0, // string
'financial_discount' => 0.0, // float
'eac_id' => 0, // int
'salesman_id' => 0, // int
'salesman_commission' => 0.0, // float
'special_discount' => 0.0, // float float
'associated_documents'  => [ // array
	'associated_id int' => 0.0, // int required
	'value' => 0.0, // float required
	],
'related_documents_notes' => 'doc notes', // string
'products' => [ // array required
	'product_id' => 0, // int required
	'name' => 'name', // string required
	'summary' => 'summary', // string
	'qty' => 0.0, // float required
	'price' => 5.0, // float required
	'discount' => 5.0, // float
	'deduction_id' => 0, //int
	'order' => 0, //int
	'origin_id' => 0, //int
	'exemption_reason' => 0, // string
	'warehouse_id' => 0, //int

	'taxes' => [ //array
		'tax_id' => 0, //int required
		'value' => 0.0, // float
		'order' => 0, //int
		'cumulative' => 0, //int
	],
	'child_products' => [ //array
		'product_id' => 0, //int required
		'name' => 'name', // string required
		'summary' => 'c_p summary', // string
		'qty' => 0.0, // float required
		'price float' => 0.0, // float required
		'discount' => 0.0, // float
		'deduction_id' => 0, // int
		'order' => 0, // int
		'origin_id' => 0, // int
		'exemption_reason' => '', // string
		'warehouse_id' => 0, // int
		
		'properties' => [ //array
			'title' => '', // string
			'value' => '', // string
		],
		'taxes' => [ // array
			'tax_id' => 0, // int required
			'value' => 0.0, // float
			'order' => 0, // int
			'cumulative' => 0, // int
		]
	],
],
'payments' => [ //array required
	'payment_method_id' => 0, // int required
	'date' => '2020-07-30 00:00:01', // datetime required
	'value ' => 0.0, // float required
'notes' => 'p notes', // string
],
'exchange_currency_id' => 0, //  int
'exchange_rate' => 0.0, //  float
'delivery_method_id' => 0, //  int
'delivery_datetime' => '2020-07-30', //  date
'delivery_departure_address' => '', //  string
'delivery_departure_city' => '', //  string
'delivery_departure_zip_code' => '', //  string
'delivery_departure_country' => 0, //  int
'delivery_destination_address' => '', //  string
'delivery_destination_city' => '', //  string
'delivery_destination_zip_code' => '', //  string
'delivery_destination_country' => 0, //  int
'vehicle_id' => 0, //  int
'vehicle_name' => 0, //  string
'vehicle_number_plate' => '00-00-TT', //  string
'notes' => '', //  string
'status' => '', //  int
'generate_mb_reference' => '', // int
]





	/**
	* List InvoiceReceipts of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=374
	**/
	public function getInvoiceReceipts(array $c = [])
	{
		$url = parent::getUrl().''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
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
		$url = parent::getUrl().''.static::ENTITY.'getOne'.static::ACCESS.''.$c['token']['access_token'];
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
		$url = parent::getUrl().''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];
		
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

		$url = parent::getUrl().''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];

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
		$url = parent::getUrl().''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];
		return  parent::curl($url, ['company_id' => $c['company_id'], 'document_id' => $document_id ]);
	}

}