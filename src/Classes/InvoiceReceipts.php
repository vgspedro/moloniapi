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

	$id = [
	'document_id' => // int required ON UPDATE $this->getInvoiceReceipts
	'date' => '2020-07-30', // date required
	'expiration_date' => '2020-07-30', // date required
	'maturity_date_id' => 0,// int
	'document_set_id' => 0, // int required
	'customer_id' => 0, // int required
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


 	private $value;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue(float $value = 0.0)
    {
        $this->value = $value;
    }

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

 	private $qty;

    public function getQty()
    {
        return $this->qty;
    }

    public function setQty(int $qty = 0)
    {
        $this->qty = $qty;
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

    public function setSalesmanId(int $salesman_id = 0)
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

	private $maturity_date_id;

    public function getMaturityDateId()
    {
        return $this->maturity_date_id;
    }

    public function setMaturityDateId(int $maturity_date_id = 0)
    {
        $this->maturity_date_id = $maturity_date_id;
    }

	private $alternate_address_id;

    public function getAlternateAddressId()
    {
        return $this->alternate_address_id;
    }

    public function setAlternateAddressId(int $alternate_address_id = 0)
    {
        $this->alternate_address_id = $alternate_address_id;
    }

	private $financial_discount;

    public function getFinancialDiscount()
    {
        return $this->financial_discount;
    }

    public function setFinancialDiscount(float $financial_discount = 0.0)
    {
        $this->financial_discount = $financial_discount;
    }

	private $eac_id;

    public function getEacId()
    {
        return $this->eac_id;
    }

    public function setEacId(int $eac_id = 0)
    {
        $this->eac_id = $eac_id;
    }

	private $salesman_commission;

    public function getSalesmanCommission()
    {
        return $this->salesman_commission;
    }

    public function setSalesmanCommission(float $salesman_commission = 0.0)
    {
        $this->salesman_commission = $salesman_commission;
    }

	private $special_discount;

    public function getSpecialDiscount()
    {
        return $this->special_discount;
    }

    public function setSpecialDiscount(float $special_discount = 0.0)
    {
        $this->special_discount = $special_discount;
    }


	/**
	* Count InvoiceReceiptss of the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=379
	**/
	public function getInvoiceReceiptsCount()
	{
		return parent::curl(parent::getPath('count'), [
			'company_id' => parent::getCompanyId(),
        	'customer_id' => $this->getCustomerId(), // int
       		'supplier_id' => $this->getSupplierId(), // int
        	'salesman_id' => $this->getSalesmanId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'expiration_date' => $this->getExpirationDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}


	/**
	* List InvoiceReceipts of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=374
	**/
	public function getInvoiceReceipts()
	{
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId(), //int required
			'qty' => $this->getQty(), //int
			'offset' => $this->getOffset(), //int
			'customer_id' => $this->getCustomerId(), // int
       		'supplier_id' => $this->getSupplierId(), // int
        	'salesman_id' => $this->getSalesmanId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'expiration_date' => $this->getExpirationDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}

	/**
	* Get a InvoiceReceipt by Id 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=375
	**/
	public function getInvoiceReceipt()
	{
		return  parent::curl(parent::getPath('getOne'), [
			'company_id' => parent::getCompanyId(), //int required
			'document_id' => $this->getId(), //int
			'customer_id' => $this->getCustomerId(), // int
       		'supplier_id' => $this->getSupplierId(), // int
        	'salesman_id' => $this->getSalesmanId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'expiration_date' => $this->getExpirationDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}


	/**
	* Create InvoiceReceipts in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=376
	**/
	public function setInvoiceReceipt()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(), //int required
			'date' => $this->getDate(), // date required
        	'expiration_date' => $this->getExpirationDate(), // date required
        	'maturity_date_id' => $this->getMaturityDateId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int required
        	'customer_id' => $this->getCustomerId(), // int required
			'alternate_address_id' => getAlternateAddressId(), // int
			'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
    		'financial_discount' => $this->getFinancialDiscount(), // float
			'eac_id' => $this->getEacId(), // int
			'salesman_id' => $this->getSalesmanId(), // int
			'salesman_commission' => $this->getSalesmanCommission(), // float
			'special_discount' => $this->getSpecialDiscount(), // float

		]);
	}

	/**
	* Update InvoiceReceipts by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=377
	**/
	public function updateInvoiceReceipt()
	{

		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
		]);

	}

	/**
	* Delete a Tax from the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=378
	**/
	public function deleteInvoiceReceipt()
	{
		return  parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'document_id' => $this->getId()
		]);
	}

	/**
	* Generates a new ATM reference associated with this document, at the requested amount.
	* You need to have an ATM reference generation system set up in the company, and the document in question must be closed (status = 1).
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=438
	**/
	public function generateMBReference()
	{
		return  parent::curl(parent::getPath('generateMBReference'), [
			'company_id' => parent::getCompanyId(), //int required
			'document_id' => $this->getId(), // int required
			'value' => $this->getValue(), // float required
		]);
	}




}