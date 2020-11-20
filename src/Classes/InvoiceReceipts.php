<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;
use \VgsPedro\MoloniApi\Classes\Product;
use \VgsPedro\MoloniApi\Classes\Taxes;

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
	[
		'document_id' => // int required ON UPDATE only
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
        'payments' => [ //array required
            'payment_method_id' => 0, // int required
            'date' => '2020-07-30 00:00:01', // datetime required
            'value ' => 0.0, // float required
            'notes' => 'p notes', // string
        ],

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

            //NOT DONE START

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
        return $this->document_set_id;
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

	private $associated_documents_associated_id;

    public function getAssociatedDocumentsAssociatedId()
    {
        return $this->associated_documents_associated_id;
    }

    public function setAssociatedDocumentsAssociatedId(int $associated_documents_associated_id = 0)
    {
        $this->associated_documents_associated_id = $associated_documents_associated_id;
    }

	private $associated_documents_value;

    public function getAssociatedDocumentsValue()
    {
        return $this->associated_documents_value;
    }

    public function setAssociatedDocumentsValue(float $associated_documents_value = 0.0)
    {
        $this->associated_documents_value = $associated_documents_value;
    }

	private $related_documents_notes;

    public function getRelateDocumentsNotes()
    {
        return $this->related_documents_notes;
    }

    public function setRelatedDocumentsNotes(string $related_documents_notes = null)
    {
        $this->related_documents_notes = $related_documents_notes;
    }

	private $exchange_currency_id;

    public function getExchangeCurrencyId()
    {
        return $this->exchange_currency_id;
    }

    public function setExchangeCurrencyId(int $exchange_currency_id = 0)
    {
        $this->exchange_currency_id = $exchange_currency_id;
    }

	private $exchange_rate;

    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    public function setExchangeRate(float $exchange_rate = 0.0)
    {
        $this->exchange_rate = $exchange_rate;
    }

	private $delivery_method_id;

    public function getDeliveryMethodId()
    {
        return $this->delivery_method_id;
    }

    public function setDeliveryMethodId(int $delivery_method_id = 0)
    {
        $this->delivery_method_id = $delivery_method_id;
    }

	private $delivery_datetime;

    public function getDeliveryDatetime()
    {
        return $this->delivery_datetime;
    }

    public function setDeliveryDatetime(string $delivery_datetime = null)
    {
        $this->delivery_datetime = $delivery_datetime;
    }

	private $delivery_departure_address;

    public function getDeliveryDepartureAddress()
    {
        return $this->delivery_departure_address;
    }

    public function setDeliveryDepartureAddress(string $delivery_departure_address = null)
    {
        $this->delivery_departure_address = $delivery_departure_address;
    }

	private $delivery_departure_city;

    public function getDeliveryDepartureCity()
    {
        return $this->delivery_departure_city;
    }

    public function setDeliveryDepartureCity(string $delivery_departure_city = null)
    {
        $this->delivery_departure_city = $delivery_departure_city;
    }

	private $delivery_departure_zip_code;

    public function getDeliveryDepartureZipCode()
    {
        return $this->delivery_departure_zip_code;
    }

    public function setDeliveryDepartureZipCode(string $delivery_departure_zip_code = null)
    {
        $this->delivery_departure_zip_code = $delivery_departure_zip_code;
    }

	private $delivery_departure_country;

    public function getDeliveryDepartureCountry()
    {
        return $this->delivery_departure_country;
    }

    public function setDeliveryDepartureCountry(int $delivery_departure_country = 0)
    {
        $this->delivery_departure_country = $delivery_departure_country;
    }

	private $delivery_destination_address;

    public function getDeliveryDestinationAddress()
    {
        return $this->delivery_destination_address;
    }

    public function setDeliveryDestinationAddress(string $delivery_destination_address = null)
    {
        $this->delivery_destination_address = $delivery_destination_address;
    }

	private $delivery_destination_city;

    public function getDeliveryDestinationCity()
    {
        return $this->delivery_destination_city;
    }

    public function setDeliveryDestinationCity(string $delivery_destination_city = null)
    {
        $this->delivery_destination_city = $delivery_destination_city;
    }

	private $delivery_destination_zip_code;

    public function getDeliveryDestinationZipCode()
    {
        return $this->delivery_destination_zip_code;
    }

    public function setDeliveryDestinationZipCode(string $delivery_destination_zip_code = null)
    {
        $this->delivery_destination_zip_code = $delivery_destination_zip_code;
    }

	private $delivery_destination_country;

    public function getDeliveryDestinationCountry()
    {
        return $this->delivery_destination_country;
    }

    public function setDeliveryDestinationCountry(int $delivery_destination_country = 0)
    {
        $this->delivery_destination_country = $delivery_destination_country;
    }

	private $vehicle_id;

    public function getVehicleId()
    {
        return $this->vehicle_id;
    }

    public function setVehicleId(int $vehicle_id = 0)
    {
        $this->vehicle_id = $vehicle_id;
    }

	private $vehicle_name;

    public function getVehicleName()
    {
        return $this->vehicle_name;
    }

    public function setVehicleName(string $vehicle_name = null)
    {
        $this->vehicle_name = $vehicle_name;
    }

	private $vehicle_number_plate;

    public function getVehicleNumberPlate()
    {
        return $this->vehicle_number_plate;
    }

    public function setVehicleNumberPlate(string $vehicle_number_plate = null)
    {
        $this->vehicle_number_plate = $vehicle_number_plate;
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

	private $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(int $status = 0)
    {
        $this->status = $status;
    }

	private $generate_mb_reference;

    public function getGenerateMbReference()
    {
        return $this->generate_mb_reference;
    }

    public function setGenerateMbReference(int $generate_mb_reference = 0)
    {
        $this->generate_mb_reference = $generate_mb_reference;
    }


	private $payments;

    public function getPayments()
    {
        return $this->payments;
    }

    public function setPayments(array $payments = [])
    {
        $this->payments = $payments;
    }

    private function hasPayments(){

        $r[] = $this->getPayments() > 0 ?
            [
            'payment_method_id' => $this->getPayments()[0]['payment_method_id'], // int required
            'date' => $this->getPayments()[0]['date'], // datetime required
            'value' => $this->getPayments()[0]['value'], // float required
            'notes' => $this->getPayments()[0]['notes'], // string
            ]
        :
        [];
        return $r;
    }

    private $products;

    public function getProducts()
    {
        return $this->products;
    }

    public function setProducts(array $products = [])
    {
        $this->products = $products;
    }

    private function hasProducts(){

        $r = [];
        $t = [];

        $counter = 0;

        foreach ($this->getProducts() as $prod){

            $r[] = [
                'product_id' => $prod['product_id'], // int required
                'name' => $prod['name'], // string required
                'summary' => $prod['summary'], // string
                'qty' => $prod['qty'], // float required
                'price' =>  $prod['price'], // float required
                'discount' => $prod['discount'], // float
                'order' => $counter+1, //int
                //'origin_id' => $this->getProductsOriginId(), //int
                'exemption_reason' => $prod['exemption_reason'], // string
                //'warehouse_id' => $this->getProductsWarehouseId(), //int

                'taxes' => $prod['taxes']
            ];

            $counter ++;

        }

        return $r;
    }

    //If the Invoice Receipt has Associated Documents build the array to update or insert
	private function hasAssociatedDocuments(){
		return $this->getAssociatedDocumentsAssociatedId() > 0 && $this->getAssociatedDocumentsValue() > 0 ?
	 		[
	 			'associated_id' => $this->getAssociatedDocumentsAssociatedId(),
	 			'value' => $this->getAssociatedDocumentsValue()
	 		]
	 	:
	 		[];
	}

    /**
    * Create InvoiceReceipts in the Company
    * @return json

    * https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=376
    **/
    public function insert()
    {
        return parent::curl(parent::getPath('insert'), [
            'company_id' => parent::getCompanyId(), //int required
            'date' => $this->getDate(), // date required
            'expiration_date' => $this->getExpirationDate(), // date required
            'maturity_date_id' => $this->getMaturityDateId(), //int
            'document_set_id' => $this->getDocumentSetId(), // int required
            'customer_id' => $this->getCustomerId(), // int required
            'your_reference' => $this->getYourReference(), // string
            'our_reference' => $this->getOurReference(), // string
            'products' => $this->hasProducts(), // array required
            'payments' => $this->hasPayments(),//array required
            'status' => $this->getStatus()// int
        ]);
    }





	/**
	* Count InvoiceReceipts of the Company
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=379
	**/
	public function getCounter()
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
	public function getAll()
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
	public function getById()
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
	* Update InvoiceReceipts by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=377
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(), // int required
			'document_id' => $this->getId(), // int required
			'date' => $this->getDate(), // date required
        	'expiration_date' => $this->getExpirationDate(), // date required
        	'maturity_date_id' => $this->getMaturityDateId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int required
        	'customer_id' => $this->getCustomerId(), // int required
			'alternate_address_id' => $this->getAlternateAddressId(), // int
			'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference(), // string
    		'financial_discount' => $this->getFinancialDiscount(), // float
			'eac_id' => $this->getEacId(), // int
			'salesman_id' => $this->getSalesmanId(), // int
			'salesman_commission' => $this->getSalesmanCommission(), // float
			'special_discount' => $this->getSpecialDiscount(), // float
			'associated_documents' => $this->hasAssociatedDocuments(), // array
			'related_documents_notes' => $this->getRelateDocumentsNotes(), // string

            'products' => $this->getProducts(), // array required

            'payments' => [ //array required
				'payment_method_id' => $this->getPaymentMethodId(), // int required
				'date' => $this->getPaymentDate(), // datetime required
				'value' => $this->getPaymentValue(), // float required
				'notes' => $this->getPaymentNotes(), // string
			],

			'exchange_currency_id' => $this->getExchangeCurrencyId(), //int
			'exchange_rate' => $this->getExchangeRate(), //float
			'delivery_method_id' => $this->getDeliveryMethodId(),//int'
			'delivery_datetime' => $this->getDeliveryDatetime(),//datetime'
			'delivery_departure_address' => $this->getDeliveryDepartureAddress(),// string
			'delivery_departure_city' => $this->getDeliveryDepartureCity(), //string
			'delivery_departure_zip_code' => $this->getDeliveryDepartureZipCode(), //string
			'delivery_departure_country' => $this->getDeliveryDepartureCountry(), //string
			'delivery_destination_address' => $this->getDeliveryDestinationAddress(),// string
			'delivery_destination_city' => $this->getDeliveryDestinationCity(), //string
			'delivery_destination_zip_code' => $this->getDeliveryDestinationZipCode(), //string
			'delivery_destination_country' => $this->getDeliveryDestinationCountry(), //string
			'vehicle_id' => $this->getVehicleId(),// int
			'vehicle_name' => $this->getVehicleName(),// string
			'vehicle_number_plate' => $this->getVehicleNumberPlate(),// string
			'notes' => $this->getNotes(), // string
			'status' => $this->getStatus(),// int
			'generate_mb_reference' => $this->getGenerateMbReference()// int

		]);

	}

	/**
	* Delete a Tax from the Company
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=378
	**/
	public function delete()
	{
		return  parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(), // int required
			'document_id' => $this->getId() // int required
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